<?php


class DashboardManufacturer extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.dashboardManufacturer');
    }

    public function getByCompanyId($companyId, $fromDate=null, $toDate=null)
    {
        $arr = [];
        if($fromDate!=null && $toDate!=null) {
            $arr = $this->db->exec('select COALESCE(sum("uniqueVisitors"), 0) as "uniqueVisitors", COALESCE(sum("profileVisits"), 0) as "profileVisits", COALESCE(sum("productVisits"), 0) as "productVisits", COALESCE(sum("catalogueVisits"), 0) as "catalogueVisits"  from onex."dashboardManufacturer"  "companyId"=? and "logDate">=? and "logDate"<=?', [$companyId, $fromDate, $toDate]);
        }
        elseif ($fromDate!=null) {
            $arr = $this->db->exec('select COALESCE(sum("uniqueVisitors"), 0) as "uniqueVisitors", COALESCE(sum("profileVisits"), 0) as "profileVisits", COALESCE(sum("productVisits"), 0) as "productVisits", COALESCE(sum("catalogueVisits"), 0) as "catalogueVisits"  from onex."dashboardManufacturer"  "companyId"=? and "logDate">=?', [$companyId, $fromDate]);
        }
        elseif ($toDate!=null) {
            $arr = $this->db->exec('select COALESCE(sum("uniqueVisitors"), 0) as "uniqueVisitors", COALESCE(sum("profileVisits"), 0) as "profileVisits", COALESCE(sum("productVisits"), 0) as "productVisits", COALESCE(sum("catalogueVisits"), 0) as "catalogueVisits"  from onex."dashboardManufacturer"  "companyId"=? and "logDate"<=?', [$companyId, $toDate]);
        }
        else {
            $arr = $this->db->exec('select COALESCE(sum("uniqueVisitors"), 0) as "uniqueVisitors", COALESCE(sum("profileVisits"), 0) as "profileVisits", COALESCE(sum("productVisits"), 0) as "productVisits", COALESCE(sum("catalogueVisits"), 0) as "catalogueVisits"  from onex."dashboardManufacturer" where "companyId"=?', $companyId);
        }

        return BaseModel::toObject($arr[0]);
    }
}