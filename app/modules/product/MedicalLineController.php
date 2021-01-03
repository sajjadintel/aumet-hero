<?php


class MedicalLineController extends Controller
{
    function getAll(){
        if ($this->f3->ajax()) {
            $arrMedicalLines = AumetDBRoutines::getMedicalLineWithScientificNamesCount();
            $this->f3->set('arrMedicalLines', $arrMedicalLines);
            $this->webResponse->setData($arrMedicalLines);
            echo $this->webResponse->getJSONResponse();
        }
    }
}