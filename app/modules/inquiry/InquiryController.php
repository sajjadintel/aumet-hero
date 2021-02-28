<?php

/**
 * Class InquiryController
 */
class InquiryController extends Controller
{
    /**
     * Get inquiry view
     */
    function getInquiriesPage(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("inquiries");
        } else {
            $this->f3->set('arrToUser',  AumetDBRoutines::getMessagesUsers());
            $this->f3->set('arrFromUser',  AumetDBRoutines::getMessagesUsers(1));
            $this->webResponse->setData(View::instance()->render("inquiry/list.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    /**
     * Get inquiries datatable
     */
    function getInquiries(){
        $where = '1=1 AND "parentId" = 0 ';
        $inquiryStatus = $this->f3->get('POST.inquiryStatusHidden');
        $inquiryReceiverUser = $this->f3->get('POST.inquiryReceiverUserHidden');
        $inquirySenderUser = $this->f3->get('POST.inquirySenderUserHidden');
        $senderType = $this->f3->get('POST.senderTypeHidden');
        $inquiryDate= $this->f3->get('POST.inquiryDate');
        $boOnly = $this->f3->get('POST.boOnly');
        $startDate = '';
        $endDate = '';

        if($inquiryStatus){
            $where .=' AND "actionStatus" = '.$inquiryStatus;
        }
        if($inquiryReceiverUser){
            $where .=' AND "toUserId" = '.$inquiryReceiverUser;
        }
        if($inquirySenderUser){
            $where .=' AND "fromUserId" = '.$inquirySenderUser;
        }
        if($senderType){
            $where .=" AND \"senderType\" = ".$senderType;
        }
        if($inquiryDate){
            $arrDate = explode('-',$inquiryDate);
            $date = new DateTime($arrDate[0]);
            $startDate = $date->format('Y-m-d'); // 31-07-2012
            if(isset($arrDate[1])){
                $date = new DateTime($arrDate[1]);
                $endDate = $date->format('Y-m-d');
            }
            $where .=' AND DATE("sentOnDate") >='."'".$startDate."'";
            if($endDate){
                $where .=' AND DATE("sentOnDate") <= '."'".$endDate."'";
            }
        }
        if($boOnly){
            //$where .=' AND "senderType" = "distributor"';
        }
        if($where) {
            $result = $this->getDatatable((new InquiryView()), $where, 'sentOnDate', 'desc');
        }else{
            $result = $this->getDatatable((new InquiryView()), '', 'sentOnDate', 'desc');
        }
        echo json_encode($result);
    }

    /**
     * Get single inquiry view
     */
    function getInquiry(){
        $inquiryId = $this->f3->get("PARAMS.inquiryId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("inquiry/$inquiryId");
        } else {
            $this->loadInquiries($inquiryId);
            echo $this->webResponse->getJSONResponse();
        }
    }

    /**
     * Approve a message
     */
    function setApprove(){
        $inquiryId  = $this->f3->get("PARAMS.inquiryId");
        $dbMessage  = new Message();
        $objMessage = $dbMessage->getById($inquiryId);
        if ($dbMessage->dry()) {
            $this->webResponse->setErrorCode(500);
            $this->webResponse->setMessage("Inquiry not found");
        } else {

            //Approved
            $dbMessage->actionStatus = 1;
            $dbMessage->update();

            /**
             * Check if message is sent via dialogue box then send email as well.
             */
            if($objMessage->messageDialogue == 1) {
                $this->webResponse->setMessage("Inquiry approved and email sent successfully.");
                $arrContacts = (new AumetUser())->getEmailListByCompanyId($dbMessage->toCompanyId);
                if (count($arrContacts) > 0) {
                    //list($status,$exception) = $this->sendMessageEmail($objMessage, $arrContacts);
                    $messageSent = true;
                    $messageException = null;
                    try {
                        $user               = (new AuthAumetUser())->getById($objMessage->fromUserId);
                        if($user) {
                            $objCompanyUser = (new CompanyUser())->getByUserId($user->id);
                            if($objCompanyUser) {
                                $objAumetCompany = (new Company())->getById($objCompanyUser->companyId);
                                global $emailSender;
                                $bccEmails = [];
                                if ((getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod')) {
                                    $bccEmails = [
                                        "a.atrash@aumet.com" => "Alaa",
                                        "m.issa@aumet.com" => "Mohammed",
                                        "r.abdelhadi@aumet.com" => "Raseel"
                                    ];
                                }
                                $this->f3->set("emailType", "message");
                                $this->f3->set('objMessage', $objMessage);
                                $this->f3->set('fromName', $user->displayName);
                                $this->f3->set('userPic', $user->photoUrl);
                                $this->f3->set('companyLogo', $objAumetCompany->Logo);
                                //If manufacturer is sending message to distributor instead of using manufacturer id use it's slug in email View Company Button
                                if ($objCompanyUser->accessType == Company::TYPE_MANUFACTURER) {
                                    $this->f3->set('companySlug', 'medical-manufacturers/' . $objAumetCompany->Slug);
                                }
                                /*$countryObj =  (new Country())->getById($objAumetCompany->CountryID);
                                print_r($countryObj);
                                $this->f3->set('countryName', $countryObj->Name);*/
                                $this->f3->set('companyType', $objAumetCompany->Type);
                                $htmlContent = View::instance()->render('email/layout.php');
                                $response = $emailSender->send("New message @ Aumet from " . $user->displayName, $htmlContent, $arrContacts, null, $bccEmails);
                                if(!$response){
                                    $messageSent        = false;
                                    $messageException   = 'Some thing went wrong while sending email.';
                                }else{
                                    $messageSent        = true;
                                }
                            }else{
                                $messageSent        = false;
                                $messageException   = 'Sender company does not exists';
                            }
                        }else{
                            $messageSent        = false;
                            $messageException   = 'Sender User does not exists';
                        }
                    }catch (Exception $e){
                        $messageSent        = false;
                        $messageException   = $e;
                    }
                    if(!$messageSent){
                        $this->webResponse->setErrorCode(500);
                        $this->webResponse->setMessage("Inquiry approved successfully but unable to send email. $messageException");
                    }
                }else{
                    $this->webResponse->setErrorCode(500);
                    $this->webResponse->setMessage("Inquiry approved, but no company user to send email to.");
                }
            }else{
                $this->webResponse->setErrorCode(500);
                $this->webResponse->setMessage("Inquiry approved successfully.");
            }

        }
        echo $this->webResponse->getJSONResponse();
    }

    /**
     * Disapprove a message
     */
    function setDisapprove(){
        $inquiryId = $this->f3->get("PARAMS.inquiryId");
        $dbMessage = new Message();
        $dbMessage->getById($inquiryId);
        if ($dbMessage->dry()) {
            $this->webResponse->setErrorCode(500);
            $this->webResponse->setMessage("Inquiry not found");
        } else {
            //Disapprove
            $dbMessage->actionStatus = 4;
            $dbMessage->update();
            $this->webResponse->setMessage("Inquiry disapproved successfully");
        }
        echo $this->webResponse->getJSONResponse();
    }

    /**
     * Helper Method
     *
     * Get data for single inquiry
     *
     * @param $inquiryId
     * @return false
     */
    function loadInquiries($inquiryId){
        $objInquiries = (new Message())->getById($inquiryId);
        if($objInquiries) {
            $this->f3->set('objInquiries',$objInquiries);
            $this->webResponse->setData(View::instance()->render("inquiry/model/message.php"));
        }
        else {
            $this->webResponse->setData(View::instance()->render("errors/404.php"));
            return false;
        }

    }

    /**
     * Send email on approval for message type inquiry only
     *
     * @param $objMessage
     * @param $arrContacts
     * @return array
     */
    function sendMessageEmail($objMessage, $arrContacts)
    {
        $messageSent = true;
        $messageException = null;
        try {
            $user               = (new AuthAumetUser())->getById($objMessage->fromUserId);
            if($user) {
                $objCompanyUser = (new CompanyUser())->getByUserId($user->id);
                if($objCompanyUser) {
                    $objAumetCompany = (new Company())->getById($objCompanyUser->companyId);
                    global $emailSender;
                    $bccEmails = [];
                    if ((getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod')) {
                        $bccEmails = [
                            "a.atrash@aumet.com" => "Alaa",
                            "m.issa@aumet.com" => "Mohammed",
                            "r.abdelhadi@aumet.com" => "Raseel"
                        ];
                    }
                    $this->f3->set("emailType", "message");
                    $this->f3->set('objMessage', $objMessage);
                    $this->f3->set('fromName', $user->displayName);
                    $this->f3->set('userPic', $user->photoUrl);
                    $this->f3->set('companyLogo', $objAumetCompany->Logo);
                    //If manufacturer is sending message to distributor instead of using manufacturer id use it's slug in email View Company Button
                    if ($objCompanyUser->accessType == Company::TYPE_MANUFACTURER) {
                        $this->f3->set('companySlug', 'medical-manufacturers/' . $objAumetCompany->Slug);
                    }
                    /*$countryObj =  (new Country())->getById($objAumetCompany->CountryID);
                    print_r($countryObj);
                    $this->f3->set('countryName', $countryObj->Name);*/
                    $this->f3->set('companyType', $objAumetCompany->Type);
                    $htmlContent = View::instance()->render('email/layout.php');
                    $response = $emailSender->send("New message @ Aumet from " . $user->displayName, $htmlContent, $arrContacts, null, $bccEmails);
                    if(!$response){
                        $messageSent        = false;
                        $messageException   = 'Some thing went wrong while sending email.';
                    }else{
                        $messageSent        = true;
                    }
                }else{
                    $messageSent        = false;
                    $messageException   = 'Sender company does not exists';
                }
            }else{
                $messageSent        = false;
                $messageException   = 'Sender User does not exists';
            }
        }catch (Exception $e){
            $messageSent        = false;
            $messageException   = $e;
        }
        return array('messageStatus' => $messageSent, 'messageException' => $messageException);
    }

    function getTest(){
        print_r('<pre>');
        print_r($_SESSION);
        print_r('</pre>');
    }
}