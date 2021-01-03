<?php

class Message extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.message');
    }


    public function getByToMessage($userId,$status)
    {
        $arr = parent::getWhere('"toUserId"='.$userId.' and "status"='.$status);
        if(count($arr) > 0){
            return $arr[0];
        }
        else {
            return false;
        }
    }
    public function getByFromMessage($userId,$status)
    {
        $arr = parent::getWhere('"fromUserId"='.$userId.' and "status"='.$status);
        if(count($arr) > 0)
        {
            return $arr[0];
        }
        else {
            return false;
        }
    }


    public function getByFromCompany($companyId)
    {
        return $this->getByField('"fromCompanyId"', $companyId);
    }

    public function getByToCompany($companyId)
    {
        return $this->getByField('"toCompanyId"', $companyId);
    }

    public function getById($messageId)
    {
        return $this->getByField('"id"', $messageId);
    }

    public function getByFromUserId($userId)
    {
        return parent::getByField('"fromUserId"', $userId);
    }
    public function getByToUserId($userId)
    {
        return parent::getWhere('"toUserId"='.$userId);
    }
}