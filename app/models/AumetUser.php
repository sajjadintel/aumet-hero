<?php


class AumetUser extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'production.User');
    }

    public function getInchargePerson($companyID){
        $query = 'SELECT * FROM production."User" where "CompanyID" = '.$companyID.' order by "IsAdmin" desc limit 1';
        $arr = $this->db->exec($query);

        $objUser = count($arr) == 1 ? BaseModel::toObject($arr[0]) : null;

        $isRealEmailsEnabled = (getenv('IS_BETA_ACCESS') == 1) && (getenv('ENV') == 'prod');

        // TODO: remove for production
        if($objUser != null && !$isRealEmailsEnabled){
            $objUser->Email = "aumet.generic.user+$objUser->ID@gmail.com";
        }

        return $objUser;

        //return $this->db->exec($query);
    }

    public function getByCompanyId($companyID){
        $arr = parent::getWhere('"CompanyID"='.$companyID);
        $isRealEmailsEnabled = (getenv('IS_BETA_ACCESS') == 1) && (getenv('ENV') == 'prod');
        if(!$isRealEmailsEnabled) {
            foreach ($arr as $objUser){
                $objUser->Email = "aumet.generic.user+$objUser->ID@gmail.com";
            }
        }

        return $arr;
    }

    /**
     * Get actual emails on ly if env is production and USE_REAL_EMAILS is set to 1
     * else add user id at the end of aumet.generic.user
     *
     * @param $companyID
     * @return array
     */
    public function getEmailListByCompanyId($companyID){
        $arr = parent::getWhere('"CompanyID"='.$companyID);
        $arrEmailList = [];
        $isRealEmailsEnabled =  (getenv('USE_REAL_EMAILS') == 1) && (getenv('ENV') == 'prod');
        if(!$isRealEmailsEnabled) {
            foreach ($arr as $objUser) {
                $arrEmailList["aumet.generic.user+$objUser->ID@gmail.com"] = $objUser->FirstName.' '.$objUser->LastName;
            }
        } else {
            //return  $this->getInchargePerson($companyID)? (array) $this->getInchargePerson($companyID):[];
            foreach ($arr as $objUser) {
                if (filter_var($objUser->Email, FILTER_VALIDATE_EMAIL)) {
                    $arrEmailList[$objUser->Email] = $objUser->FirstName.' '.$objUser->LastName;
                }
            }
        }
        return $arrEmailList;
    }
}