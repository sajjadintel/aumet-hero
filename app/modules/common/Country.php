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

    public function getAll()
    {
        $res = $this->db->exec('select "ID", "Name", "CountryCode", "RegionID", "FlagPath", "Long", "Lat" from setup."Country" order by "Name" ASC ');;
        return $res;
    }
}