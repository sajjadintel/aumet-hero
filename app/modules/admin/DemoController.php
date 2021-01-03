<?php

class DemoController extends Controller
{
    function getStartDemo()
    {
        if (!$this->f3->ajax()) {
            $this->renderLayout("demo/start");
        } else {

            global $dbConnectionAumet;

            //$dbCompany = new BaseModel($dbConnectionAumet, 'production.Company');
            //$arrCompanies = $dbCompany->all('"Name" asc');

            //$arrCompanies = $dbCompany->getWhere('"ID" in (247219, 274157, 210785, 276033, 221167, 215165, 222701, 276044, 216809, 273765, 221857)');

            //$this->f3->set('arrCompanies', $arrCompanies);

            $this->webResponse->setData(View::instance()->render("demo/start.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getSetDemoCompany($companyId=0)
    {
        global $dbConnectionAumet;

        if($companyId == 0) {
            $companyId = $this->f3->get("PARAMS.companyId");
        }

        if(is_numeric($companyId)) {
            $dbCompany = new BaseModel($dbConnectionAumet, 'production.Company');
            $arrCom = $dbCompany->getWhere('"ID" = ' . $companyId);
            if(!$dbCompany->dry()){
                $objCompany = BaseModel::toObject($arrCom[0]);
                $this->f3->set('SESSION.objCompany', $objCompany);

                /*
                $dbCompanyProfile = new BaseModel($dbConnectionAumet, 'public.companies');
                $arrProf = $dbCompanyProfile->getWhere('"XrefId" = ' . $companyId);
                $dbCompanyProfile = BaseModel::toObject($dbCompanyProfile->getWhere('"XrefId" = ' . $companyId)[0]);
                $this->f3->set('SESSION.objCompanyProfile', $dbCompanyProfile);

                */
                $dbManufacturer = new BaseModel($dbConnectionAumet, 'production.Manufacturer');
                $objManufacturer = BaseModel::toObject($dbManufacturer->getWhere('"CompanyID" = ' . $companyId)[0]);
                $this->f3->set('SESSION.objManufacturer', $objManufacturer);

                $dbCountry = new BaseModel($dbConnectionAumet, 'public.countries');
                $objCountry = BaseModel::toObject($dbCountry->getWhere('"id" = ' . $objCompany->CountryID)[0]);

                $objCountry->flag = "";

                switch ($objCountry->id) {
                    case 13:
                        $objCountry->flag = "001-austria.svg";
                        break;
                    case 14:
                        $objCountry->flag = "009-australia.svg";
                        break;
                    case 46:
                        $objCountry->flag = "015-china.svg";
                        break;
                    case 87:
                        $objCountry->flag = "170-greece.svg";
                        break;
                    case 111:
                        $objCountry->flag = "077-jordan.svg";
                        break;
                    case 168:
                        $objCountry->flag = "121-new-zealand.svg";
                        break;
                    case 228:
                        $objCountry->flag = "226-united-states.svg";
                        break;
                }

                $this->f3->set('SESSION.objCountry', $objCountry);



                $dbProspectedCompany = new BaseModel($dbConnectionAumet, 'production.ProspectedCompany');
                $objProspectedCompany = BaseModel::toObject($dbProspectedCompany->getWhere('"ID" = ' . $objCompany->ProspectedCompanyID)[0]);
                $this->f3->set('SESSION.objProspectedCompany', $objProspectedCompany);

                $dbProspectedCompanyScientificNames = new BaseModel($dbConnectionAumet, 'production.ProspectedCompanyScientificName');
                $arrTempProspectedCompanyScientificNames = $dbProspectedCompanyScientificNames->getWhere('"ProspectedCompanyID" = ' . $objProspectedCompany->ID);
                $arrProspectedCompanyScientificNames = [];
                $arrCompanyMedicalLinesIDs = [];
                $arrCompanySpecialtiesIDs = [];
                foreach ($arrTempProspectedCompanyScientificNames as $objTemp) {
                    $obj = BaseModel::toObject($objTemp);
                    $arrProspectedCompanyScientificNames[] = $obj;

                    if(!in_array($objTemp->MedicalLineID, $arrCompanyMedicalLinesIDs) && is_numeric($objTemp->MedicalLineID) && $objTemp->MedicalLineID > 0){
                        $arrCompanyMedicalLinesIDs[] = $objTemp->MedicalLineID;
                    }

                    if(!in_array($objTemp->SpecialityID, $arrCompanySpecialtiesIDs) && is_numeric($objTemp->SpecialityID) && $objTemp->SpecialityID > 0){
                        $arrCompanySpecialtiesIDs[] = $objTemp->SpecialityID;
                    }
                }
                $this->f3->set('SESSION.arrCompanyScientificNames', $arrProspectedCompanyScientificNames);

                $dbSpeciality = new BaseModel($dbConnectionAumet, 'setup.Speciality');
                $arrTempSpeciality = $dbSpeciality->getWhere('"ID" in (' . implode(',',$arrCompanySpecialtiesIDs).')');
                $arrSpecialities = [];
                foreach ($arrTempSpeciality as $objTemp) {
                    $obj = BaseModel::toObject($objTemp);
                    $arrSpecialities[$objTemp->ID] = $obj;
                }
                $this->f3->set('SESSION.arrSpecialities', $arrSpecialities);

                $dbProducts = new BaseModel($dbConnectionAumet, 'public.products');
                $arrTempProducts = $dbProducts->getWhere('"manufacturerId" = ' . $companyId);
                $arrProducts = [];
                foreach ($arrTempProducts as $objProductTemp) {
                    $objProduct = BaseModel::toObject($objProductTemp);
                    if(array_key_exists($objProductTemp->specialityId, $arrSpecialities)){
                        $objProduct->specialityName = $arrSpecialities[$objProductTemp->specialityId]->Name;
                    }
                    else {
                        $objProduct->specialityName = $objProductTemp->specialityId;
                    }
                    $arrProducts[] = $objProduct;

                }
                $this->f3->set('SESSION.arrProducts', $arrProducts);

                $this->rerouteMemberHome();
            }
            else {
                $this->renderLayout("demo/start");
            }
        }
        else {
            $this->renderLayout("demo/start");
        }
    }

    function postSetupDemoCompany(){
            $this->getSetDemoCompany($this->f3->get("POST.companyId"));
    }

    function fillDemoData_Distributors()
    {

        $array = [];

        $dst_1 = new stdClass();
        $dst_1->logo = "https://media-exp1.licdn.com/dms/image/C560BAQFtNFZYyelQAA/company-logo_200_200/0?e=1611792000&v=beta&t=l7Znn_BtrN_AU3sqd-b0b7cbOiNZbVpvk7EI8TW5PB0";
        $dst_1->name = "MetroMed";
        $dst_1->city = "Dubai";
        $dst_1->country = "UAE";
        $dst_1->status = "active";
        $dst_1->email = "info@metromed.me";
        $dst_1->phone = "+971 4 808 5200";
        $dst_1->products = [];
        $dst_1->inquiriesCount = 34;

        $array[] = $dst_1;

        $this->f3->set('arrDistributors', $array);
    }

    function fillDemoData_PotentialDistributors()
    {

        $array = [];

        $dst_2 = new stdClass();
        $dst_2->logo = "/assets/img/oie_0CzbJRz6hng5.png";
        $dst_2->name = "Elaf";
        $dst_2->city = "Amman";
        $dst_2->country = "Jordan";
        $dst_2->status = "active";
        $dst_2->email = "info@elaf-me.com";
        $dst_2->phone = "+962 554 9896";
        $dst_2->products = [];
        $dst_2->inquiriesCount = 9;

        $array[] = $dst_2;

        $this->f3->set('arrPotentialDistributors', $array);
    }

    function fillDemoData_Products()
    {

        $array = [];

        $p_1 = new stdClass();
        $p_1->image = "/assets/img/oie_0CzbJRz6hng5.png";
        $p_1->name = "Product 1";
        $p_1->visitsCount = 9;

        $array[] = $p_1;

        $this->f3->set('arrProducts', $array);
    }

    function fillDemoData_TargetCountries()
    {

        $array = [];

        $item_1 = new stdClass();
        $item_1->countryId = 1;
        $item_1->flag = "260-united-kingdom.svg";
        $item_1->country = "United Kingdom";
        $item_1->region = "Europe";
        $item_1->regionId = 1;
        $item_1->population = "66.65M";
        $item_1->potentialDistributors = 15;
        $item_1->aumetIndicator = 76;
        $item_1->aumetIndicatorLabel = "success";

        $array[] = $item_1;

        $item_2 = new stdClass();
        $item_2->countryId = 2;
        $item_2->flag = "017-germany.svg";
        $item_2->country = "Germany";
        $item_2->region = "Europe";
        $item_2->regionId = 1;
        $item_2->population = "83.02M";
        $item_2->potentialDistributors = 37;
        $item_2->aumetIndicator = 93;
        $item_2->aumetIndicatorLabel = "primary";

        $array[] = $item_2;

        $this->f3->set('arrTargetCountries', $array);
    }

    function beforeroute()
    {
        parent::beforeroute();


            $this->fillDemoData_Distributors();
            $this->fillDemoData_PotentialDistributors();
            $this->fillDemoData_TargetCountries();

    }

    function getPage()
    {
        $page = $this->f3->get('PARAMS.page');
        if (!$this->f3->ajax()) {
            $this->renderLayout($page);
        } else {
            $this->webResponse->setTitle($this->f3->get("vTitle_$page"));
            $this->webResponse->setData(View::instance()->render("demo/$page.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function get_mysalesnetwork_region_distributors()
    {
        $regionId = $this->f3->get('PARAMS.regionId');
        if (!$this->f3->ajax()) {
            $this->renderLayout("mysalesnetwork/region/$regionId/distributors");
        } else {
            switch ($regionId) {
                case 1:
                    $this->f3->set('region', "Europe");

                    break;
            }

            $this->f3->set('regionId', $regionId);
            $this->webResponse->setData(View::instance()->render("demo/mysalesnetwork_region_distributors.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function get_mysalesnetwork_region_targetedcountries()
    {
        $regionId = $this->f3->get('PARAMS.regionId');
        if (!$this->f3->ajax()) {
            $this->renderLayout("mysalesnetwork/region/$regionId/targetedcountries");
        } else {
            switch ($regionId) {
                case 1:
                    $this->f3->set('region', "Europe");

                    break;
            }

            $this->f3->set('regionId', $regionId);
            $this->webResponse->setData(View::instance()->render("demo/mysalesnetwork_region_targetedcountries.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function get_mysalesnetwork_region_country()
    {
        $regionId = $this->f3->get('PARAMS.regionId');
        $countryId = $this->f3->get('PARAMS.countryId');
        if (!$this->f3->ajax()) {
            $this->renderLayout("mysalesnetwork/region/$regionId/country/$countryId");
        } else {


            switch ($regionId) {
                case 1:
                    $this->f3->set('region', "Europe");
                    switch ($countryId) {
                        case 1:
                            $this->f3->set('country', "Germany");
                            $this->f3->set('countryFlag', "017-germany.svg");
                            break;
                    }
                    break;
            }


            $this->f3->set('regionId', $regionId);
            $this->f3->set('countryId', $countryId);
            $this->webResponse->setData(View::instance()->render("demo/mysalesnetwork_country.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }
}
