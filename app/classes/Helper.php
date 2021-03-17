<?php
use Ahc\Jwt\JWT;

class Helper {

    const jwtLife   = 10368000; //120 days
    const jwtSecret = '!@#$%AumetOnexSecretForJWT!@#$%';
    const jwtAlgo   = 'HS256';
    const jwtLeeway = 10;

    public static function idListFromArray($array){

        $ids = '';
        foreach ($array as $key => $value){
            if ($ids != ''){
                $ids .= ', ';
            }
            $ids .= $key;
        }
        return $ids;
    }

    /**
     * Convert date from one timezone to another one
     */
    function convertToOtherTimezone($datetime,$fromTimezone,$toTimezone){
        $convertedDate = new DateTime($datetime, new DateTimeZone($fromTimezone));
        $convertedDate->setTimezone(new DateTimeZone($toTimezone));
        $date = $convertedDate->format("Y-m-d H:i:s A");
        return [
            'object'=>$convertedDate,
            'date'  =>$date,
        ];
    }

    /**
     * custom or 120 day based token
     *
     * @param $uid
     * @param null $customLife
     * @return string
     */
    function genrateToken($uid, $customLife=null){
        $jwt = new JWT(Helper::jwtSecret, Helper::jwtAlgo, ($customLife!=null && is_int($customLife) ? $customLife : Helper::jwtLife), Helper::jwtLeeway);
        return $jwt->encode([
            'uId' => $uid,
        ]);
    }

    /**
     * @param $token
     * @return array
     */
    function decodeToken($token){
        $jwt = new JWT(Helper::jwtSecret, Helper::jwtAlgo, Helper::jwtLife, Helper::jwtLeeway);
        return $jwt->decode($token);
    }

    /**
     * @param $token
     * @return bool
     */
    function checkTime($token){
        try {
            $jwt = new JWT(Helper::jwtSecret, Helper::jwtAlgo, Helper::jwtLife, Helper::jwtLeeway);
            // Spoof time() for testing token expiry.
            $decodeInfo = $jwt->decode($token);
            $dt = new DateTime();
            $dateObj = $dt->setTimestamp($decodeInfo['exp']);
            $date = $dateObj->format("Y-m-d H:i:s A");
            // current date is greater than token expire then true else false
            return (time() >= strtotime($date)) ? true : false;
        }catch (Exception $e){
            return false;
        }
    }

    /**
     * @param $type
     * @param null $customLife
     * @param false $replace
     */
    function getJWTForAll($type, $customLife=null, $replace = false){
        if($type) {
            $companyType = null;
            if ($type == 'distributor') {
                $companyType = AumetDBRoutines::getAllDistributors();
            } elseif ($type == 'manufacturer') {
                $companyType = AumetDBRoutines::getAllManufacturer();
            }
            if ($companyType){
                if(!$replace) {
                    //Will only update non existing
                    foreach ($companyType as $row) {
                        if (($row->LoginToken != null || $row->LoginToken != '') && ($row->jwtToken == '' || $row->jwtToken == null)) {
                            $dbCompany = new Company();
                            $dbCompany->getById($row->ID);
                            if (!$dbCompany->dry()) {
                                $dbCompany->jwtToken = $this->genrateToken($row->LoginToken, $customLife);
                                $dbCompany->update();
                            }
                        }
                    }
                }elseif ($replace){
                    //Will update all
                    foreach ($companyType as $row) {
                        if ( ($row->LoginToken != null || $row->LoginToken != '') ) {
                            $dbCompany = new Company();
                            $dbCompany->getById($row->ID);
                            if (!$dbCompany->dry()) {
                                $dbCompany->jwtToken = $this->genrateToken($row->LoginToken, $customLife);
                                $dbCompany->update();
                            }
                        }
                    }
                }
        }
        }
    }

}