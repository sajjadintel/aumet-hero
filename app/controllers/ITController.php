<?php


class ITController extends Controller
{
    function getComparePage(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("database/compare");
        } else {

            global $dbConnectionAumet;
            global $dbConnectionAumet_dev;

            $arrTablesProd = BaseModel::getTablesAndViews($dbConnectionAumet);
//            $arrTablesDev = BaseModel::getTablesAndViews($dbConnectionAumet_dev);

            $this->f3->set('arrTablesProd', $arrTablesProd);
//            $this->f3->set('arrTablesDev', $arrTablesDev);

            $this->webResponse->setData(View::instance()->render("it/compare.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }
}