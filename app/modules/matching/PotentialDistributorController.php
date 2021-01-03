<?php


class PotentialDistributorController extends Controller
{
    function getWorkspace(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialDistributors");
        } else {

            $arrPotentialDistributors = [];
            $this->f3->set('arrPotentialDistributors', $arrPotentialDistributors);

            $this->webResponse->setData(View::instance()->render("potentialdistributors/workspace.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function postAddSuggestedToTargetedCountries(){
        $countryId = $this->f3->get("POST.countryId");

        $objCountry = $this->arrSuggestedCountries[$countryId];

        $this->arrTargetedCountries[$countryId] = $objCountry;

        unset($this->arrSuggestedCountries[$countryId]);

        $this->f3->set('SESSION.arrTargetedCountries', $this->arrTargetedCountries);
        $this->f3->set('SESSION.arrSuggestedCountries', $this->arrSuggestedCountries);
        $this->f3->set('arrSuggestedCountries', $this->arrSuggestedCountries);
        $this->f3->set('arrTargetedCountries', $this->arrTargetedCountries);

        $this->getList();
    }

    function getList(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialDistributors");
        } else {

            $arrTargetedCountries = (new CompanyTargetCountry())->getByCompanyId($this->objCompany->ID);
            $this->f3->set('SESSION.arrTargetedCountries', $arrTargetedCountries);
            $this->f3->set('arrTargetCountries', $arrTargetedCountries);

            $vwRegionCountryDistributorCount = new CompanyRegionCountryDistributorCount();
            $arrTemp = $vwRegionCountryDistributorCount->getByCompanyId($this->objCompany->ID);

            $arrRegions = [];
            if($arrTemp) {
                foreach ($arrTemp as $objCountry) {
                    if(!array_key_exists($objCountry->RegionID, $arrRegions)) {
                        $arrRegions[$objCountry->RegionID] = new stdClass();
                        $arrRegions[$objCountry->RegionID]->id = $objCountry->RegionID;
                        $arrRegions[$objCountry->RegionID]->name = $objCountry->RegionName;
                        $arrRegions[$objCountry->RegionID]->arrCountries = [];
                    }

                    $objCountry->introductions = (new Introduction())->getCountByFromCompanyAndCountry($this->objCompany->ID, $objCountry->CountryID);
                    $objCountry->potentialDistributors = (new PotentialConnectionRecord())->getAvailableCountByCompanyAndCountry($this->objCompany->ID, $objCountry->CountryID);;

                    $arrRegions[$objCountry->RegionID]->arrCountries[] = $objCountry;
                }
            }

            $this->f3->set('arrRegions', $arrRegions);

            $arrPotentialDistributors = [];
            $this->f3->set('arrPotentialDistributors', $arrPotentialDistributors);

            $this->webResponse->setData(View::instance()->render("potentialdistributors/byRegion.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getPotentialDistributorsByCountryOffline(){
        $countryId = $this->f3->get("PARAMS.countryId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialdistributors/country/$countryId");
        } else {
            $this->f3->set('objSubscription', (new Subscription())->getByCompany($this->objCompany->ID));

            $this->f3->set('objCountry', (new Country())->getById($countryId));

            $arrDistributors = (new PotentialConnection())->getByAvailableConnectionsByCountry($this->objCompany->ID, $countryId);
            foreach ($arrDistributors as $objDistributor){
                $objDistributor->objUser = (new AumetUser())->getInchargePerson($objDistributor->ID);
                $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiences($objDistributor->distributorId);
            }

            $this->f3->set('arrDistributors', $arrDistributors);

            $this->webResponse->setData(View::instance()->render("potentialdistributors/byCountry.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getPotentialDistributorsByCountry(){
        $countryId = $this->f3->get("PARAMS.countryId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("potentialdistributors/country/$countryId");
        } else {
            $objCompanyTargetCountry = (new CompanyTargetCountry())->getByPKId($this->objCompany->ID, $countryId);

            $this->f3->set('objSubscription', (new Subscription())->getByCompany($this->objCompany->ID));

            $this->f3->set('objCountry', (new Country())->getById($countryId));

            if($objCompanyTargetCountry) {
                $arrMatchingTrace = [];

                $arrPotentialDistributors = [];

                $arrScientificNames = AumetDBRoutines::getManufacturerScientificNames($this->objCompany->ID);

                foreach ($arrScientificNames as $objSN) {
                    $arrMatchingTrace[] = "Matching $objSN->scientificNameId | $objSN->scientificName | $objSN->specialityId | $objSN->specialityName | $objSN->medicalLineId | $objSN->medicalLineName";
                    $arrDistributors = AumetDBRoutines::getInterestedDistributorsByScientificNameIdAndCountryId($objSN->scientificNameId, $countryId);

                    $arrMatchingTrace[] = "Interested Distributors ".count($arrDistributors);

                    foreach ($arrDistributors as $i){
                        if(key_exists($i->id, $arrPotentialDistributors)) {
                            $objDistributor = $arrPotentialDistributors[$i->id];
                            $objDistributor->aumetIndicatorHighlights = [];
                            $objDistributor->aumetIndicatorHighlights[] ='Distributor is interested in '.$objSN->scientificName;
                            $objDistributor->aumetIndicatorHighlights[] ='Distributors is interested in '.$objSN->specialityName;
                            $objDistributor->aumetIndicatorHighlights[] ='Distributor is interested in '.$objSN->medicalLineName;

                            $arrMatchingTrace[] = "Check Dst exp ($exp->specialityId, $exp->medicalLineId) with SN ($objSN->specialityId, $objSN->medicalLineId)";

                            foreach ($objDistributor->arrExperience as $exp) {
                                if( $objDistributor->aumetIndicator < 90 && $exp->medicalLineId == $objSN->medicalLineId){
                                    $objDistributor->aumetIndicatorHighlights[] = 'Distributor is specialized in '.$objSN->medicalLineName;
                                    $objDistributor->aumetIndicator = 90;
                                }
                                if( $objDistributor->aumetIndicator < 95 && $exp->specialityId == $objSN->specialityId){
                                    $objDistributor->aumetIndicatorHighlights[] = 'Distributor is specialized in '.$objSN->specialityName;
                                    $objDistributor->aumetIndicator = 95;
                                }
                                if( $objDistributor->aumetIndicator < 100 && $exp->specialityId == $objSN->specialityId && $exp->medicalLineId == $objSN->medicalLineId){
                                    $objDistributor->aumetIndicator = 100;
                                    break;
                                }
                            }

                            $arrPotentialDistributors[$i->id] = $objDistributor;
                        }
                        else{
                            $objDistributor = (new Company())->getById($i->id);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 85;
                            $objDistributor->aumetIndicatorTitle = "Very High";
                            $objDistributor->aumetIndicatorHighlights = [
                                'Distributor is interested in '.$objSN->scientificName,
                                'Distributors is interested in '.$objSN->specialityName,
                                'Distributor is interested in '.$objSN->medicalLineName
                            ];

                            foreach ($objDistributor->arrExperience as $exp) {

                                $arrMatchingTrace[] = "Check Dst exp ($exp->specialityId, $exp->medicalLineId) with SN ($objSN->specialityId, $objSN->medicalLineId)";

                                if( $objDistributor->aumetIndicator < 90 && $exp->medicalLineId == $objSN->medicalLineId){
                                    $objDistributor->aumetIndicatorHighlights[] = 'Distributor is specialized in '.$objSN->medicalLineName;
                                    $objDistributor->aumetIndicator = 90;
                                }
                                if( $objDistributor->aumetIndicator < 95 && $exp->specialityId == $objSN->specialityId){
                                    $objDistributor->aumetIndicatorHighlights[] = 'Distributor is specialized in '.$objSN->specialityName;
                                    $objDistributor->aumetIndicator = 95;
                                }
                                if( $objDistributor->aumetIndicator < 100 && $exp->specialityId == $objSN->specialityId && $exp->medicalLineId == $objSN->medicalLineId){
                                    $objDistributor->aumetIndicator = 100;
                                    break;
                                }
                            }

                            $arrPotentialDistributors[$i->id] = $objDistributor;
                        }
                    }

                    // NT or BT - Interests
                    $arrDistributors = AumetDBRoutines::getInterestedDistributorsByCountryAndScientificNameNTBT($objSN->scientificNameId, $countryId);
                    $arrMatchingTrace[] = "Related Interested Distributors ".count($arrDistributors);
                    foreach ($arrDistributors as $i){
                        if(!key_exists($i->companyId, $arrPotentialDistributors)) {
                            $objDistributor = (new Company())->getById($i->companyId);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 70;
                            $objDistributor->aumetIndicatorTitle = "High";
                            $objDistributor->aumetIndicatorHighlights = 'Distributor is interested in '.$i->relatedScientificName. ' which is related to your product '.$objSN->scientificName;
                            $arrPotentialDistributors[$i->companyId] = $objDistributor;
                        }
                    }

                    // RT Same Speciality - Interests
                    $arrDistributors = AumetDBRoutines::getInterestedDistributorsByCountryAndRTSpeciality($objSN->scientificNameId, $objSN->specialityId, $countryId);
                    $arrMatchingTrace[] = "Related Interested Distributors ".count($arrDistributors);
                    foreach ($arrDistributors as $i){
                        if(!key_exists($i->companyId, $arrPotentialDistributors)) {
                            $objDistributor = (new Company())->getById($i->companyId);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 60;
                            $objDistributor->aumetIndicatorTitle = "High";
                            $objDistributor->aumetIndicatorHighlights = [
                                'Distributor is interested in '.$i->scientificNames.', and your product "'.$objSN->scientificName.'" completes it',
                                'Distributor is interested in "'.$i->specialities.'"'
                            ];

                            $arrPotentialDistributors[$i->companyId] = $objDistributor;
                        }
                    }

                    // RT Different Speciality - Interests
                    $arrDistributors = AumetDBRoutines::getInterestedDistributorsByCountryAndRTDifferentSpeciality($objSN->scientificNameId, $objSN->specialityId, $countryId);
                    $arrMatchingTrace[] = "Related Interested Distributors ".count($arrDistributors);
                    foreach ($arrDistributors as $i){
                        if(!key_exists($i->companyId, $arrPotentialDistributors)) {
                            $objDistributor = (new Company())->getById($i->companyId);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 55;
                            $objDistributor->aumetIndicatorTitle = "High";
                            $objDistributor->aumetIndicatorHighlights = 'Distributor is interested in '.$objSN->specialityName.', and your product '.$objSN->scientificName.' completes it';
                            $arrPotentialDistributors[$i->companyId] = $objDistributor;
                        }
                    }

                    // NT or BT - Experiences
                    $arrDistributors = AumetDBRoutines::getExperiencedDistributorsByCountryAndScientificNameNTBT($objSN->scientificNameId, $countryId);
                    $arrMatchingTrace[] = "Related Experienced Distributors ".count($arrDistributors);
                    foreach ($arrDistributors as $i){
                        if(!key_exists($i->companyId, $arrPotentialDistributors)) {
                            $objDistributor = (new Company())->getById($i->companyId);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 50;
                            $objDistributor->aumetIndicatorTitle = "Medium";
                            $objDistributor->aumetIndicatorHighlights = 'Distributor sells '.$i->relatedScientificName. ', and your product '.$objSN->scientificName. ' completes their portfolio';
                            $arrPotentialDistributors[$i->companyId] = $objDistributor;
                        }
                    }

                    // RT Same Speciality - Experiences
                    $arrDistributors = AumetDBRoutines::getExperiencedDistributorsByCountryAndRTSpeciality($objSN->scientificNameId, $objSN->specialityId, $countryId);
                    $arrMatchingTrace[] = "Related Interested Distributors ".count($arrDistributors);
                    foreach ($arrDistributors as $i){
                        if(!key_exists($i->companyId, $arrPotentialDistributors)) {
                            $objDistributor = (new Company())->getById($i->companyId);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 45;
                            $objDistributor->aumetIndicatorTitle = "Medium";
                            $objDistributor->aumetIndicatorHighlights = 'Distributor is interested in '.$objSN->specialityName;
                            $arrPotentialDistributors[$i->companyId] = $objDistributor;
                        }
                    }

                    // RT Different Speciality - Experiences
                    $arrDistributors = AumetDBRoutines::getExperiencedDistributorsByCountryAndRTDifferentSpeciality($objSN->scientificNameId, $objSN->specialityId, $countryId);
                    $arrMatchingTrace[] = "Related Interested Distributors ".count($arrDistributors);
                    foreach ($arrDistributors as $i){
                        if(!key_exists($i->companyId, $arrPotentialDistributors)) {
                            $objDistributor = (new Company())->getById($i->companyId);
                            $objDistributor->arrInterests = AumetDBRoutines::getDistributorIntresetsByCompanyId($objDistributor->ID);
                            $objDistributor->arrExperience = AumetDBRoutines::getDistributorExperiencesByCompanyId($objDistributor->ID);

                            $objDistributor->aumetIndicator = 40;
                            $objDistributor->aumetIndicatorTitle = "Medium";
                            $objDistributor->aumetIndicatorHighlights = 'Distributor is interested in '.$objSN->specialityName.', and your product '.$objSN->scientificName.' completes it';
                            $arrPotentialDistributors[$i->companyId] = $objDistributor;
                        }
                    }
                }

                //$this->f3->set('arrMatchingTrace', $arrMatchingTrace);

                if(count($arrPotentialDistributors) == 0){
                    $this->webResponse->setData(View::instance()->render("potentialdistributors/byCountryEmpty.php"));
                }
                else {
                    usort($arrPotentialDistributors,function($first,$second){
                        return $first->aumetIndicator < $second->aumetIndicator;
                    });


                    $arrValidPotentialDistributors = [];
                    for ( $i=0; $i<count($arrPotentialDistributors); $i++){
                        $arrPotentialDistributors[$i]->isValid = true;
                        $pConn = new PotentialConnectionRecord();
                        $pConn->getPotentialConnection($this->objCompany->ID, $arrPotentialDistributors[$i]->ID);
                        if($pConn->dry()){
                            $pConn->companyId = $this->objCompany->ID;
                            $pConn->potentialCompanyId = $arrPotentialDistributors[$i]->ID;
                            $pConn->aumetIndicator = $arrPotentialDistributors[$i]->aumetIndicator;
                            $pConn->statusId = 1;
                            $pConn->countryId = $countryId;
                            $pConn->add();
                        }
                        else {
                            if($pConn->statusId != 1) {
                                $arrPotentialDistributors[$i]->isValid = false;
                                continue;
                            }
                        }
                        $arrPotentialDistributors[$i]->objUser = (new AumetUser())->getInchargePerson($arrPotentialDistributors[$i]->ID);

                        $arrUniqueExperiences = [];
                        foreach ( $arrPotentialDistributors[$i]->arrExperience as $objExp){
                            if(!key_exists($objExp->specialityId, $arrUniqueExperiences)) {
                                $arrUniqueExperiences[$objExp->specialityId] = $objExp;
                            }
                        }
                        $arrPotentialDistributors[$i]->arrExperience = $arrUniqueExperiences;

                        $arrValidPotentialDistributors[] = $arrPotentialDistributors[$i];
                    }

                    $this->f3->set('arrDistributors', $arrValidPotentialDistributors);

                    $this->webResponse->setData(View::instance()->render("potentialdistributors/byCountry.php"));
                }
            }
            else {
                $this->f3->set('arrDistributors', []);
            }


            echo $this->webResponse->getJSONResponse();
        }
    }


}