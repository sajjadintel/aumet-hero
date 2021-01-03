<?php


class DistributorInterest extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'production.DistributorIntreset');
    }

    public function getByCompanyId($companyId)
    {
        return parent::getWhere('"companyId" = '. $companyId );
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }

}