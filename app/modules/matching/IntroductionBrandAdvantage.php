<?php

class IntroductionBrandAdvantage extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.introductionBrandAdvantage');
    }

    public function getByIntroduction($introductionId)
    {
        return $this->getWhere('"introductionId"='.$introductionId);
    }
}