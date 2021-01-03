<?php


class BetaCompany extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.vwBetaCompany');
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }
}