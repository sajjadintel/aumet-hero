<?php

class ProductHighlight extends \BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'onex.productHighlight');
    }

    public function getByProductId($productId)
    {
        return $this->getWhere('"productId"='.$productId);
    }

    public function deleteByProductId($productId)
    {
        return $this->db->exec('delete from onex."productHighlight" where "productId"='.$productId);
    }
}