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
            $this->webResponse->setData(View::instance()->render("inquiry/list.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    /**
     * Get inquiries datatable
     */
    function getInquiries(){
        $where = '1=1';
        $boOnly = $this->f3->get('POST.boOnly');
        $rangeTime = $this->f3->get('POST.rangeTime');
        $senderType = $this->f3->get('POST.senderType');
        $inquiryStatus = $this->f3->get('POST.inquiryStatus');
        $inquirySenderUser = $this->f3->get('POST.inquirySenderUser');
        $inquiryReceiverUser = $this->f3->get('POST.inquiryReceiverUser');

        if($boOnly){
            $where .=' AND "senderType" = "distributor"';
        }
        if($rangeTime) {
            $dt                 = explode('-', $rangeTime);
            $end_date_time      = date('Y-m-d', strtotime(trim($dt[1])));
            $start_date_time    = date('Y-m-d', strtotime(trim($dt[0])));
            if ($start_date_time != '' && $end_date_time != '') {
                $where.= " AND DATE(sentOnDate) BETWEEN '" . $start_date_time . "' AND '" . $end_date_time . "'";
            }
        }
        if($senderType){
            $where .=' AND "senderType" = "'.$senderType.'"';
        }
        if($inquiryStatus){
            $where .=' AND "actionStatus" = '.$inquiryStatus;
        }
        if($inquirySenderUser){
            $where .=' AND "senderUser" = '.$inquirySenderUser;
        }
        if($inquiryReceiverUser){
            $where .=' AND "receiverUser" = '.$inquiryReceiverUser;
        }


        $result = $this->getDatatable((new InquiryView()), $where, 'sentOnDate', 'desc');
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
     * Get filters form to search on
     */
    function getFilters(){
        $this->f3->set('arrToUser',  AumetDBRoutines::getMessagesUsers());
        $this->f3->set('arrFromUser',  AumetDBRoutines::getMessagesUsers(1));
        $this->webResponse->setData(View::instance()->render("inquiry/section/filters.php"));
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
}