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
        $result=[];
        $data  = AumetDBRoutines::getMessages();
        if(!empty($data)) {
            $result = $this->getDatatableNonObject($data, 'sentOnDate', 'desc');
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