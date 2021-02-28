<?php


class InquiryView extends BaseModel
{

    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.vwMessages');
    }


}