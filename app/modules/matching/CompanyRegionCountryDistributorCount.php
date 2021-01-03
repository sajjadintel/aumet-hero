<?php


class CompanyRegionCountryDistributorCount extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.vwRegionCountryDistributorCount');
    }

    public function getByCompanyId($companyId)
    {
        return parent::getWhere('"CompanyId"='.$companyId);
    }
}