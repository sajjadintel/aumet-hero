<?php


class Speciality extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'setup.Speciality');
    }

    public function getById($id)
    {
        return parent::getByField('"ID"', $id);
    }

    public function getByStatus($status)
    {
        return parent::getByField('isActive', $status);
    }

    /**
     * Get specialities by medicalLineIdsIds
     *
     * @param $medicalLineIdsIds
     * @return array
     */
    public function getSpecilityByMedicalLines($medicalLineIdsIds){
        return parent::getWhere('"MedicalLineIds" IN ('.$medicalLineIdsIds.')');
    }

    // TODO: redo it
    public function add()
    {
        $this->Token = \Ramsey\Uuid\Uuid::uuid4();
        $this->CreatedBy = 'ONEX';
        $this->Qualified = false;
        $this->Slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->speciality)));
        $this->insert();
        return parent::getByField('"ID"', $this->get('_id'));
    }

    public function search($keyword)
    {
        return parent::getWhere('"speciality" ilike \'%'.$keyword.'%\'');
    }

    public function random(){
        $arr = $this->db->exec('SELECT * FROM public.products OFFSET floor(random()*7000) LIMIT 10;');
        return array_map(function ($obj) {
            return BaseModel::toObject($obj);
        }, $arr);

    }
}
