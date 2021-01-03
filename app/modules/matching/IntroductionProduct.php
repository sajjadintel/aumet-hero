<?php

class IntroductionProduct extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.introductionProduct');
    }

    public function getByIntroduction($introductionId)
    {
        return parent::getWhere('"introductionId" = '. $introductionId );
    }

    public function getByPKId($introductionId, $productId)
    {
        return parent::getWhere('"introductionId" = '. $introductionId . ' and "productId" = '. $productId);
    }

    public function deleteByIntroductionId($introductionId)
    {
        return $this->db->exec('delete from onex."introductionProduct" where "introductionId" = '. $introductionId);
    }
}