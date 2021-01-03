<?php


class BusinessOpportunitiesController extends Controller
{
    // Define Errors
    const error_notSubscribed = 1;
    const error_inactiveSubscription = 2;
    const error_blockedSubscription = 3;
    const error_noEnoughCredits = 4;

    function getSendPotentialDistributorIntroduction(){
        $countryId = $this->f3->get("PARAMS.countryId");
        $companyId = $this->f3->get("PARAMS.companyId");

        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialdistributors/country/$countryId/sendintroduction/$companyId");
        } else {

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);

            $this->f3->set('objCountry', (new Country())->getById($countryId));

            $objDistributor = (new PotentialConnection())->getPotentialConnection($this->objCompany->ID, $companyId);
            $objDistributor->objUser = (new AumetUser())->getInchargePerson($objDistributor->ID);
            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiences($objDistributor->distributorId);
            $this->f3->set('objDistributor', $objDistributor);

            $this->webResponse->setData(View::instance()->render("introductions/sendIntroduction.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postSendPotentialDistributorIntroduction(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialDistributors");
        } else {

            $countryId = $this->f3->get("PARAMS.countryId");
            $companyId = $this->f3->get("PARAMS.companyId");

            $dbSubscription = new Subscription();
            $dbSubscription->getByCompany($this->objCompany->ID);

            if(!$dbSubscription->dry()) {
                if($dbSubscription->statusId == 1) {
                    if($dbSubscription->introductions > 0) {
                        $dbIntroduction = new Introduction();
                        $dbIntroduction->userId = $this->objUser->id;
                        $dbIntroduction->fromCompanyId = $this->objCompany->ID;
                        $dbIntroduction->toCompanyId = $companyId;
                        $dbIntroduction->addReturnID();

                        $dbPotentialConnectionRecord = new PotentialConnectionRecord();
                        $dbPotentialConnectionRecord->getPotentialConnection($this->objCompany->ID, $companyId);
                        $dbPotentialConnectionRecord->statusId=2;
                        $dbPotentialConnectionRecord->update();

                        $dbSubscription->introductions = $dbSubscription->introductions - 1;
                        $dbSubscription->update();

                        $objRes = new stdClass();
                        $objRes->introductionsCredit = $dbSubscription->introductions;
                        $objRes->introductionId = $dbIntroduction->id;
                        $this->webResponse->setData($objRes);
                    }
                    else {
                        $this->webResponse->setErrorCode(IntroductionController::IntroductionControllerError_noEnoughCredits);
                    }
                }
                else {
                    $this->webResponse->setErrorCode(IntroductionController::IntroductionControllerError_inactiveSubscription);
                }
            }
            else {
                $this->webResponse->setErrorCode(IntroductionController::IntroductionControllerError_notSubscribed);
            }

            //$this->webResponse->setData( $this->f3->get('POST'));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getViewIntroduction(){
        $introductionId = $this->f3->get("PARAMS.introductionId");

        if (!$this->f3->ajax()) {
            $this->renderLayout("introductions/$introductionId");
        } else {

            $dbIntroduction = new Introduction();
            $dbIntroduction->getById($introductionId);

            global $dbConnectionAumet;

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);

            $objDistributor = (new PotentialConnection())->getPotentialConnection($this->objCompany->ID, $dbIntroduction->toCompanyId);
            $objDistributor->objUser = (new AumetUser())->getInchargePerson($objDistributor->ID);
            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiences($objDistributor->distributorId);
            $this->f3->set('objDistributor', $objDistributor);

            $this->f3->set('objCountry', (new Country())->getById($objDistributor->CountryID));

            $this->webResponse->setData(View::instance()->render("introductions/viewIntroduction.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getBusinessOpportunities(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("businessopportunities");
        } else {

            global $dbConnectionAumet;

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);

            $dbBusinessOpportunities = new BaseModel($dbConnectionAumet, 'onex.vwBusinessOpportunities');
            $arrBusinessOpportunities = $dbBusinessOpportunities->getWhere('"companyId"='.$this->objCompany->ID);
            foreach($arrBusinessOpportunities as $objBO){
                $objBO->objUser = (new AumetUser())->getInchargePerson($objBO->companyId);
            }
            
            $this->f3->set('arrBusinessOpportunities', $arrBusinessOpportunities);
            $availableSlots = [];
            $this->f3->set('allSlots', $availableSlots);

            $this->webResponse->setData(View::instance()->render("businessopportunities/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
}