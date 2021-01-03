<?php


class AumetCompany
{
    public $objCompany;
    public $objProspectedCompany;
    public $arrProspectedCompanyScientificNames;

    public $arrCompanyMedicalLinesIDs;

    public $arrCompanySpecialtiesIDs;
    public $arrSpecialities;

    public $arrProducts;

    public $objCountry;

    public $arrTargetedCountries;

    public function loadById($companyId){

        global $dbConnectionAumet;

        $this->objCompany = (new Company())->getById($companyId);
        if($this->objCompany == null) {
            return false;
        }
        $this->objProspectedCompany = (new ProspectedCompany())->getByField('"ID"', $this->objCompany->ProspectedCompanyID);
        if($this->objProspectedCompany == null) {
            return false;
        }

        $this->arrProducts = AumetDBRoutines::getManufacturerProductsByCompanyId($companyId);

        $this->arrProspectedCompanyScientificNames = [];
        $this->arrCompanyMedicalLinesIDs = [];
        $this->arrCompanySpecialtiesIDs = [];
        $this->arrSpecialities = [];

        $dbProspectedCompanyScientificNames = new BaseModel($dbConnectionAumet, 'production.ProspectedCompanyScientificName');
        $arrTempProspectedCompanyScientificNames = $dbProspectedCompanyScientificNames->getWhere('"ProspectedCompanyID" = ' . $this->objCompany->ProspectedCompanyID);
        if(!$dbProspectedCompanyScientificNames->dry()){
            foreach ($arrTempProspectedCompanyScientificNames as $obj) {
                $this->arrProspectedCompanyScientificNames[] = $obj;

                if(!in_array($obj->MedicalLineID, $this->arrCompanyMedicalLinesIDs) && is_numeric($obj->MedicalLineID) && $obj->MedicalLineID > 0){
                    $this->arrCompanyMedicalLinesIDs[] = $obj->MedicalLineID;
                }

                if(!in_array($obj->SpecialityID, $this->arrCompanySpecialtiesIDs) && is_numeric($obj->SpecialityID) && $obj->SpecialityID > 0){
                    $this->arrCompanySpecialtiesIDs[] = $obj->SpecialityID;
                }
            }

            $dbSpeciality = new BaseModel($dbConnectionAumet, 'setup.Speciality');
            $arrTempSpeciality = $dbSpeciality->getWhere('"ID" in (' . implode(',',$this->arrCompanySpecialtiesIDs).')');

            if(!$dbSpeciality->dry()){
                foreach ($arrTempSpeciality as $obj) {
                    $this->arrSpecialities[$obj->ID] = $obj;
                }
            }
        }

        $dbCountry = new BaseModel($dbConnectionAumet, 'setup.Country');
        $this->objCountry = $dbCountry->getByField('"ID"', $this->objCompany->CountryID );

        $this->arrTargetedCountries = (new CompanyTargetCountry())->getByCompanyId($this->objCompany->ID);
        return true;
    }

    public function reloadCompany($companyId){
        $this->objCompany = (new Company())->getById($companyId);
        $this->objCountry = (new Country())->getById($this->objCompany->CountryID);
        $f3 = \Base::instance();
        $f3->set('SESSION.objCompany', $this->objCompany);
        $f3->set('objCompany', $this->objCompany);
        $f3->set('SESSION.objCountry', $this->objCountry);
        $f3->set('objCountry', $this->objCountry);
        return $this->objCompany;
    }

    public function syncSession(){
        $f3 = \Base::instance();
        $f3->set('SESSION.objCompany', $this->objCompany);
        $f3->set('SESSION.objCountry', $this->objCountry);
        $f3->set('SESSION.objProspectedCompany', $this->objProspectedCompany);
        $f3->set('SESSION.arrScientificNames', $this->arrProspectedCompanyScientificNames);
        $f3->set('SESSION.arrSpecialities', $this->arrSpecialities);
        $f3->set('SESSION.arrProducts', $this->arrProducts);
        $f3->set('SESSION.arrTargetedCountries', $this->arrTargetedCountries);
    }

    public function clearSession(){
        $f3 = \Base::instance();
        $f3->clear('SESSION.objCompany');
        $f3->clear('SESSION.objCountry');
        $f3->clear('SESSION.objProspectedCompany');
        $f3->clear('SESSION.arrScientificNames');
        $f3->clear('SESSION.arrSpecialities');
        $f3->clear('SESSION.arrProducts');
        $f3->clear('SESSION.arrTargetedCountries');
    }

    public function loadFromSession(){
        $f3 = \Base::instance();
        $this->objCompany = $f3->get('SESSION.objCompany');
        $this->objCountry = $f3->get('SESSION.objCountry');
        $this->objProspectedCompany = $f3->get('SESSION.objProspectedCompany');
        $this->arrProspectedCompanyScientificNames = $f3->get('SESSION.arrScientificNames');
        $this->arrSpecialities = $f3->get('SESSION.arrSpecialities');
        $this->arrProducts = $f3->get('SESSION.arrProducts');
        $this->arrTargetedCountries = $f3->get('SESSION.arrTargetedCountries');
    }

    public function resyncSessionTargetedCountries(){
        $f3 = \Base::instance();
        $f3->set('SESSION.arrTargetedCountries', $this->arrTargetedCountries);
    }
}