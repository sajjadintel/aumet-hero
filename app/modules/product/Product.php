<?php


class Product extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'public.products');
    }

    public function getById($id)
    {
        return parent::getByField('id', $id);
    }

    public function getBySlug($slug)
    {
        return parent::getByField('slug', $slug);
    }

    // TODO: redo it
    public function add()
    {
        $this->Token = \Ramsey\Uuid\Uuid::uuid4();
        $this->CreatedBy = 'ONEX';
        $this->Qualified = false;
        $this->Slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->Name)));
        $this->insert();
        return parent::getByField('"ID"', $this->get('_id'));
    }

    public function search($keyword)
    {
        return parent::getWhere('"productTitle" ilike \'%'.$keyword.'%\'');
    }

    public function random(){
        $arr = $this->db->exec('SELECT * FROM public.products OFFSET floor(random()*7000) LIMIT 10;');
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);

    }
}
