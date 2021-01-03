<?php

class Availibilities extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.availabilities');
    }

    public function getAvailableSlots($companyId, $day){

        return parent::getWhere('"companyId" = '."'". $companyId."'".'AND day = '."'".$day."'");
    }

    public function getAvailablityById($id){
        return parent::getByField('id', $id);
    }

    public function getAllSlotsWithStartTime($companyId, $day, $start){
        if($companyId==''){
            return [];
        }
        return parent::findWhere('"companyId" = '."'". $companyId."'". ' AND "freeSlotStart"='."'".$start."'".' AND day = '."'".$day."'");
    }
}