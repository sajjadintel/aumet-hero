<?php


class InterestController extends Controller
{
    function getMyInterests(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("myinterests");
        } else {
            global $dbConnectionAumet;
            $dbMedicalLines = new BaseModel($dbConnectionAumet, 'onex.medicalLine');
            $arrMedicalLines = $dbMedicalLines->all();
            $this->f3->set('arrMedicalLines', $arrMedicalLines);
            $dbSpeciality = new BaseModel($dbConnectionAumet, 'setup.Speciality');
            $arrSpeciality = $dbSpeciality->all();
            $this->f3->set('arrSpeciality', $arrSpeciality);              
            $this->webResponse->setData(View::instance()->render("myinterests/list.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postGetMyInterestsData(){
        if ($this->f3->ajax()) {   
            //Code used for filtering record from datatable         
            $arrList = [];
            $datatable = array_merge(array('pagination' => array(), 'sort' => array(), 'query' => array()), $_REQUEST);            
            if ($datatable['query'] != "" && count($datatable['query']) > 0) {
                $specialityIds = $addeOn = $medicalLineIds = $productName = null;
                if(isset($datatable['query']['filter'])) {
                    $filter = $datatable['query']['filter'];
                    $productName = $startFrom = $endTo = null;
                    if(isset($filter['addedOn'])&&!empty($filter['addedOn'])) {
                        if(count(explode(" - ",$filter['addedOn'])) > 0) {
                            $startFrom = explode(" - ",$filter['addedOn'])[0];
                            $endTo = explode(" - ",$filter['addedOn'])[1];
                        }
                    } if(isset($filter['productName'])&&!empty($filter['productName'])) {
                        $productName = $filter['productName'];
                    }

                    if(isset($filter['medicalLine'])&&count($filter['medicalLine'])>0 && !empty($filter['medicalLine'])) {
                        $medicalLineIds = '{'.implode(',', $filter['medicalLine']).'}';
                    }

                    if(isset($filter['specialityId'])&&count($filter['specialityId'])>0 && !empty($filter['specialityId'])) {
                        $specialityIds = '{'.implode(',', $filter['specialityId']).'}';
                    } 
                    //calling db routine for filtering record with searching content
                    $arrList = AumetDBRoutines::searchDistributorIntresetsByFields($this->objCompany->ID,
                        !is_null($productName)?"'$productName'":'null', !is_null($medicalLineIds)?"'$medicalLineIds'":'null',!is_null($specialityIds)?"'$specialityIds'":'null', 
                        !is_null($startFrom)?"'$startFrom'":'null',!is_null($endTo)?"'$endTo'":'null');
                } else {
                    $arrList = AumetDBRoutines::getDistributorIntresetsByCompanyId($this->objCompany->ID);
                }
            } else {
                $arrList = AumetDBRoutines::getDistributorIntresetsByCompanyId($this->objCompany->ID);
            }
            $this->f3->set('arrList', $arrList);
            $this->webResponse->setData($arrList);
            echo $this->webResponse->getJSONResponse();
        }
    }

    public function getAddProducts()
    {
        if (!$this->f3->ajax()) {
            $this->renderLayout("myinterests/add-products");
        } else {
            $this->webResponse->setData(View::instance()->render("myinterestProducts/list.php"));
            echo $this->webResponse->getJSONResponse();
        }       
    }

    public function editProductsView()
    {
        if (!$this->f3->ajax()) {
            $this->renderLayout("myinterests/edit-list/".$this->f3->get("PARAMS.distributorInterestId"));
        } else {
            if($this->f3->exists('PARAMS.distributorInterestId')) {
                $distributorinteresetId = $this->f3->get("PARAMS.distributorInterestId");
                $this->f3->set('editTrue', true);
                $this->f3->set('distributorinteresetId', $distributorinteresetId);
                $this->webResponse->setData(View::instance()->render("myinterestProducts/list.php"));
            } else {
                $this->webResponse->setMessage("Invalid Call.");
            }
        }       
        echo $this->webResponse->getJSONResponse();
    }

    public function attachNewProducts()
    {
        if ($this->f3->ajax()) { 
            $msg = '';
            if($this->f3->exists('POST.selectedProducts') && $this->f3->exists("POST.breadCrumbs")) {
                $selectedProducts = $this->f3->get("POST.selectedProducts");
                $parentNodes = $this->f3->get("POST.breadCrumbs");
                global $dbConnectionAumet;
                if(is_array($selectedProducts) && is_array($parentNodes)) {
                        $distributor = AumetDBRoutines::getDistributorByCompanyID($this->objCompany->ID);                    
                        if(isset($distributor) && is_array($distributor)) {
                            try {
                                foreach ($selectedProducts as $item) {                               
                                    if($this->f3->exists('POST.editID')) {                           
                                        $dbDistInterest = new BaseModel($dbConnectionAumet, "production.DistributorIntreset");
                                        $dbDistInterest->getByField('"ID"', $this->f3->get('POST.editID'));
                                        if ($dbDistInterest->dry()) {
                                            $msg = 'Interested Item Not Found.'; 
                                        } else {
                                            $dbDistInterest->ScientificNameID = $item['ScientificNameID'];
                                            $dbDistInterest->UpdatedAt = $dbDistInterest->getCurrentDateTime();
                                            $dbDistInterest->UpdatedBy = $this->objUser->displayName;
                                            if (!$dbDistInterest->update()) {
                                                $msg = 'Interested Item Updated. Failed.'; 
                                            }  else {
                                                $msg = 'Interested Item Updated. Successfully.'; 
                                            }
                                        }
                                    } else  {                                    
                                        $distributorintereset = new DistributorInterest();                                    
                                        $distributorintereset->ScientificNameID = $item['ScientificNameID'];
                                        $distributorintereset->MedicalLineID = $parentNodes[0]['id'];
                                        $distributorintereset->SpecialtiyID = $parentNodes[1]['id'];
                                        $distributorintereset->DistributorCountryID = $this->objCountry->ID;
                                        $distributorintereset->CompanyID = $this->objCompany->ID;
                                        $distributorintereset->DistributorID = $distributor[0]["ID"];
                                        $distributorintereset->CreatedBy = $this->objUser->displayName;
                                        $distributorintereset->IsFilled = false;
                                        $distributorintereset->CreatedAt = $distributorintereset->getCurrentDateTime();
                                        $distributorintereset->save();
                                        $msg = 'Interested Items Created. Successfully.'; 
                                    }    
                                }
                                $this->webResponse->setMessage($msg);
                            } catch (Exception $e){
                                $this->webResponse->setMessage($e->getMessage());
                            }
                        }
                    }
                } else {
                    $this->webResponse->setMessage("Invalid Call.");
                }
        }
        echo $this->webResponse->getJSONResponse();
    }

    public function loadSelectedScientificNamesNyDistributorInterestID()
    {
        if ($this->f3->ajax()) {
            if($this->f3->exists('PARAMS.distributorInterestId')) {
                $distributorinteresetId = $this->f3->get("PARAMS.distributorInterestId");                
                $scientificNameList = AumetDBRoutines::getScientificNameByDistributorInterest($distributorinteresetId);                                           
                $this->f3->set('scientificNameList', $scientificNameList);
                $this->webResponse->setData($scientificNameList);
            } else {
                $this->webResponse->setMessage("Invalid Call.");
            }
        }           
        echo $this->webResponse->getJSONResponse();
    }

    public function deattachProduct() {
        global $dbConnectionAumet;
        if ($this->f3->ajax()) {
            if($this->f3->exists('PARAMS.distributorInterestId')) {
                $dbDistInterest = new BaseModel($dbConnectionAumet, "production.DistributorIntreset");
                $dbDistInterest->getByField('"ID"', $this->f3->get("PARAMS.distributorInterestId"));
                        if ($dbDistInterest->dry()) {
                            $this->webResponse->setMessage("Interested Item Not Found.");
                        }
                $dbDistInterest->DeletedAt = $dbDistInterest->getCurrentDateTime();
                $dbDistInterest->DeletedBy = $this->objUser->displayName;
                        if (!$dbDistInterest->update()) {
                            $this->webResponse->setMessage("Interested Item Not Deleted.");  
                        } else {
                            $this->webResponse->setMessage("Interested Item Deleted.");
                        }
            } else {
                $this->webResponse->setMessage("Invalid Call.");
            }
        }
        echo $this->webResponse->getJSONResponse();           
    }
    
}