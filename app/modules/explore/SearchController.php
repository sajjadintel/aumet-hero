<?php


class SearchController extends Controller
{
    function getHome(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("search");
        } else {
            $this->webResponse->setData(View::instance()->render("search/home.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getSearchProduct(){
        if (!$this->f3->ajax()) {
            $this->reroute("search");
        } else {

            $keyword = $_GET['keyword'];
            if(isset($keyword) && $keyword != "" && $keyword != null){
                $this->f3->set('arrProducts', AumetDBRoutines::searchProducts($keyword));
            }
            else {
                $this->f3->set('arrProducts', []);
            }

            $this->webResponse->setData(View::instance()->render("search/products.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }
}