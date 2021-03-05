<?php


class AumetUser extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'production.User');
    }

    public function getInchargePerson($companyID)
    {
        $query = 'SELECT * FROM production."User" where "CompanyID" = ' . $companyID . ' order by "IsAdmin" desc limit 1';
        $arr = $this->db->exec($query);

        $objUser = count($arr) == 1 ? BaseModel::toObject($arr[0]) : null;

        $isRealEmailsEnabled = (getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod');

        if ($objUser != null && !$isRealEmailsEnabled) {
            $objUser->Email = "aumet.generic.user+$objUser->ID@gmail.com";
        }

        return $objUser;

        //return $this->db->exec($query);
    }

    public function getByCompanyId($companyID)
    {
        $arr = parent::getWhere('"CompanyID"=' . $companyID);
        $isRealEmailsEnabled = (getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod');
        if (!$isRealEmailsEnabled) {
            foreach ($arr as $objUser) {
                $objUser->Email = "aumet.generic.user+$objUser->ID@gmail.com";
            }
        }

        return $arr;
    }

    public function getEmailListByCompanyId($companyID)
    {
        $arr = parent::getWhere('"CompanyID"=' . $companyID);
        $arrEmailList = [];
        $isRealEmailsEnabled = (getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod');
        if (!$isRealEmailsEnabled) {
            foreach ($arr as $objUser) {
                $arrEmailList["aumet.generic.user+$objUser->ID@gmail.com"] = $objUser->FirstName . ' ' . $objUser->LastName;
            }
        } else {
            //return  $this->getInchargePerson($companyID)? (array) $this->getInchargePerson($companyID):[];
            foreach ($arr as $objUser) {
                if (filter_var($objUser->Email, FILTER_VALIDATE_EMAIL)) {
                    $arrEmailList[$objUser->Email] = $objUser->FirstName . ' ' . $objUser->LastName;
                }
            }
        }
        return $arrEmailList;
    }

    public function getByEmail($email)
    {
        return parent::getByField('"Email"', $email);
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }
}