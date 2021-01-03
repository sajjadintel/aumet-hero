<?php


class CompanyFile extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'public.companyfiles');
    }

    /*
     * TODO: Refactor the functions (get_company_photos, get_company_documents, get_product_range_catalog) 1- camel case naming. 2- return objects
     * */
    public function get_company_photos($companyID){
        $query = 'SELECT * FROM public."companyfiles" WHERE "Type"=10 and "Deleted" = false and "companyid" = '.$companyID;
        return $this->db->exec($query);
    }

    public function get_company_documents($companyID){
        $query = 'SELECT * FROM public."companyfiles" WHERE "Type"=any(array[4,19,14]) and "Deleted" = false and "companyid" ='.$companyID;
        return $this->db->exec($query);
    }

    public function get_product_range_catalog($companyID){
        $query = 'SELECT * FROM public."product_ranges" WHERE "companyId" ='.$companyID;
        return $this->db->exec($query);
    }

    /* Type:

     * Pricelist = 6,          //Pricelist
        BalanceSheet = 7,       //Balance Sheet
        CompanyProfile = 8,      //Profile
        CompanyCatalog = 9,     //Catalogce
        //Company Photo
        OfficeGallary = 10,  //OfficeScientificNameIdS
        TeamGallary = 11,  // Team
        WarehouseGallary = 12,  //Warehouse
        OtherGallary = 3,   //Gallary
        //manufacture Certificare
        Manuf_Award_Certificate = 13,  //Certificate
        Manuf_FDA_Certificate = 14,    //Certificate
        Manuf_GMP_Certificate = 15,     //Certificate
        Manuf_SFDA_Certificate = 16,    //Certificate
        Manuf_Patent_Certificate = 17,      //Certificate
        Manuf_SixSegma_Certificate = 18,        //Certificate
        Manuf_CE_MarkCertificate = 19,      //Certificate
        Manuf_ISO_Certificate = 20,         //Certific  ate
        OtherManufactureCertificate = 4,        //Certificate
        Manuf_Company_Registration = 5, //Company Registration
        //Distributer Certificae
        Dist_Registration_Certifciate = 24, //Company Registration [JEbril]
        Dist_MOH_Certificate = 21,      //Certificate
        Dist_ProfisionPestPractice_Certificate = 22,    //Certificate
        Dist_Award_Certificate = 23, //Certificate
        Dist_Drug_ImprtingCertificate = 25, //Certificate
        OtherCertificate = 26, //Certificate
        Manufacturing_Demo_Device_Pricelist = 27,          //Pricelist
        Manufacturing_Spare_Parts_Pricelist = 28,          //Pricelist
        Manufacturing_Plant = 29,          //Pricelist
        Medicatl_Exhibition = 30,
        Videos = 31,
        Promotional_Material = 32,
        Videos_youTube = 33,
        DraftAgrenment = 34,
        Referenceslist = 35,
        Comparisonsheet = 36,
        Productmanual = 37,
        AuditBalanceSheet = 80,
     * */

    public function getCompanyPhotos($companyId){
        return parent::getWhere('"Type"=any(array[3,10,11,12]) and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getCompanyDocuments($companyId){
        return parent::getWhere('"Type"=any(array[4,5,6,7,8,9,13,14,15,16,17,19,20,27,28,29,30,32,37,80,90,91,92]) and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getCompanyProfiles($companyId){
        return parent::getWhere('"Type"=8 and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getCompanyRegistrationDocuments($companyId){
        return parent::getWhere('"Type"=5 and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getCompanyOtherDocuments($companyId){
        return parent::getWhere('"Type" not in (5,8,91,92) and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getCompanyCatalogs($companyId){
        return parent::getWhere('"Type"=91 and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getCompanyMaketingMaterial($companyId){
        return parent::getWhere('"Type"=92 and "Deleted" = false and "companyid"='.$companyId);
    }

    public function getById($id)
    {
        return parent::getByField('"Id"', $id);
    }
}