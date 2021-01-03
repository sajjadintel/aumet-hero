<?php

class SpecialityController extends Controller
{
    //Get spcialities on basis of medicalLineid
    function getSpecialityByMedicalId(){
        if ($this->f3->ajax()) {            
            $medicalLineId = $this->f3->get("PARAMS.medicalLineId");            
            $this->webResponse->setData(AumetDBRoutines::getSpecialitiesWithScientificNamesCountByMedicalLineID($medicalLineId));            
            echo $this->webResponse->getJSONResponse();
        }
    }
}
