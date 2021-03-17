<?php

class AnalyticsController extends Controller {

    function getList()
    {
        $fromDate = '2020-01-01';
        $toDate = '2021-03-01';
        $label = 'pharmacy';
        $dbData = new ViewEntityAnalytics();
        $arrData = $dbData->getMetricsSubscription($fromDate, $toDate, $label, $filter);
        var_dump($arrData);
    }

}