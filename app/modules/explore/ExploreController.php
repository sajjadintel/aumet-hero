<?php


class ExploreController extends Controller
{
    function getSections(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("explore");
        } else {
            $arrList = [];
            if($this->objCompany->ID){
                $arrList = AumetDBRoutines::getDistributorIntresetsSpecialtiesByCompanyId($this->objCompany->ID);
            }
            $this->f3->set('arrList', $arrList);

            $this->webResponse->setData(View::instance()->render("explore/list.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getSectionSpecialityProducts(){
        if ($this->f3->ajax()) {

            $arrProducts = [];
            $arrProducts = AumetDBRoutines::getProductsListBySpecialityId($this->f3->get("PARAMS.specialityId"), 6);

            $this->f3->set('arrProducts', $arrProducts);
            $this->webResponse->setData(View::instance()->render("explore/sectionProducts.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getSpecialityPage(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("explore/".$this->f3->get("PARAMS.specialityId"));
        } else {
            $arrProducts = [];
            $arrProducts = AumetDBRoutines::getProductsListBySpecialityId($this->f3->get("PARAMS.specialityId"), 0);

            $this->f3->set('arrProducts', $arrProducts);
            $this->webResponse->setData(View::instance()->render("explore/specialityProducts.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }


}