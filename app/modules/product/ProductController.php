<?php


class ProductController extends Controller
{
    const error_unknownScientificName = 10;

    function getMyProducts()
    {
        if (!$this->f3->ajax()) {
            $this->renderLayout('myproducts');
        } else {

            $this->webResponse->setData(View::instance()->render("products/myProducts.php"));

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getMyProductsList()
    {
        $data = AumetDBRoutines::getManufacturerProductsByCompanyId($this->objCompany->ID);

        $datatable = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $_REQUEST);
        $allData = $data;
        // search filter by keywords
        $filter = isset($datatable['query']['generalSearch']) && is_string($datatable['query']['generalSearch'])
            ? $datatable['query']['generalSearch'] : '';
        if (!empty($filter)) {
            $data = array_filter($data, function ($a) use ($filter) {
                return (bool)preg_grep("/$filter/i", (array)$a);
            });
            unset($datatable['query']['generalSearch']);
        }

        // filter by field query
        $query = isset($datatable['query']) && is_array($datatable['query']) ? $datatable['query'] : null;
        if (is_array($query)) {
            $query = array_filter($query);
            foreach ($query as $key => $val) {
                $data = list_filter($data, [$key => $val]);
            }
        }

        $sort  = !empty($datatable['sort']['sort']) ? $datatable['sort']['sort'] : 'asc';
        $field = !empty($datatable['sort']['field']) ? $datatable['sort']['field'] : 'productId';

        $page    = !empty($datatable['pagination']['page']) ? (int)$datatable['pagination']['page'] : 1;
        $perpage = !empty($datatable['pagination']['perpage']) ? (int)$datatable['pagination']['perpage'] : -1;

        $pages = 1;
        $total = count($data); // total items in array

        // sort ...

        // $perpage 0; get all data
        if ($perpage > 0) {
            $pages  = ceil($total / $perpage); // calculate total pages
            $page   = max($page, 1); // get 1 page when $_REQUEST['page'] <= 0
            $page   = min($page, $pages); // get last page when $_REQUEST['page'] > $totalPages
            $offset = ($page - 1) * $perpage;
            if ($offset < 0) {
                $offset = 0;
            }

            $data = array_slice($data, $offset, $perpage, true);
        }

        $meta = [
            'page'    => $page,
            'pages'   => $pages,
            'perpage' => $perpage,
            'total'   => $total,
        ];


        // if selected all records enabled, provide all the ids
        if (isset($datatable['requestIds']) && filter_var($datatable['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
            $meta['rowIds'] = array_map(function ($row) {
                foreach ($row as $first) break;
                return $first;
            }, $allData);
        }


        $result = [
            'meta' => $meta + [
                    'sort'  => $sort,
                    'field' => $field,
                ],
            'data' => $data,
        ];

        echo json_encode($result);
    }

    function getProductImages()
    {
        $productId = $this->f3->get('PARAMS.productId');
        if (!$this->f3->ajax()) {
            $this->reroute("myproducts/$productId");
        } else {
            $this->f3->set('arrProductImage', (new ProductImage())->getByProductId($productId));
            $this->webResponse->setData(View::instance()->render("products/images.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getEditProduct()
    {
        $productId = $this->f3->get('PARAMS.productId');

        if (!$this->f3->ajax()) {
            $this->renderLayout("myproducts/$productId/edit");
        } else {
            $objProduct = AumetDBRoutines::getProductById($productId);
            if($objProduct->companyId != $this->objCompany->ID){
                $this->webResponse->setErrorCode(403);
            }
            else {
                $objProduct->arrSoldToIds = $objProduct->soldToIds != null ? explode(',',trim(trim($objProduct->soldToIds, '{'), '}')) : [];
                $arrSoldTo = (new AumetLookUp())->getAllSoldTo();
                foreach ($arrSoldTo as $objItem){
                    $objItem->isSelected = false;
                    foreach ($objProduct->arrSoldToIds as $iSelectedValue){
                        if($objItem->Value == $iSelectedValue){
                            $objItem->isSelected = true;
                            break;
                        }
                    }
                }
                $this->f3->set('arrSoldTo', $arrSoldTo);
                $this->f3->set('arrProductImage', (new ProductImage())->getByProductId($productId));
                $this->f3->set('arrProductCatalog', (new ProductRange())->getByCompanyId($objProduct->companyId));
                $this->f3->set('arrProductHighlight', (new ProductHighlight())->getByProductId($productId));
                $this->f3->set('objProduct', $objProduct);

                $this->f3->set('isEdit', true);
                $this->webResponse->setData(View::instance()->render("products/addEditForm.php"));
            }

            echo $this->webResponse->getJSONResponse();
        }
    }

    function postEditProduct()
    {
        $productId = $this->f3->get('PARAMS.productId');

        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {

            $objProduct = AumetDBRoutines::getProductById($productId);
            if($objProduct->companyId != $this->objCompany->ID){
                $this->webResponse->setErrorCode(403);
            }
            else {
                $scientificId = $this->f3->get('POST.scientificId');
                $objSN = new ScientificName();
                if(is_numeric($scientificId)){
                    $objSN->getById($scientificId);
                    if($objSN->dry()){
                        $this->webResponse->setMessage("Unknown Scientific Name");
                        $this->webResponse->setErrorCode(ProductController::error_unknownScientificName);
                        echo $this->webResponse->getJSONResponse();
                        return;
                    }
                }


                $dbProduct = new Product();
                $dbProduct->getById($productId);
                $dbProduct->productTitle = $this->f3->get('POST.title');
                $dbProduct->productSubtitle = $this->f3->get('POST.subTitle');
                $dbProduct->productDescription = $this->f3->get('POST.description');
                $dbProduct->scientificId = $scientificId;
                $dbProduct->productrangeId = $this->f3->get('POST.productRangeId');
                $strSelectBuyers = "";
                $arrSelectBuyers = $this->f3->get('POST.selectBuyers');
                if ($arrSelectBuyers && is_array($arrSelectBuyers)) {

                    $strSelectBuyers = implode(',', $arrSelectBuyers);
                }

                $dbProduct->SoldToIds = "{".$strSelectBuyers."}";

                (new ProductHighlight())->deleteByProductId($productId);
                $arrProductHighlights = $this->f3->get("POST.productHighlights");
                if(is_array($arrProductHighlights)) {
                    foreach ($arrProductHighlights as $highlight) {
                        $obj = new ProductHighlight();
                        $obj->productId = $productId;
                        $obj->highlight = $highlight['highlight'];
                        $obj->insert();
                    }
                }

                $isError = false;
                if($_FILES['productBaseImage'] != null && $_FILES['productBaseImage'] != ""){

                    $objResult = AumetFileUploader::upload("s3", $_FILES['productBaseImage'], $this->generateRandomString(56));
                    if($objResult->isError){

                        $this->webResponse->setData($objResult);
                        $this->webResponse->setErrorCode(500);
                        $this->webResponse->setMessage("Failed to save product base image");
                        $isError = true;
                    }
                    else {
                        if($objResult->isUploaded) {
                            $dbProduct->baseImage = $objResult->fileLink;
                        }
                    }

                }

                if(!$isError){
                    $dbProduct->update();

                    $arrProductImageRemove = $this->f3->get('POST.productImageRemove');
                    if(is_array($arrProductImageRemove)){
                        $removeIds = "";
                        foreach ($arrProductImageRemove as $id => $val){
                            if($val == 1){
                                $removeIds .= "$id,";
                            }
                        }
                        if($removeIds != "") {
                            $removeIds = trim($removeIds, ",");
                            (new ProductImage())->bulkDelete("id in ($removeIds)");
                        }
                    }
                }

            }


        }
        echo $this->webResponse->getJSONResponse();
    }

    function postEditProductImageGallery(){

        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {
            $productId = $this->f3->get('PARAMS.productId');
            $objProduct = AumetDBRoutines::getProductById($productId);

            $objResult = AumetFileUploader::upload("s3", $_FILES['file'], $this->generateRandomString(56));

            if (!$objResult->isError) {
                if($objResult->isUploaded) {
                    $objProductImage = new ProductImage();
                    $objProductImage->image_url = $objResult->fileLink;
                    $objProductImage->productId = $productId;
                    $objProductImage->image_name = $objResult->fileName;
                    $objProductImage->image_title = $objProduct->title;
                    $objProductImage->insert();
                }

                $this->webResponse->setMessage("Company information updated successfully");
            } else {
                $this->webResponse->setErrorCode(99);
                $this->webResponse->setMessage("Failed to upload");
            }

            echo $this->webResponse->getJSONResponse();
        }
    }

    function getAddProduct()
    {
        if (!$this->f3->ajax()) {
            $this->renderLayout("myproducts/add");
        } else {
            $this->f3->set('isEdit', false);
            $this->f3->set('arrSoldTo', (new AumetLookUp())->getAllSoldTo());
            $this->f3->set('arrProductImage', []);
            $this->f3->set('arrProductCatalog', []);
            $this->f3->set('arrProductHighlight', []);
            $this->webResponse->setData(View::instance()->render("products/addEditForm.php"));
            echo $this->webResponse->getJSONResponse();
        }
    }

    function postAddProduct()
    {
        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {
            $scientificId = $this->f3->get('POST.scientificId');
            $objSN = new ScientificName();
            if (is_numeric($scientificId)) {
                $objSN->getById($scientificId);
                if ($objSN->dry()) {
                    $this->webResponse->setMessage("Unknown Scientific Name");
                    $this->webResponse->setErrorCode(ProductController::error_unknownScientificName);
                    echo $this->webResponse->getJSONResponse();
                    return;
                }
            }

            $dbProduct = new Product();
            $dbProduct->productTitle = $this->f3->get('POST.title');
            $dbProduct->productSubtitle = $this->f3->get('POST.subTitle');
            $dbProduct->productDescription = $this->f3->get('POST.description');
            $dbProduct->scientificId = $scientificId;
            $dbProduct->manufacturerId = $this->objCompany->ID;
            $dbProduct->productrangeId = $this->f3->get('POST.productRangeId');

            $strSelectBuyers = "";
            $arrSelectBuyers = $this->f3->get('POST.selectBuyers');
            if ($arrSelectBuyers && is_array($arrSelectBuyers)) {

            $strSelectBuyers = implode(',', $arrSelectBuyers);
        }

            $dbProduct->SoldToIds = "{".$strSelectBuyers."}";

            $objProduct = $dbProduct->addAndLoadById();

            if($objProduct){

                $arrProductHighlights = $this->f3->get("POST.productHighlights");
                if(is_array($arrProductHighlights)) {
                    foreach ($arrProductHighlights as $highlight){
                        $obj = new ProductHighlight();
                        $obj->productId = $objProduct->id;
                        $obj->highlight = $highlight['highlight'];
                        $obj->insert();
                    }
                }


                if($_FILES['productBaseImage']){
                    $objResult = AumetFileUploader::upload("s3", $_FILES['productBaseImage'], $this->generateRandomString(56));
                    if($objResult->isError){
                        $this->webResponse->setErrorCode(500);
                        $this->webResponse->setMessage("Failed to save product base image");
                    }
                    else {
                        if($objResult->isUploaded) {
                            $dbProduct->baseImage = $objResult->fileLink;
                        }
                        $dbProduct->update();
                        $this->webResponse->setData($objProduct->id);
                    }
                }
            }
            else {
                $this->webResponse->setErrorCode(500);
                $this->webResponse->setMessage("Failed to save product in database");
                $this->webResponse->setData($dbProduct->getException());

            }

        }
        echo $this->webResponse->getJSONResponse();
    }

    function postDeleteProduct()
    {
        $productId = $this->f3->get('PARAMS.productId');

        if (!$this->f3->ajax()) {
            $this->webResponse->setErrorCode(500);
        } else {

            $objProduct = AumetDBRoutines::getProductById($productId);
            if($objProduct->companyId != $this->objCompany->ID){
                $this->webResponse->setErrorCode(403);
            }
            else {
                $dbProduct = new Product();
                $dbProduct->getById($productId);
                $dbProduct->DeletedAt = date('Y-m-d H:i:s');
                $dbProduct->update();
                $this->webResponse->setMessage('Your product has been deleted');
            }
        }
        echo $this->webResponse->getJSONResponse();
    }

    function getInlineProductProfile(){
        $id = $this->f3->get("PARAMS.productId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("browse/product/$id");
        } else {

            $objProductProfile = new ProductProfile();
            if($objProductProfile->loadIntoF3($id)){
                $this->webResponse->setData(View::instance()->render("products/profileInline.php"));
            }
            else{
                $this->webResponse->setData(View::instance()->render("products/404.php"));
            }
            echo $this->webResponse->getJSONResponse();
        }
    }

    function getViewProduct(){
        $id = $this->f3->get("PARAMS.productId");
        if (!$this->f3->ajax()) {
            $this->renderLayout("myproducts/$id");
        } else {
            $objProductProfile = new ProductProfile();
            if($objProductProfile->loadIntoF3($id)){
                $this->f3->set("backURL", 'myproducts');
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
