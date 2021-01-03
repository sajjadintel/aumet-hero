<?php


class Attendees extends BaseModel
{


    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.attendees');
    }

    /**
     * @param $eventId
     * @return array|null
     */
    public function getAllByEventId($eventId)
    {
        return parent::getWhere('"eventTblId"='."'".$eventId."'");
    }

    /**
     * @param $eventId
     * @return array|null
     */
    public function getByEventId($eventId)
    {
        return parent::getByField('"eventTblId"',$eventId);
    }
}