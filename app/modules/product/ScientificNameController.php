<?php

class ScientificNameController extends Controller
{
    //Get ScientificNames on basis of spciality id
    public function getScientificNameBySpecialityId()
    {   
        if ($this->f3->ajax()) {            
            $spcialityId = $this->f3->get("PARAMS.spcialityId");            
            $this->webResponse->setData(AumetDBRoutines::getScientificNameBySpecialityID($spcialityId));            
            echo $this->webResponse->getJSONResponse();
        }
    }

    public function getListPage(){
        if ($this->f3->ajax()) {
            $term = $_GET['q'];
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $objSN = new ScientificName();
            $objResponse = new stdClass();

            $arr = $objSN->search($term, $page);
            $objResponse->items = [];
            foreach ($arr as $item){
                $o = new stdClass();
                $o->id = $item->ID;
                $o->text = $item->Name;
                $objResponse->items[] = $o;
            }
            $objResponse->totalCount = $objSN->getSearchCount($term);

            $this->webResponse->setData($objResponse);
            echo $this->webResponse->getJSONResponse();
        }
    }
}
