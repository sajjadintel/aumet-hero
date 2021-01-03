<?php


class AttendeesEvent extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.vwAttendeesEvents');
    }

    public function getByUserId($userId)
    {
        return parent::getWhere('"userId"='."'". $userId."'");
    }

    public function getByCompanyId($companyId)
    {
        return parent::getWhere('"organizerCompanyId"='."'". $companyId."' OR".'"companyId"='."'".$companyId."'");
    }
}