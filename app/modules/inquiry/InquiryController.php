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

    function getApprove(){
        $inquiryId = $this->f3->get("PARAMS.inquiryId");
        $dbMessage = new Message();
        $dbMessage->getById($inquiryId);
        if ($dbMessage->dry()) {
            $this->webResponse->setErrorCode(500);
            $this->webResponse->setMessage("Inquiry not found");
        } else {
            //Approved
            $dbMessage->actionStatus = 1;
            $dbMessage->update();
            $this->webResponse->setMessage("Inquiry approved successfully");
        }
        echo $this->webResponse->getJSONResponse();
    }

    function getDisapprove(){
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

    function getTest(){
        print_r('<pre>');
        print_r($_SESSION);
        print_r('</pre>');
    }
}