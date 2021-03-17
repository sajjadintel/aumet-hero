<?php

class ViewEntityAnalytics extends BaseModel {
    const SUBSCRIPTION_TABLENAME = "vwEntityAnalytics";

    public function __construct()
    {
        global $dbMPConnectionAumet;
        parent::__construct($dbMPConnectionAumet, ViewEntityAnalytics::SUBSCRIPTION_TABLENAME);
    }

    public function getMetricsSubscription($fromDate = null, $toDate = null, $label = 'pharmacy', $filter = '')
    {
        $where = "";
        if ($fromDate || $toDate) {
            $where = " WHERE (`date`>='$fromDate' and `date`<='$toDate') AND `label` = '$label' ";
            if ($filter != '') {
                $where .= " $filter ";
            }
        }
        $query = "SELECT * FROM " . ViewEntityAnalytics::SUBSCRIPTION_TABLENAME;
        $groupBy = " ";
        $orderBy = " ";
        return $this->db->exec($query . $where . $groupBy . $orderBy);
    }

}