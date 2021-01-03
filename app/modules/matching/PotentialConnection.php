<?php


class PotentialConnection extends BaseModel
{
    const STATUS_AVAILABLE = 1;
    const STATUS_TAKEN = 2;
    const STATUS_RESERVED = 3;
    const STATUS_INVALID = 4;

    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.vwPotentialConnections');
    }

    public function getByAvailableConnectionsByCountry($companyId, $countryId)
    {
        return parent::getWhere('"companyId"='.$companyId.' and "connectionStatusId"=1 and "CountryID"='.$countryId);
    }

    public function getPotentialConnection($companyId, $connectedCompanyId)
    {
        $arr = parent::getWhere('"companyId"='.$companyId.' and "ID"='.$connectedCompanyId);
        if(count($arr) > 0){
            return $arr[0];
        }
        else {
            return false;
        }
    }

    public function getAvailableConnections($companyId)
    {
        return parent::getWhere('"companyId"='.$companyId.' and "connectionStatusId"=1', "aumetIndicator ASC", 5);
    }

    public function getMySaleNetorkConnections($companyId)
    {
        return parent::getWhere('"companyId"='.$companyId.'', "aumetIndicator DESC");
    }

    public function getSuggestedNetorkConnections($companyId)
    {
        return parent::getWhere('"companyId"='.$companyId.' and "connectionStatusId"=1', "aumetIndicator DESC");
    }
}