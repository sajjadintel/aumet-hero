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

            $this->webResponse->setData(View::instance()->render("businessopportunities/list2.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getBusinessOppotunitiesPage(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("distributors");
        } else {
            $arrCountries = [];
            $speciallities = (new Speciality())->all();
            $arrCountries = (new Country())->getAll();

            $arrMedicalLines = AumetDBRoutines::GetMedicalLineWithScientificNamesCount();

            $this->f3->set('arrCountries', $arrCountries);
            $this->f3->set('speciallities', $speciallities);
            $this->f3->set('arrMedicalLines', $arrMedicalLines);
            $this->webResponse->setData(View::instance()->render("businessopportunities/list.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getBORecords()
    {
        $where = '1=1';
        $ManufacturerName = $this->f3->get('POST.ManufacturerName');
        $DistributorName = $this->f3->get('POST.DistributorName');
        $BussinessUserPersonName = $this->f3->get('POST.BussinessUserPersonName');
        $BussinessUserEmail = $this->f3->get('POST.BussinessUserEmail');
        $connectionStatusId = $this->f3->get('POST.connectionStatusId');
        $CountryID = $this->f3->get('POST.CountryID');
        $sendDateTime = $this->f3->get('POST.sendDateTime');
        $SpecialityID = $this->f3->get('POST.SpecialityID');
        $reminderCount = $this->f3->get('POST.reminderCount');
        $MedicallineID = $this->f3->get('POST.MedicallineID');
        $startDate = '';
        $endDate = '';

        if($sendDateTime){
            $arrDate = explode('-',$sendDateTime);
            $date = new DateTime($arrDate[0]);
            $startDate = $date->format('Y-m-d'); // 31-07-2012
            if(isset($arrDate[1])){
                $date = new DateTime($arrDate[1]);
                $endDate = $date->format('Y-m-d');
            }

        }
        if($ManufacturerName){
            $where .=' AND "ManufacturerName" ilike \'%'.$ManufacturerName.'%\'';
        }
        if($DistributorName){
            $where .=' AND "DistributorName" ilike \'%'.$DistributorName.'%\'';
        }
        if($BussinessUserPersonName){
            $where .=' AND "BussinessUserPersonName" ilike \'%'.$BussinessUserPersonName.'%\'';
        }
        if($BussinessUserEmail){
            $where .=' AND "BussinessUserEmail" ilike \'%'.$BussinessUserEmail.'%\'';
        }
        if($CountryID){
            $where .=' AND "CountryID" ='.$CountryID;
        }
        if($reminderCount){
            $where .=' AND "reminderCount" ='.$reminderCount;
        }
        if($connectionStatusId){
            $where .=' AND "connectionStatusId" ='.$connectionStatusId;
        }
        if($SpecialityID){
            $where .=" AND '".$SpecialityID."' = ANY ( \"SpecialityID\" ) ";
        }
        if($MedicallineID){
            $where .=" AND '".$MedicallineID."' = ANY ( \"MedicallineID\" ) ";
        }
        if($sendDateTime){
            $where .=' AND "sendDateTime" >='."'".$startDate."'";
            if($endDate){
                $where .=' AND "sendDateTime" <= '."'".$endDate."'";
            }
        }
//echo $where;exit;
        if($where) {
            $distributors = $this->getDatatable((new BusinessOpportunities()), $where);
        }else{

            $distributors = $this->getDatatable((new BusinessOpportunities()));
        }

        echo json_encode(
            $distributors
        );
    }
}