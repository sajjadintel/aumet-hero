<?php


class MatchingController extends Controller
{
    function getMatchingRules(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("matching");
        } else {
            $arrList = [];
            $arrList = AumetDBRoutines::getManufacturerScientificNames($this->objCompany->ID);

            $this->f3->set('arrList', $arrList);

            $this->webResponse->setData(View::instance()->render("matching/matching.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getApplyMatchingRule()
    {

        $ruleId = $this->f3->get('PARAMS.ruleId');
        $scientificNameID = $this->f3->get('PARAMS.scientificNameID');

        switch ($ruleId) {
            case 1:
                $this->processMatchingRule1($scientificNameID);
                break;
        }
    }

    function processMatchingRule1($scientificNameID)
    {
        $arrList = [];
        $arrList = AumetDBRoutines::getInterestedDistributorsByScientificNameId($scientificNameID);

        $this->f3->set('arrList', $arrList);

        $this->webResponse->setData(View::instance()->render("matching/distributors.php"));

        echo $this->webResponse->getJSONResponse();
    }
}