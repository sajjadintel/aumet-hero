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
    function getInquiries()
    {
        //$result=[];
        //$data  = AumetDBRoutines::getMessages();
        $result = $this->getDatatable((new InquiryView()),'1=1', 'sentOnDate', 'desc');
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