<?php


class CompanyUser extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.companyUser');
    }

    public function getByUserId($userId)
    {
        return parent::getByField('"userId"', $userId);
    }
}