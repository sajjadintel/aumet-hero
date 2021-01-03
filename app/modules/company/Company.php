<?php


class Company extends BaseModel
{
    const TYPE_MANUFACTURER = "manufacturer";
    const TYPE_DISTRIBUTOR = "distributor";
    const TYPE_PHARMACY = "pharmacy";

    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'production.Company');
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }

    public function createRecord($name, $countryId, $type)
    {
        $objProspectedCompany = (new ProspectedCompany())->addAndLoad();
        $this->ProspectedCompanyID = $objProspectedCompany->ID;

        $this->Name = $name;
        $this->CountryID = $countryId;
        $this->Type = $type;

        $this->Token = \Ramsey\Uuid\Uuid::uuid4();
        $this->CreatedBy = 'ONEX';
        $this->Qualified = false;
        $this->Slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->Name)))."-".$this->generateRandomString(10);
        $this->insert();
        $objCompany = parent::getByField('"ID"', $this->get('_id'));

        switch ($objCompany->Type){
            case Company::TYPE_MANUFACTURER:
                $dbMfr = new BaseModel($this->db, 'production.Manufacturer');
                $dbMfr->CompanyID = $objCompany->ID;
                $dbMfr->CreatedBy = 'ONEX';
                $dbMfr->insert();
                break;
            case Company::TYPE_DISTRIBUTOR:
                $dbDst = new BaseModel($this->db, 'production.Distributor');
                $dbDst->CompanyID = $objCompany->ID;
                $dbDst->CreatedBy = 'ONEX';
                $dbDst->insert();
                break;
        }

        return $objCompany;

    }

    public function getDistributersByCountry($countryId)
    {
        return parent::getWhere('"Type"=\'distributor\' and "CountryID"='. $countryId);
    }
}