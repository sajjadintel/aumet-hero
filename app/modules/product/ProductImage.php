<?php


class ProductImage extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'public.productImages');
    }

    public function getByProductId($productId)
    {
        return parent::getWhere('"DeletedAt" is null and "productId"='.$productId);
    }

    public function bulkDelete($where){
        return $this->db->exec('update public."productImages" set "DeletedAt"=current_timestamp where '. $where);
    }
}