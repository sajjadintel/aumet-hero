<?php


class Events extends BaseModel
{


    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.events');
    }

    /**
     * @param $userId
     * @return array|null
     */
    public function getAllByUserId($userId)
    {
        return parent::getByField('"userId"', $userId);
    }

    /**
     * @param $eventId
     * @return array|null
     */
    public function getByEventId($eventId)
    {
        return parent::getByField('"eventId"', $eventId);
    }

    /**
     * @param $eventId
     * @param $data
     * @return Events
     */
    public function checkMeetingOnThisTime($startTime,$meetingObj, $timeMaridiam='AM', $timeZone, $meetings)
    {
        $have_meeting = false;
        foreach ($meetings as $eventObj) {
            $dbStartDate = $eventObj->startTime;
            $dbEndDate = $eventObj->endTime;

            /* Converting  Database dates according to timezone */
            $timestamp = strtotime($dbStartDate);
            $DBConvertDateStart = new DateTime("@" . $timestamp);
            $DBConvertDateStart->setTimezone(new DateTimeZone($timeZone));
            $DBConvertDateStart = $DBConvertDateStart->format("Y-m-d H:i");

            $timestampEnd = strtotime($dbEndDate);
            $DBConvertDateEnd = new DateTime("@" . $timestampEnd);
            $DBConvertDateEnd->setTimezone(new DateTimeZone($timeZone));
            $DBConvertDateEnd = $DBConvertDateEnd->format("Y-m-d H:i");

            /* Converting New selected date according to timezone */
            $timestamp = strtotime($startTime);
            $convertDateEnd = new DateTime("@" . $timestamp);
            $convertDateEnd->setTimezone(new DateTimeZone($timeZone));
            $convertDateEnd = $convertDateEnd->format("Y-m-d H:i");

            if (!(($convertDateEnd >= $DBConvertDateStart) && ($DBConvertDateEnd > $convertDateEnd))) {
                if($meetingObj->eventId == $eventObj->eventId){
                    $have_meeting = false;
                }
            } else {
                return true;
            }
        }
        return $have_meeting;
    }

    public function getCountByCompany($companyId) {
        return $this->count('"companyId"='. $companyId . ' or "organizerCompanyId"='.$companyId);
    }

    public function checkAvailableSlotOnThisTime($companyId, $day, $startTime, $endTime, $timezone){
        $availabilityModel = new Availibilities();
        $availabilities = $availabilityModel->getAvailableSlots($companyId, $day);
        $flag = true;
        foreach ($availabilities as $available){
//            if($available->freeSlotStart==)
        }
    }
}