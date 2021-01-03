<?php

class Inquiry extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.inquiry');
    }

    public function getByCompany($companyId)
    {
        return $this->getByField('"companyId"', $companyId);
    }

    public function getById($id)
    {
        return $this->getByField('"id"', $id);
    }

    public function getCountByCompanyId($companyId) {
        return $this->count('"companyId"='. $companyId);
    }

}