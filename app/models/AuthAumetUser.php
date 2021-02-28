<?php

/**
 * Class AuthAumetUser
 */
class AuthAumetUser extends BaseModel
{

    public function __construct()
    {
        global $dbConnectionAumet;
        parent::__construct($dbConnectionAumet, 'auth.user');
    }

    public function getById($userId)
    {
        return parent::getByField('id', $userId);
    }

    public function getByEmail($email)
    {
        return parent::getByField('email', $email);
    }
}