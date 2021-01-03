<?php


class DistributorManufacturerBrand extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.vwDistributorManufacturerBrandProducts');
    }

    public function getByDistributorCompanyId($distributorCompanyId){
        return parent::getWhere('"distributorCompanyId"='.$distributorCompanyId);
    }
}