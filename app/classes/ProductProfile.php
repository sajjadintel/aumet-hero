<?php


class ProductProfile
{
    private $f3;

    public function __construct()
    {
        $this->f3 = \Base::instance();
    }

    public function loadIntoF3($productId){
        $objProduct = AumetDBRoutines::getProductById($productId);
        if($objProduct){
            $dbCompany = new Company();
            $objCompany = $dbCompany->getById($objProduct->companyId);

            $dbCountry = new Country();
            $objCountry = $dbCountry->getById($objCompany->CountryID);
            $objRelatedProducts = AumetDBRoutines::getManufacturerRelatedProducts($objProduct->companyId, $productId);
            $arrProductImages = AumetDBRoutines::getProductImagesByProductId($productId);
            $arrSimilarProductsByScientificName = AumetDBRoutines::getSimilarProductsByScientificNameId($objProduct->companyId, $productId, $objProduct->scientificNameId);

            $filterSoldToItems = [];
            if(!is_null($objProduct->soldToIds)) {
                $arrProductSoldToIds = $objProduct->soldToIds != null ? explode(',',trim(trim($objProduct->soldToIds, '{'), '}')) : [];
                $dbSoldTo = (new AumetLookUp())->getAllSoldTo();
                $arrSoldTo = json_decode(json_encode($dbSoldTo), true);
                $filterSoldToItems = array_filter($arrSoldTo, function($item) use($arrProductSoldToIds) {
                    if(in_array($item['Value'], $arrProductSoldToIds)) {
                        return $item;
                    }
                });

            }
            $this->f3->set('arrSoldTo', $filterSoldToItems);
            $this->f3->set('objCountry', $objCountry);
            $this->f3->set('arrProductImages', $arrProductImages);
            $this->f3->set('objCompany', $objCompany);
            $this->f3->set('objManufacturerCompany', $objCompany);
            $this->f3->set('objInchargePerson', (new AumetUser())->getInchargePerson($objCompany->ID));
            $this->f3->set('objProduct', $objProduct);
            $this->f3->set('objRelatedProducts', $objRelatedProducts);
            $this->f3->set('arrSimilarProductsByScientificName', $arrSimilarProductsByScientificName);
            $this->f3->set('objOriginCountry', (new Country())->getById($objProduct->madeInCountryId));
            $this->f3->set('arrProductSpecialities', AumetDBRoutines::getSpecialitiesByScientificNameId($objProduct->scientificNameId));
            $this->f3->set('arrCatalogs', (new ProductRange())->getForProductProfile($objProduct->productRangeId, $objCompany->ID));
            $this->f3->set('arrCompanyDocuments', (new CompanyFile())->getCompanyDocuments( $objCompany->ID));

            return $objProduct;
        }
        else {
            return false;
        }
    }
}