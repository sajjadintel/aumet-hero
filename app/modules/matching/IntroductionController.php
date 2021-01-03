<?php


class IntroductionController extends Controller
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
            $this->f3->set('objSubscription', (new Subscription())->getByCompany($this->objCompany->ID));

            //$this->f3->set('objDistributorCountry', (new Country())->getById($countryId));

            $objDistributor = (new PotentialConnection())->getPotentialConnection($this->objCompany->ID, $companyId);
            if($objDistributor) {
                $objDistributor->objCountry = (new Country())->getById($countryId);
                $objDistributor->objUser = (new AumetUser())->getInchargePerson($objDistributor->ID);
                $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiences($objDistributor->distributorId);
                $this->f3->set('objDistributor', $objDistributor);
            }
            $arrDocs = (new CompanyFile())->getCompanyDocuments($this->objCompany->ID);            
            $this->f3->set('arrManufacturerDocuments', $arrDocs);
            
            $arrManufacturerProducts =  AumetDBRoutines::getManufacturerProductsByCompanyId($this->objCompany->ID);
            $this->f3->set('arrManufacturerProducts', $arrManufacturerProducts);

            $arrIntroductionProducts = [];
            $this->f3->set('arrIntroductionProducts', $arrIntroductionProducts);

            $this->webResponse->setData(View::instance()->render("introductions/sendIntroduction.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getSendPotentialDistributorIntroductionProducts(){
        $countryId = $this->f3->get("PARAMS.countryId");
        $companyId = $this->f3->get("PARAMS.companyId");

        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialdistributors/country/$countryId/sendintroduction/$companyId");
        } else {
            $arrManufacturerProducts =  AumetDBRoutines::getManufacturerProductsByCompanyId($this->objCompany->ID);
            $this->f3->set('arrManufacturerProducts', $arrManufacturerProducts);

            $this->webResponse->setData(View::instance()->render("introductions/introductionProducts.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postSendPotentialDistributorIntroductionUpdateProducts(){
        $arrIntroductionProducts = $this->f3->get("POST.introductionProducts");
        $strIntroductionProducts = "";
        if(is_array($arrIntroductionProducts)){
            $strIntroductionProducts = implode(",",$arrIntroductionProducts);
        }
        else{
            $strIntroductionProducts = $arrIntroductionProducts;
        }

        $this->f3->set('arrManufacturerProducts', AumetDBRoutines::getIntroductionManufacturerProductsByCompanyId($this->objCompany->ID, $strIntroductionProducts));

        $this->webResponse->setData(View::instance()->render("introductions/introductionProducts.php"));

        echo $this->webResponse->getJSONResponse();
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
                if($dbSubscription->statusId == 1 || true) {
                    if($dbSubscription->introductions > 0 || true) {
                        $dbIntroduction = new Introduction();
                        $dbIntroduction->userId = $this->objUser->id;
                        $dbIntroduction->fromCompanyId = $this->objCompany->ID;
                        $dbIntroduction->toCompanyId = $companyId;
                        $dbIntroduction->countryId = $countryId;
                        $dbIntroduction->manufacturerOf = $this->f3->get("POST.manufacturerOf");
                        $dbIntroduction->message = $this->f3->get("POST.message");
                        $dbIntroduction->exclusivityPeriod = $this->f3->get("POST.exclusivityPeriod");
                        $dbIntroduction->exclusivityTerms = $this->f3->get("POST.exclusivityTerms");
                        
                        $objIntroduction = $dbIntroduction->addAndLoadById();

                        $dbPotentialConnectionRecord = new PotentialConnectionRecord();
                        $dbPotentialConnectionRecord->getPotentialConnection($this->objCompany->ID, $companyId);
                        $dbPotentialConnectionRecord->statusId=2;
                        $dbPotentialConnectionRecord->introductionId = $dbIntroduction->id;
                        $dbPotentialConnectionRecord->update();

                        $dbSubscription->introductions = $dbSubscription->introductions - 1;
                        $dbSubscription->update();

                        $arrProductIds = $this->f3->get("POST.productId");
                        foreach ($arrProductIds as $pid){
                            $objPID = new IntroductionProduct();
                            $objPID->introductionId = $dbIntroduction->id;
                            $objPID->productId = $pid;
                            $objPID->insert();
                        }

                        $objEmailData = new stdClass();
                        $objEmailData->arrBrandAdv = [];

                        $arrBrandAdv = $this->f3->get("POST.brandAdvantage");
                        foreach ($arrBrandAdv as $adv){
                            $obj = new IntroductionBrandAdvantage();
                            $obj->introductionId = $dbIntroduction->id;
                            $obj->advantage = $adv['advantage'];
                            $obj->insert();

                            $objEmailData->arrBrandAdv[] = $adv['advantage'];
                        }

                        $arrCompanyUsers = (new AumetUser())->getEmailListByCompanyId($companyId);
                        $objIntroduction->endDate = date("d F Y", strtotime("+1 month", strtotime($objIntroduction->sendDateTime)));
                        $objEmailData->objIntroduction = $objIntroduction;
                        $objEmailData->objToCompany = (new Company())->getById($objIntroduction->toCompanyId);
                        $objEmailData->objPotentialConnection = (new PotentialConnection())->getPotentialConnection($this->objCompany->ID, $objIntroduction->toCompanyId);
                        $objEmailData->objCountry = (new Country())->getById($objEmailData->objPotentialConnection->CountryID);
                        $objEmailData->arrDocuments = (new CompanyFile())->getCompanyDocuments($this->objCompany->ID);
                        $objEmailData->arrProducts = [];
                        foreach ($arrProductIds as $pid){
                            $objEmailData->arrProducts[] = (new Product())->getById($pid);
                        }

                        $this->f3->set('objEmailData', $objEmailData);

                        $this->sendIntroductionEmail($arrCompanyUsers);

                        $objRes = new stdClass();
                        $objRes->introductionsCredit = $dbSubscription->introductions;
                        $objRes->introductionId = $dbIntroduction->id;
                        $this->webResponse->setData($objRes);
                    }
                    else {
                        $this->webResponse->setErrorCode(IntroductionController::error_noEnoughCredits);
                    }
                }
                else {
                    $this->webResponse->setErrorCode(IntroductionController::error_inactiveSubscription);
                }
            }
            else {
                $this->webResponse->setErrorCode(IntroductionController::error_notSubscribed);
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
            $objIntroduction = $dbIntroduction->getById($introductionId);
            $this->f3->set('objIntroduction', $objIntroduction);

            global $dbConnectionAumet;

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);
            
            $objDistributor = (new PotentialConnection())->getPotentialConnection($this->objCompany->ID, $objIntroduction->toCompanyId);
            if($objDistributor) {
                $objDistributor->objCountry = (new Country())->getById($objDistributor->CountryID);
                $objDistributor->objUser = (new AumetUser())->getInchargePerson($objDistributor->ID);
                $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiences($objDistributor->distributorId);
                $this->f3->set('objDistributor', $objDistributor);
            }
            $arrPotentialProducts = AumetDBRoutines::getIntroductionProducts($introductionId);
            $this->f3->set('arrProducts', $arrPotentialProducts);
            $arrDocs = (new CompanyFile())->getCompanyDocuments($this->objCompany->ID);
            $this->f3->set('arrManufacturerDocuments', $arrDocs);
            
            $this->webResponse->setData(View::instance()->render("introductions/viewIntroduction.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getNewViewIntroduction(){
        $introductionId = $this->f3->get("PARAMS.introductionId");

        if (!$this->f3->ajax()) {
            $this->renderLayout("view-introduction/$introductionId");
        } else {
            $dbIntroduction = new Introduction();
            $objIntroduction = $dbIntroduction->getById($introductionId);
            $this->f3->set('objIntroduction', $objIntroduction);
            
            global $dbConnectionAumet;

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);
            
            $objDistributor = (new PotentialConnection())->getPotentialConnection($objIntroduction->fromCompanyId, $objIntroduction->toCompanyId);
            if($objDistributor) {
                $objDistributor->objCountry = (new Country())->getById($objDistributor->CountryID);
                $objDistributor->objUser = (new AumetUser())->getInchargePerson($objDistributor->ID);
                $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiences($objDistributor->distributorId);
                $this->f3->set('objUser', $objDistributor->objUser);
                $this->f3->set('objDistributor', $objDistributor);
            }
            
            $objBrandAdv = (new IntroductionBrandAdvantage())->getByIntroduction($introductionId);
            $this->f3->set('objBrandAdv', $objBrandAdv);
            $arrPotentialProducts = AumetDBRoutines::getIntroductionProducts($introductionId);
            $this->f3->set('arrProducts', $arrPotentialProducts);
            $this->f3->set('endDate', date("d F Y", strtotime("+1 month", strtotime($objIntroduction->sendDateTime))));
            $arrDocs = (new CompanyFile())->getCompanyDocuments($this->objCompany->ID);
            $this->f3->set('arrManufacturerDocuments', $arrDocs);            
            $this->f3->set('userEmail', $this->objUser->email);
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
            
            $this->webResponse->setData(View::instance()->render("introductions/emailViewIntroduction.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getSentIntroductions(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("introductions");
        } else {

            global $dbConnectionAumet;

            $objSubscription = (new Subscription())->getByCompany($this->objCompany->ID);
            $this->f3->set('objSubscription', $objSubscription);

            $dbSentIntroductions = new BaseModel($dbConnectionAumet, 'onex.vwSentIntroductions');
            $arrSentIntroductions = $dbSentIntroductions->getWhere('"fromCompanyId"='.$this->objCompany->ID);
            foreach ($arrSentIntroductions as $objIntro){
                $objIntro->objUser = (new AumetUser())->getInchargePerson($objIntro->toCompanyId);
                $objIntro->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objIntro->toCompanyId);
                $objIntro->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objIntro->toCompanyId);
            }
            
            $this->f3->set('arrSentIntroductions', $arrSentIntroductions);

            $this->webResponse->setData(View::instance()->render("introductions/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function sendIntroductionEmail($toEmails)
    {
        global $emailSender;

        $bccEmails = [
            "a.atrash@aumet.com" => "Alaa Al Atrash"
        ];

        $htmlContent = View::instance()->render('email/businessOpportunity.php');

        return $emailSender->send("Aumet Business Opportunity", $htmlContent, $toEmails, null, $bccEmails);
    }
}