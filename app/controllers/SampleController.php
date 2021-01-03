<?php


class SampleController extends Controller
{
    const moduleName = "sample-module";

    function getList(){
        if (!$this->f3->ajax()) {
            $this->renderLayout(SampleController::moduleName);
        } else {

            $arrList = [];
            $this->f3->set('arrList', $arrList);

            $this->webResponse->setData(View::instance()->render(SampleController::moduleName."/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
}