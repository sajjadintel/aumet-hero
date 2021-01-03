<?php

class ProductRange extends BaseModel
{
    public function __construct()
    {
        global $dbConnectionAumet;

        parent::__construct($dbConnectionAumet, 'public.product_ranges');
    }

    function mapPreviewImage($arrCatalogs){
        foreach ($arrCatalogs as $objCat){
            $ext = pathinfo($objCat->catalogueUrl, PATHINFO_EXTENSION);
            switch (strtoupper($ext) ){
                case "PDF":
                    $objCat->previewImageUrl = "/theme/assets/media/svg/files/pdf.svg";
                    break;
                case "JPG":
                case "JPEG":
                case "PNG":
                case "SVG":
                    $objCat->previewImageUrl = $objCat->catalogueUrl;
                    break;
                case "DOC":
                case "DOCX":
                    $objCat->previewImageUrl = "/theme/assets/media/svg/files/doc.svg";
                    break;
                case "XSL":
                case "XSLX":
                case "XML":
                case "CSV":
                    $objCat->previewImageUrl = "/theme/assets/media/svg/files/csv.svg";
                    break;
                default:
                    $objCat->previewImageUrl = "/theme/assets/media/svg/icons/General/Clip.svg";
                    break;
            }

        }
        return $arrCatalogs;
    }

    function getByCompanyId($companyId){
        $arrCatalogs = parent::getWhere('"Deleted"=false and  "companyId"='.$companyId);
        return $this->mapPreviewImage($arrCatalogs);
    }

    function getForProductProfile($id, $companyId)
    {
        if(is_numeric($id) && is_numeric($companyId)){
            $arrCatalogs = parent::getWhere('"Deleted"=false and (id='.$id.' or "companyId"='.$companyId.')');
            return $this->mapPreviewImage($arrCatalogs);
        }
        else{
            return [];
        }
    }

    function getForProductEdit($productId, $companyId)
    {
        if(is_numeric($productId) && is_numeric($companyId)){
            $arrCatalogs = parent::getWhere('"Deleted"=false and (id='.$productId.' or "companyId"='.$companyId.')');
            return $this->mapPreviewImage($arrCatalogs);
        }
        else{
            return [];
        }
    }
}