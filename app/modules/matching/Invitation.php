<?php

class Invitation extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.invitation');
    }

    public function getByCompany($companyId)
    {
        return $this->getByField('"companyId"', $companyId);
    }

    public function getPendingByCompany($companyId)
    {
        return $this->getWhere('"statusId"=1 and "companyId"='. $companyId, '"createdAt" desc');
    }

    public function getById($id)
    {
        return $this->getByField('"id"', $id);
    }

    public function getCountByCompanyId($companyId) {
        return $this->count('"companyId"='. $companyId);
    }

    public function getByCode($code)
    {
        return $this->getByField('code', $code);
    }
}