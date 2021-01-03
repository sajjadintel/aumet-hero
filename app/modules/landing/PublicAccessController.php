<?php

class PublicAccessController extends Controller
{
    function beforeroute()
    {
        if (!$this->isAuth) {
            $this->f3->set('vIsPlatformLocked', true);
            $this->f3->set('isSearchBarEnabled', true);
        }
    }

    function getProductProfileById(){
        $id = $this->f3->get("PARAMS.id");
        if (!$this->f3->ajax()) {
            $this->renderLayout("browse/product/$id");
        } else {
            $objProductProfile = new ProductProfile();
            if($objProductProfile->loadIntoF3($id)){
                $this->f3->set("userEmail", $this->objUser->email);
                $this->webResponse->setData(View::instance()->render("products/profile.php"));
            }
            else{
                $this->webResponse->setData(View::instance()->render("products/404.php"));
            }
            echo $this->webResponse->getJSONResponse();
        }
    }


}