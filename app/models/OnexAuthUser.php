<?php


class OnexAuthUser extends BaseModel
{
    const userStatus_Active = 1;
    const userStatus_InActive = 2;

    const userRole_Admin = 1;

    public function __construct()
    {
        global $dbConnectionAumet;
        parent::__construct($dbConnectionAumet, 'auth.user');
    }

    public function getByUID($uid)
    {
        return $this->getByField('uid', $uid);
    }

    public function getById($userId)
    {
        return parent::getByField('id', $userId);
    }

    public function getByEmail($email)
    {
        return parent::getByField('email', $email);
    }

    public function getByResetCode($code)
    {
        return parent::getByField('"resetCode"', $code);
    }
}