<?php


class Country extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'setup.Country');
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }
}