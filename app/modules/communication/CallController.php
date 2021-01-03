<?php


class CallController extends Controller
{
    function get(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("calls");
        } else {

            $arrCalls = [];
            $this->f3->set('arrCalls', $arrCalls);

            if(count($arrCalls) == 0) {
                $this->webResponse->setData(View::instance()->render("calls/empty.php"));
            }
            else{
                $this->webResponse->setData(View::instance()->render("calls/list.php"));
            }

            echo $this->webResponse->getJSONResponse();
        }
    }
}