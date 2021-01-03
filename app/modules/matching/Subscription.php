<?php

class Subscription extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.subscription');
    }

    public function getByCompany($companyId)
    {
        return $this->getByField('"companyId"', $companyId);
    }
}