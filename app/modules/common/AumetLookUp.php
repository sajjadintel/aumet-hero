<?php


class AumetLookUp extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'public.Lookups');
    }

    public function getAllSellingPoints(){
        return parent::getWhere('"MajorId"=2 and "Deleted"=false and "Approved"=true');
    }

    public function getAllSoldTo(){
        return parent::getWhere('"MajorId"=3 and "Approved"=true and "Deleted"=false');
    }


}