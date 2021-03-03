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
            $this->f3->set('arrToUser',  AumetDBRoutines::getMessagesCompany());
            $this->f3->set('arrFromUser',  AumetDBRoutines::getMessagesCompany(1));
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
        $inquiryDate = $this->f3->get('POST.inquiryDate');
        $boTypeHidden = $this->f3->get('POST.boTypeHidden');
        $manufacturerType = $this->f3->get('POST.manufacturerTypeHidden');
        $startDate = '';
        $endDate = '';
        $emailNeeded = intval($this->f3->get('POST.emailNeeded')) ;

        if ($inquiryStatus) {
            switch ($inquiryStatus) {
                case 1:
                    $where .= ' AND "actionStatus" = 0';
                    break;
                case 2:
                    $where .= ' AND "actionStatus" = 1';
                    break;
                case 3:
                    $where .= ' AND "actionStatus" = 2';
                    break;
                case 4:
                    $where .= ' AND "actionStatus" = 3';
                    break;
                case 5:
                    $where .= ' AND "actionStatus" = 4';
                    break;
            }
        }
        if ($inquiryReceiverUser) {
            $where .= ' AND "receiverCompanyId" = ' . $inquiryReceiverUser;
        }
        if ($inquirySenderUser) {
            $where .= ' AND "senderCompanyId" = ' . $inquirySenderUser;
        }
        if ($senderType) {
            $where .= " AND \"senderType\" = '" . $senderType . "'";
        }
        if ($inquiryDate) {
            $arrDate = explode('-', $inquiryDate);
            $date = new DateTime($arrDate[0]);
            $startDate = $date->format('Y-m-d'); // 31-07-2012
            if (isset($arrDate[1])) {
                $date = new DateTime($arrDate[1]);
                $endDate = $date->format('Y-m-d');
            }
            $where .= ' AND DATE("sentOnDate") >=' . "'" . $startDate . "'";
            if ($endDate) {
                $where .= ' AND DATE("sentOnDate") <= ' . "'" . $endDate . "'";
            }
        }
        if($boTypeHidden){
            switch ($boTypeHidden) {
                case 2:
                    $where .= ' AND "hasActiveBO" = 1';
                    break;
                case 3:
                    $where .= ' AND "hasActiveBO" = 0';
                    break;
            }
        }
        if($emailNeeded){
         $where .= ' AND "noOfRcverUsers" = 0';
        }


        if ($manufacturerType) {
            if ($manufacturerType == 2) {
                $where .= ' AND "subscription" = 1';
            } elseif ($manufacturerType == 3) {
                $where .= ' AND "subscription" = 0';
            }
        }
        if ($where) {
            $result = $this->getDatatable((new InquiryView()), $where, 'sentOnDate', 'desc');
        } else {
            $result = $this->getDatatable((new InquiryView()), '', 'sentOnDate', 'desc');
        }
        $result = $this->getDatatable((new InquiryView()), $where, 'sentOnDate', 'desc');

        echo json_encode($result);
    }

    /**
     * Get inquiries datatable
     */
    function addEmail(){
        $msgId = $this->f3->get('POST.msgId');
        $newEmail = $this->f3->get('POST.email');

        $objMessage = (new Message())->getById($msgId);
        $objInquiryDetail = (new InquiryView())->getWhere('"messageId"='.$msgId);
        $toCompanyId = $objMessage->toCompanyId;
        $dbUser = new AumetUser();
        $ojbUser = $dbUser->getWhere('"Email"=\''.$newEmail.'\'');

        if(!$ojbUser){
            $dbUser->FirstName = $objInquiryDetail->receiverCompany;
            $dbUser->Email = $newEmail;
            $dbUser->CompanyID = $toCompanyId;
            $dbUser->add();

            //Send email to new user
            $inBox = new InboxController();
            $res = $inBox->sendMessageEmail($objMessage);
            $this->webResponse->setErrorCode(200);
            $this->webResponse->setTitle('Email added');
            $this->webResponse->setMessage('Email added successfully');
            echo $this->webResponse->getJSONResponse();
        }else{
            $this->webResponse->setErrorCode(404);
            $this->webResponse->setTitle('email already exist');
            $this->webResponse->setMessage('User with this email already exist');
            echo $this->webResponse->getJSONResponse();
        }
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
            $messageVwResponse = AumetDBRoutines::getMessage($inquiryId)[0];
            $subscriptionStatus = $messageVwResponse->subscription;
            //Approved
            $dbMessage->actionStatus = 1;
            $dbMessage->update();
            $this->webResponse->setMessage("Inquiry approved successfully.");
            /**
             * Check if message is sent via dialogue box then send email as well.
             */
            if($objMessage->messageDialogue == 1 && $subscriptionStatus == 1) {
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
                                if(!$response || !in_array($response, range(200, 299))){
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
            /*$objInquiries = (new Message())->all();
            $tree = $this->inboxTree($objInquiries,0,1, $inquiryId);
            $htmlChat = $this->getTreeHTML($tree);
            $html = '<div class="msg_history">'.$htmlChat.'</div>';
            $this->f3->set('tree',$html);*/
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

    function getTreeHTML($tree, $loop=0, $html = ''){
        $html ='';
        foreach ($tree as $msg){
            if ($loop == 0){
                $html .= '<div class="outgoing_msg">
                              <div class="sent_msg">
                                    <p>'.($msg->content != ""? html_entity_decode($msg->content): "Content of message is empty").'</p>
                                    <span class="time_date"> '.date('h:i A', strtotime($msg->createdAt)).'    |   '.$month = date('j M ', strtotime($msg->createdAt)).'</span>
                                </div>
                            </div>';
            }
            if ($loop == 1){
                $html .= '<div class="incoming_msg">
                              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                              <div class="received_msg">
                                <div class="received_withd_msg">
                                  <p>'.($msg->content != "" ? html_entity_decode($msg->content): "Content of message is empty").'</p>
                                  <span class="time_date"> '.date('h:i A', strtotime($msg->createdAt)).'    |   '.$month = date('j M ', strtotime($msg->createdAt)).'</span>
                                </div>
                              </div>
                            </div>';
            }
            if(!empty(is_array($msg->children))){
                $loop = ($loop == 1 ? 0 : 1);
                $html .= $this->getTreeHTML($msg->children,$loop, $html);
            }
        }
        return $html;
    }

    /**
     * Helper Method
     *
     * Generate inbox tree for a particulate message
     *
     * @param array $elements
     * @param int $parentId
     * @param int $iteration
     * @param int $parentMessageId
     * @return array
     */
    function inboxTree(array $elements, $parentId = 0, $iteration=0, $parentMessageId=0) {
        $check  = false;
        $branch = array();
        foreach ($elements as $element) {
            if($iteration != 0 && $parentMessageId == $element->id){
                $check = true;
            }
            if($check) {
                if ($element->parentId == $parentId) {
                    $children = $this->inboxTree((array)$elements, $element->id, $iteration++, $element->id);
                    if ($children) {
                        $element->children = $children;
                    }
                    $branch[] = $element;
                    if(count($branch)>0){
                        break;
                    }
                }
            }
        }
        return $branch;
    }

}