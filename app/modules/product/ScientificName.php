<?php


class ScientificName extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'setup.ScientificName');
    }

    public function getList()
    {
        return parent::getWhere('"IsApproved"=true and "DeletedAt" is null', '"Name" asc');
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }

    /*
     * $page: starts from 1
     */
    public function search($term, $page)
    {
        return parent::getWhere('"IsApproved"=true and "DeletedAt" is null and "Name" ilike \'%'.$term.'%\'', '"Name" asc', 20, ($page-1) * 30);
    }

    public function getSearchCount($term)
    {
        return parent::count('"IsApproved"=true and "DeletedAt" is null and "Name" ilike \'%'.$term.'%\'');
    }
}