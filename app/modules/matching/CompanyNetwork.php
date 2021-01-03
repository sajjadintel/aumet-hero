<?php


class CompanyNetwork extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.companyNetwork');
    }

    public function getConnectedManufacturers($distributorCompanyId){
        return parent::getWhere('"connectedCompanyId"='.$distributorCompanyId);
    }
}