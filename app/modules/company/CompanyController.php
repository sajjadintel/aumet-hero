<?php

class CompanyController extends Controller
{
    function getManufacturersPage(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("manufacturers");
        } else {
            $this->webResponse->setData(View::instance()->render("companies/manufacturers.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getManufacturersRecords()
    {
        echo json_encode(
            $this->getDatatable((new Company()), '"Type"=\'manufacturer\'')
        );
    }

    function getDistributorsPage(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("distributors");
        } else {
            $arrCountries = [];
            $speciallities = (new Speciality())->all();
            $arrCountries = (new Country())->getAll();

            $arrMedicalLines = AumetDBRoutines::GetMedicalLineWithScientificNamesCount();

            $this->f3->set('arrCountries', $arrCountries);
            $this->f3->set('speciallities', $speciallities);
            $this->f3->set('arrMedicalLines', $arrMedicalLines);
            $pagination = $_REQUEST['pagination'];
            $sort = $_REQUEST['sort'];
            $this->f3->set('pagination', $pagination);
            $this->f3->set('sort', $sort);
            $this->webResponse->setData(View::instance()->render("companies/distributors.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getDistributorsRecords()
    {
        $where = '';
        $name = $this->f3->get('POST.Name');
        if($name){
            $where .='"Name" ilike \'%'.$name.'%\'';
        }
//echo $where;exit;
//        $where = '"Name"=\'manufacturer\'';
        $distributors = ['data'=>[]];
        if($where) {
            $distributors = $this->getDatatable((new Distributors()), $where);
        }else{
            $distributors = $this->getDatatable((new Distributors()));
        }


        echo json_encode(
            $distributors
        );
    }

    function loadCompanyProfile($companyId){
        $objCompany = (new Company())->getById($companyId);
        if($objCompany) {
            if($objCompany->Type == Company::TYPE_MANUFACTURER) {
                $this->f3->set('objManufacturerCompany', $objCompany);
                $this->f3->set('objInchargePerson', (new AumetUser())->getInchargePerson( $companyId));
                $this->f3->set('arrCatalogs', (new ProductRange())->getByCompanyId($companyId));
                $this->f3->set('arrCompanyPhotos', (new CompanyFile())->getCompanyPhotos($companyId));
                $this->f3->set('arrCompanyDocuments', (new CompanyFile())->getCompanyDocuments($companyId));
                $this->f3->set('arrManufacturerSpecialities', AumetDBRoutines::getManufacturerSpecialities($companyId));
                $this->f3->set('manufacturerId', $companyId);
                $this->f3->set('totalProducts', count(AumetDBRoutines::getManufacturerProductsByCompanyId($companyId)));
                $this->f3->set('objCompanyCountry', (new Country())->getById($objCompany->CountryID));
                $this->f3->set('enableEdit', false);
                $this->f3->set("arrSuggestedDistributors", (new PotentialConnection())->getAvailableConnections($companyId));
                if($this->isAuth){
                    if($this->objCompany->ID == $companyId) {
                        $this->f3->set('enableEdit', true);
                    }
                }
                $this->f3->set('userEmail', $this->objUser->email);
                $this->webResponse->setData(View::instance()->render("companyprofile/manufacturer.php"));
                return true;
            }
            elseif ($objCompany->Type == Company::TYPE_DISTRIBUTOR){
                $this->f3->set('objDistributorCompany', $objCompany);
                $this->f3->set('objInchargePerson', (new AumetUser())->getInchargePerson( $companyId));
                $this->f3->set('arrCatalogs', (new ProductRange())->getByCompanyId($companyId));
                $this->f3->set('arrCompanyPhotos', (new CompanyFile())->getCompanyPhotos($companyId));
                $this->f3->set('arrCompanyDocuments', (new CompanyFile())->getCompanyDocuments($companyId));
                $this->f3->set('arrDistributorSpecialities', AumetDBRoutines::getDistributorExperiencesSpecialitiesByCompanyId($companyId));
                $this->f3->set('objCompanyCountry', (new Country())->getById($objCompany->CountryID));
                $this->f3->set('totalProducts', 0);
                $this->f3->set('distributorId', $companyId);
                /*$arrDistributorManufacturerBrand = (new DistributorManufacturerBrand())->getByDistributorCompanyId($companyId);
                foreach ($arrDistributorManufacturerBrand as $objDistributorManufacturer){
                    $objDistributorManufacturer->arrProducts = AumetDBRoutines::
                }*/

                $this->f3->set('enableEdit', false);
                $this->f3->set('enableSendIntroduction', false);
                $this->webResponse->setData(View::instance()->render("companyprofile/distributor.php"));
                return true;
            }
        }
        else {
            $this->webResponse->setData(View::instance()->render("errors/404.php"));
            return false;
        }

    }

    function getManufacturerCompanyProfile(){
        $companyId = $this->f3->get("PARAMS.companyId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("manufacturers/$companyId");
        } else {

            $this->loadCompanyProfile($companyId, 'Manufacturer');
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getDistributorCompanyProfile(){
        $companyId = $this->f3->get("PARAMS.companyId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("distributors/$companyId");
        } else {

            $this->loadCompanyProfile($companyId, 'Distributor');
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditMyCompanyProfile(){
        if (!$this->f3->ajax()) {
            $this->renderLayout("mycompanyprofile/edit");
        } else {
            $this->objCompany = (new AumetCompany())->reloadCompany($this->objCompany->ID);
            $this->webResponse->setData(View::instance()->render("companyprofile/manufacturerEdit.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditMyCompanyProfileSection_CompanyInformation(){
        if (!$this->f3->ajax()) {
            $this->f3->reroute("/en/mycompanyprofile/edit");
        } else {
            $this->f3->set('arrCountries', (new Country())->all("Name asc"));

            $this->webResponse->setData(View::instance()->render("companyprofile/sections/companyInformation.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postEditMyCompanyProfileSection_CompanyInformation(){
        if ($this->f3->ajax()) {

            $objResult = AumetFileUploader::upload("s3", $_FILES['Logo'], $this->generateRandomString(64));
            if($objResult->isError){
                $this->webResponse->setData($objResult);
                $this->webResponse->setErrorCode(500);
                $this->webResponse->setMessage("Failed to save logo");
            }
            else {

                    $objCompany = new Company();
                    $objCompany->getById($this->objCompany->ID);
                    $objCompany->copyfrom("POST");
                    if($objResult->isUploaded) {
                        $objCompany->Logo =$objResult->fileLink;
                    }
                    $objCompany->update();

                    $this->objCompany = (new AumetCompany())->reloadCompany($this->objCompany->ID);

                    $this->webResponse->setMessage("Company information updated successfully");

            }

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditMyCompanyProfileSection_PersonalInformation(){
        if (!$this->f3->ajax()) {
            $this->f3->reroute("/en/mycompanyprofile/edit");
        } else {

            $dbUser = new AuthUser();
            $objUser = $dbUser->getById($this->objUser->id);
            $this->f3->set('SESSION.objUser', $objUser);


            $this->webResponse->setData(View::instance()->render("companyprofile/sections/personalInformation.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postEditMyCompanyProfileSection_PersonalInformation(){
        if ($this->f3->ajax()) {
            $objResult = AumetFileUploader::upload("s3", $_FILES['profilePhoto'], $this->generateRandomString(64));
            if($objResult->isError){
                $this->webResponse->setData($objResult);
                $this->webResponse->setErrorCode(500);
                $this->webResponse->setMessage("Failed to save logo");
            }

            //$fileTmpPath = $_FILES['profilePhoto']['tmp_name'];
            //$fileName = $_FILES['profilePhoto']['name'];
            //$fileSize = $_FILES['profilePhoto']['size'];
            //$fileType = $_FILES['profilePhoto']['type'];
            //$fileNameCmps = explode(".", $fileName);
            //$fileExtension = strtolower(end($fileNameCmps));

            //$targetFileName = "u-".$this->objUser->id ."-". $this->generateRandomString(16). ".".$fileExtension;
            //$targetFilePath = $this->f3->get('uploadDIR') . $targetFileName;
            //if(isset($_FILES["profilePhoto"]) && isset($_FILES["profilePhoto"]["tmp_name"]) && !empty($_FILES["profilePhoto"]["tmp_name"])) {
            //    move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFilePath);
            //}    
                $dbUser = new AuthUser();
                $dbUser->getById($this->objUser->id);
                $dbUser->copyfrom("POST");                
                if($objResult->isUploaded) {
                    $dbUser->photoUrl = $objResult->fileLink;
                }
                $dbUser->displayName = $this->f3->get('POST.firstName').' '.$this->f3->get('POST.lastName');
                $dbUser->update();

                $objUser = $dbUser->getById($this->objUser->id);
                $this->f3->set('SESSION.objUser', $objUser);

                //$this->objCompany = (new AumetCompany())->reloadCompany($this->objCompany->ID);

                $this->webResponse->setMessage("Personal information updated successfully");
            //} else {
            //    $this->webResponse->setErrorCode(99);
            //    $this->webResponse->setMessage("Company logo failed to upload: $targetFileName");
            //}

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditMyCompanyProfileSection_BusinessInformation(){
        if (!$this->f3->ajax()) {
            $this->f3->reroute("/en/mycompanyprofile/edit");
        } else {
            global $dbConnectionAumet;
            $dbMedicalLines = new BaseModel($dbConnectionAumet, 'onex.medicalLine');
            $arrMedicalLines = $dbMedicalLines->all();            
            $this->f3->set('arrMedicalLines', $arrMedicalLines);
            $dbSpeciality = new BaseModel($dbConnectionAumet, 'setup.Speciality');
            $arrSpeciality = $dbSpeciality->all();
            $this->f3->set('arrSpeciality', $arrSpeciality);              
            $savedMedicallines = $savedSpecialities = [];
            $dbCompanyExperience = new BaseModel($dbConnectionAumet, "onex.companyExperience");
            $arrCompanyExperience = $dbCompanyExperience->getByField('companyid', $this->objCompany->ID);
            if(!$dbCompanyExperience->dry() && !is_null($arrCompanyExperience)){ 
                $savedSpecialities = explode(',',$arrCompanyExperience->SpecialtiyID);
                $savedMedicallines = explode(',',$arrCompanyExperience->MedicalLineID);
            }            

            $this->f3->set('arrSavedSpeciality', $savedSpecialities);                
            $this->f3->set('arrSavedMedicalLines', $savedMedicallines);

            $this->webResponse->setData(View::instance()->render("companyprofile/sections/businessInformation.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postEditMyCompanyProfileSection_BusinessInformation(){
        if ($this->f3->ajax()) {
            $objCompany = new Company();
            $objCompany->getById($this->objCompany->ID);
            $objCompany->copyfrom("POST");
            $objCompany->update();
            global $dbConnectionAumet;
            $medicallines = $specialities = null;
            if($this->f3->exists('POST.medicallines')) {                             
                $medicallines = implode(',',$this->f3->get('POST.medicallines'));
            }
            if($this->f3->exists('POST.specialities')) {
                $specialities = implode(',',$this->f3->get('POST.specialities'));
            }

            $objCompanyExperience = new BaseModel($dbConnectionAumet, "onex.companyExperience");
            $objCompanyExperience->getByField('CompanyID', $this->objCompany->ID);
            $objCompanyExperience->MedicalLineID = $medicallines;
            $objCompanyExperience->SpecialtiyID = $specialities;            
                    if(!$objCompanyExperience->dry()) {                     
                        $objCompanyExperience->UpdatedAt = $objCompanyExperience->getCurrentDateTime();
                        $objCompanyExperience->UpdatedBy = $this->objUser->displayName;
                        $objCompanyExperience->update();                        
                    } else {
                        $objCompanyExperience->companyid = $this->objCompany->ID;
                        $objCompanyExperience->CreatedBy = $this->objUser->displayName;                        
                        $objCompanyExperience->CreatedAt = $objCompanyExperience->getCurrentDateTime();
                        $objCompanyExperience->insert();
                    }
           
            $this->objCompany = (new AumetCompany())->reloadCompany($this->objCompany->ID);

            $this->webResponse->setMessage("Company information updated successfully");

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditMyCompanyProfileSection_Documents(){
        if (!$this->f3->ajax()) {
            $this->f3->reroute("/en/mycompanyprofile/edit");
        } else {
            $this->f3->set('arrCompanyProfiles', (new CompanyFile())->getCompanyProfiles($this->objCompany->ID));
            $this->f3->set('arrCompanyRegistrationDocuments', (new CompanyFile())->getCompanyRegistrationDocuments($this->objCompany->ID));
            $this->f3->set('arrCompanyOtherDocuments', (new CompanyFile())->getCompanyOtherDocuments($this->objCompany->ID));
            $this->f3->set('arrCompanyCatalogs', (new CompanyFile())->getCompanyCatalogs($this->objCompany->ID));
            $this->f3->set('arrCompanyMaketingMaterials', (new CompanyFile())->getCompanyMaketingMaterial($this->objCompany->ID));
            $this->webResponse->setData(View::instance()->render("companyprofile/sections/documents.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditMyCompanyProfileSection_Pictures(){
        if (!$this->f3->ajax()) {
            $this->f3->reroute("/en/mycompanyprofile/edit");
        } else {
            $this->webResponse->setData(View::instance()->render("companyprofile/sections/pictures.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getMyCompanyProfileSection_PicturesList()
    {
        if (!$this->f3->ajax()) {
            $this->f3->reroute("/en/mycompanyprofile/edit");
        } else {
            $this->f3->set('arrCompanyPhotos', (new CompanyFile())->getCompanyPhotos($this->objCompany->ID));
            $this->webResponse->setData(View::instance()->render("companyprofile/sections/picturesList.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postMyCompanyProfileSection_UploadPictures(){
        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {

            $objResult = AumetFileUploader::upload("s3", $_FILES['file'], $this->generateRandomString(56));

            if (!$objResult->isError) {
                if($objResult->isUploaded) {
                    $objCompanyFile = new CompanyFile();
                    $objCompanyFile->Link = $objResult->fileLink;
                    $objCompanyFile->companyid = $this->objCompany->ID;
                    $objCompanyFile->Type =  3;
                    $objCompanyFile->Deleted =  false;
                    $objCompanyFile->insert();
                    $this->webResponse->setData($objResult);
                }
            } else {
                $this->webResponse->setErrorCode(99);
                $this->webResponse->setMessage($objResult->error);
            }

            echo $this->webResponse->getJSONResponse();
        }
    }

    function postMyCompanyProfileSection_RemovePicture(){
        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {

            $objCompanyFile = new CompanyFile();
            $objCompanyFile->getById($this->f3->get('PARAMS.photoId'));
            $objCompanyFile->Deleted =  true;
            $objCompanyFile->update();

            echo $this->webResponse->getJSONResponse();
        }
    }

    function postMyCompanyProfileSection_UploadBanner(){
        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {

            $objResult = AumetFileUploader::upload("s3", $_FILES['companyBanner'], $this->generateRandomString(56));

            if (!$objResult->isError) {
                if($objResult->isUploaded) {
                    $objCompany = new Company();
                    $objCompany->getById($this->objCompany->ID);
                    if($objResult->isUploaded) {
                        $objCompany->Banner =$objResult->fileLink;
                    }
                    $objCompany->update();

                    $this->objCompany = (new AumetCompany())->reloadCompany($this->objCompany->ID);
                }
            } else {
                $this->webResponse->setErrorCode(99);
                $this->webResponse->setMessage($objResult->error);
            }
            $this->webResponse->setData($objResult);


            echo $this->webResponse->getJSONResponse();
        }
    }

    function postEditMyCompanyProfileSection_UploadDocument(){
        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {

            $objResult = AumetFileUploader::upload("s3", $_FILES['file'], $this->generateRandomString(56));

            if (!$objResult->isError) {
                if($objResult->isUploaded) {

                    if($objResult->isUploaded) {
                        $objCompanyFile = new CompanyFile();
                        $objCompanyFile->Type = $this->f3->get('PARAMS.documentTypeId');
                        $objCompanyFile->Deleted = false;
                        $objCompanyFile->companyid = $this->objCompany->ID;
                        $objCompanyFile->Link = $objResult->fileLink;
                        $objCompanyFile->description = $objResult->fileName;
                        $objCompanyFile->addReturnID();
                    }
                }
            } else {
                $this->webResponse->setErrorCode(99);
                $this->webResponse->setMessage($objResult->error);
            }
            $this->webResponse->setData($objResult);


            echo $this->webResponse->getJSONResponse();
        }
    }

    function getMyCompanyProducts() {
        if ($this->f3->ajax()) {             
            $data = AumetDBRoutines::getManufacturerProductsByCompanyIdWithLimit($this->f3->get('PARAMS.manuId'), $this->f3->get('PARAMS.pagelimit'));
            $this->f3->set('arrProducts', $data);            
            if($data && count($data) == $this->f3->get('PARAMS.totalProducts')) {
                $this->webResponse->setMessage("No More Products Found!");
            }
            $this->webResponse->setData(View::instance()->render("companyprofile/sections/productsList.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getMyDistributroCompanyProducts() {
        if ($this->f3->ajax()) {             
            //$data = AumetDBRoutines::getManufacturerProductsByCompanyIdWithLimit($this->f3->get('PARAMS.manuId'), $this->f3->get('PARAMS.pagelimit'));
            $this->f3->set('arrProducts', []);            
            if($data && count($data) == $this->f3->get('PARAMS.totalProducts')) {
                $this->webResponse->setMessage("No More Products Found!");
            }
            $this->webResponse->setData(View::instance()->render("companyprofile/sections/productsList.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postMyCompanyProfileSection_RemoveFile(){
        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {
            if($this->f3->exists('PARAMS.fileId')) {
                $objCompanyFile = new CompanyFile();
                $objCompanyFile->getById($this->f3->get('PARAMS.fileId'));
                $objCompanyFile->Deleted =  true;
                $objCompanyFile->update();
            }
            echo $this->webResponse->getJSONResponse();
        }
    }
}
