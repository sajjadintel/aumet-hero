<?php


class PotentialConnectionRecord extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.potentialConnection');
    }

    public function getPotentialConnection($companyId, $connectedCompanyId)
    {
        return parent::getWhere('"companyId"='.$companyId.' and "potentialCompanyId"='.$connectedCompanyId);
    }

    public function getCountByCompanyAndCountry($companyId, $countryId) {
        return $this->count('"companyId"='. $companyId . ' and "countryId"='.$countryId);
    }

    public function getAvailableCountByCompanyAndCountry($companyId, $countryId) {
        return $this->count('"statusId"=1 and "companyId"='. $companyId . ' and "countryId"='.$countryId);
    }

    public function getCountByCompany($companyId) {
        return $this->count('"companyId"='. $companyId);
    }
}