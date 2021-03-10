<?php


class AumetDBRoutines
{
    public static function getManufacturerScientificNameByCompanyID($companyId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"GetManufacturerScientificNameByCompanyID\"($companyId)");
    }

    public static function getDistributorExperiences($distributorId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from production.\"GetDistributorExperiences\"($distributorId)");
    }

    public static function getDistributorIntresets($distributorId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from production.\"GetDistributorIntresets\"($distributorId)");
    }

    /**
     * @param $companyId
     * @return array array of (title text, description text, image text, slug text)
     */
    public static function getManufacturerProductsByCompanyId($companyId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getManufacturerProducts\"($companyId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $companyId , $limit
     * @return array array of (title text, description text, image text, slug text)
     */
    public static function getManufacturerProductsByCompanyIdWithLimit($companyId,$pagelimit)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getManufacturerProductsByCompanyIdWithLimit\"($companyId, $pagelimit)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getIntroductionManufacturerProductsByCompanyId($companyId, $strProductIds)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getManufacturerProducts\"($companyId) where id in ($strProductIds)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getManufacturerSpecialityByComID($companyId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"GetManufacturerSpecialityByComID\"($companyId)");
    }

    public static function getDistributorIntresetsByCompanyId($companyId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"getDistributorIntresetsByCompanyId\"($companyId)");
    }

    public static function getDistributorExperiencesByCompanyId($companyId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getDistributorExperiencesByCompanyId\"($companyId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getDistributorExperiencesSpecialitiesByCompanyId($companyId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getDistributorExperiencesSpecialitiesByCompanyId\"($companyId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getDistributorIntresetsSpecialtiesByCompanyId($companyId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getDistributorIntresetsSpecialtiesByCompanyId\"($companyId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getProductsListBySpecialityId($specialityId, $limit = 6)
    {
        global $dbConnectionAumet;
        $limitKeyword = $limit > 0 ? "limit $limit" : "";
        $arr = $dbConnectionAumet->exec("select * from onex.\"getProductsListBySpecialityId\"($specialityId) $limitKeyword");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $companyId
     * @return array array of ("scientificNameID" bigint, "scientificName" character varying,
    "specialityID" bigint, "specialityName" character varying,
    "medicalLineID" bigint, "medicalLineName" character varying)
     */
    public static function getManufacturerScientificNames($companyId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getManufacturerScientificNames\"($companyId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $scientificNameID
     * @return array array of (id bigint, name text)
     */
    public static function getInterestedDistributorsByScientificNameId($scientificNameID)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getInterestedDistributorsByScientificNameId\"($scientificNameID)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $scientificNameID
     * @param $countryID
     * @return array array of (id bigint, name text)
     */
    public static function getInterestedDistributorsByScientificNameIdAndCountryId($scientificNameID, $countryID)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getInterestedDistributorsByScientificNameIdAndCountryId\"($scientificNameID, $countryID)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $scientificNameID
     * @param $countryID
     * @return array array of (id bigint, name text)
     */
    public static function getInterestedDistributorsByScientificNameIdRelationsAndCountry($scientificNameID, $countryID)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getInterestedDistributorsByScientificNameIdRelationsAndCountry\"($scientificNameID, $countryID)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $companyId
     * @param $scientificName
     * @param $specialityId
     * @param $createdFrom
     * @param $createdTo
     * @return array array of ("scientificNameID" bigint, "scientificName" character varying, "specialityID" bigint, "specialityName" character varying,"medicalLineID" bigint, "medicalLineName" character varying, image character)
     */
    public static function searchDistributorIntresetsByFields($companyId, $scientificName, $medicalId, $specialityId, $createdFrom, $createdTo) {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"searchDistributorIntresetsByFields\"($companyId, $scientificName, $medicalId, $specialityId, $createdFrom, $createdTo )");
    }

    /**
     * @return array array of (id bigint, name text)
     */
    public static function getManufacturerSpecialities($companyId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getManufacturerSpecialities\"($companyId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

      public static function getProductById($productId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getProductById\"($productId)");
        return count($arr) > 0 ? BaseModel::toObject($arr[0]): null;
    }

    /**
     * @return array array of (id bigint, name text, image text)
     */
    public static function getSpecialitiesByScientificNameId($scientificNameId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getSpecialitiesByScientificNameId\"($scientificNameId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }
  
    public static function getSpecialityByMedicalLineAndChildOnly($medicalLineId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"GetSpecialityByMedicalLineAndChildOnly\"($medicalLineId)");        
    }

    public static function getScientificNameBySpecialityID($spcialityId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"GetScientificNameBySpecialityID\"($spcialityId)");        
    }

    public static function getScientificNameByDistributorInterest($distributorId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"getScientificNameByDistributorInterest\"($distributorId)");        
    }

    public static function getDistributorByCompanyID($companyId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from production.\"GetDistributorByCompanyID\"($companyId)");        
    }

    public static function getMedicalLineWithScientificNamesCount()
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"GetMedicalLineWithScientificNamesCount\"()");        
    }
    public static function getSpecialitiesWithScientificNamesCountByMedicalLineID($medicalLineId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"GetSpecialitiesWithScientificNamesCountByMedicalLineID\"($medicalLineId)");        
    }

    public static function getManufacturerRelatedProducts($companyId, $productId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getManufacturerRelatedProducts\"($companyId, $productId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getProductImagesByProductId($productId)
    {
        global $dbConnectionAumet;
        return $dbConnectionAumet->exec("select * from onex.\"getProductImagesByProductId\"($productId)");
    }

    public static function getSimilarProductsByScientificNameId($companyId, $productId, $scientificNameId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getSimilarProductsByScientificNameId\"($companyId, $productId, $scientificNameId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $scientificNameID
     * @param $countryID
     * @return array array of (id bigint, name text)
     */
    public static function getInterestedDistributorsByCountryAndScientificNameNTBT($scientificNameId, $countryId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getInterestedDistributorsByCountryAndScientificNameNTBT\"($scientificNameId, $countryId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $scientificNameID
     * @param $countryID
     * @return array array of (id bigint, name text)
     */
    public static function getExperiencedDistributorsByCountryAndScientificNameNTBT($scientificNameId, $countryId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getExperiencedDistributorsByCountryAndScientificNameNTBT\"($scientificNameId, $countryId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getInterestedDistributorsByCountryAndRTSpeciality($scientificNameId, $specialityId, $countryId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getInterestedDistributorsByCountryAndRTSpeciality\"($scientificNameId,$specialityId, $countryId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getInterestedDistributorsByCountryAndRTDifferentSpeciality($scientificNameId, $specialityId, $countryId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getInterestedDistributorsByCountryAndRTDifferentSpeciality\"($scientificNameId,$specialityId, $countryId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getExperiencedDistributorsByCountryAndRTSpeciality($scientificNameId, $specialityId, $countryId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getExperiencedDistributorsByCountryAndRTSpeciality\"($scientificNameId,$specialityId, $countryId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function getExperiencedDistributorsByCountryAndRTDifferentSpeciality($scientificNameId, $specialityId, $countryId)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getExperiencedDistributorsByCountryAndRTDifferentSpeciality\"($scientificNameId,$specialityId, $countryId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    public static function searchProducts($keyword, $offset = 0, $pageSize = 10)
    {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec('select * from onex."searchProducts"(\'%'.$keyword.'%\') '." offset $offset limit $pageSize");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }
    public static function getIntroductionProducts($introductionId) {
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getIntroductionProducts\"($introductionId)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * Get a/all message
     * @param null $id
     * @return array
     */
    public static function getMessage($id = null){
        global $dbConnectionAumet;
        $where = '';
        if($id != null){
            $where .= ' AND "messageId" = '.$id;
        }
        $arr = $dbConnectionAumet->exec("select * from onex.\"vwMessages\" WHERE 1=1 ".$where);
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param $type set then from if empty then to
     * @return array
     */
    public static function getMessagesUsers($type = null){
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"getMessagesUser\"($type)");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @param null $type set then from if empty then to
     * @return array
     */
    public static function getMessagesCompany($type = null){
        global $dbConnectionAumet;
        $query = '';
        if($type){
            $query = 'select distinct "senderCompanyId", "senderCompany" from onex."vwMessages"';
        }else{
            $query = 'select distinct "receiverCompanyId", "receiverCompany" from onex."vwMessages"';
        }
        $arr = $dbConnectionAumet->exec($query);
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * Get all Medicals lines with IsActive either null or active
     * @return array|FALSE|int
     */
    public static function getMedicalLines()
    {
        global $dbConnectionAumet;
        $arrMedicalLines = $dbConnectionAumet->exec("select * from setup.\"GetMedicalLines\"()");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arrMedicalLines);
    }
    
    /**
     * @return array
     */
    public static function getAllDistributors(){
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"vwDistributorsData\" WHERE  \"jwtToken\" is null AND \"LoginToken\" is not null ");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }

    /**
     * @return array
     */
    public static function getAllManufacturer(){
        global $dbConnectionAumet;
        $arr = $dbConnectionAumet->exec("select * from onex.\"vwCompany\" WHERE  \"jwtToken\" is null AND \"LoginToken\" is not null AND \"Type\" = 'manufacturer' ");
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);
    }
}
