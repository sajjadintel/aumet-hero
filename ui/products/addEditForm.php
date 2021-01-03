<form class="form" id="frmEditProduct" >
<div class="subheader subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <div class="d-flex flex-column text-dark-75">
                    <h1 class="text-dark font-weight-bolder mr-5 line-height-xl">
                        <span class="svg-icon svg-icon-xxl mr-1">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                    <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <?= $isEdit ? "Product: $objProduct->title" : "Add New Product" ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Save</button>
            <button type="button" class="btn btn-secondary mr-3" onclick="WebApp.loadPage('myproducts')">Cancel</button>
            <?php if($isEdit): ?>
                <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid pt-3">
    <div class="container-fluid">

            <div class="card card-custom card-stretch gutter-b">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 p-5">
                            <div class="form-group row">
                                <label class="font-size-h4 font-weight-bolder">Product Title:</label>
                                <input name="title" type="text" class="form-control" placeholder="" value="<?= $isEdit ? $objProduct->title : ""?>">
                            </div>

                            <div class="form-group row">
                                <label class="font-size-h4 font-weight-bolder">Product Sub Title:</label>
                                <textarea name="subTitle" class="form-control" rows="2"><?= $isEdit ? $objProduct->subTitle : ""?></textarea>
                            </div>
                            <div class="form-group row">
                                <label class="font-size-h4 font-weight-bolder">Product Scientific Name:</label>
                                <select class="form-control select2" id="scientificNameSelection" name="scientificId" >
                                    <option label="Label"></option>
                                    <option value="<?= $isEdit ? $objProduct->scientificNameId : "" ?>" selected><?= $isEdit ? $objProduct->scientificName : ""?></option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="font-size-h4 font-weight-bolder">Product Buyers:</label>
                                <select class="form-control select2" id="selectBuyers" name="selectBuyers[]" multiple="multiple" >
                                    <option label="Label"></option>
                                    <?php foreach ($arrSoldTo as $objSoldTo): ?>
                                        <option value="<?= $objSoldTo->Value ?>" <?php echo $objSoldTo->isSelected ? "selected" : "" ?> ><?= $objSoldTo->Name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="font-size-h4 font-weight-bolder">Product Description:</label>
                            </div>
                            <div class="form-group row">
                                <textarea id="productDescription" name="description" style="height: 270px"><?= $isEdit ? html_entity_decode($objProduct->description) : "" ?></textarea>
                            </div>
                            <div id="kt_repeater_2">
                                <div class="form-group row">
                                    <label class="font-size-h4 font-weight-bolder mb-4">Product Highlights:</label>
                                    <div data-repeater-list="productHighlights" class="col-12">
                                        <?php if($isEdit && count($arrProductHighlight)>0): ?>
                                            <?php foreach ($arrProductHighlight as $objHighlight): ?>
                                                <div data-repeater-item class="mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="la la-star"></i>
                                                    </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Enter a product highlight" value="<?= $objHighlight->highlight ?>" name="highlight"/>
                                                        <div class="input-group-append">
                                                            <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        <div data-repeater-item class="mb-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="la la-star"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Enter a product highlight"  name="highlight"/>
                                                <div class="input-group-append">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                        <i class="la la-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <div data-repeater-create="" class="btn font-weight-bold btn-outline-primary">
                                            <i class="la la-plus"></i>
                                            Add highlight
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-10">
                            <div class="form-group row">
                                <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Product Base Image</label>
                                <div class="col-12">
                                    <div class="image-input image-input-outline" id="productBaseImage" style="background-image: url(/assets/img/product.png)">
                                        <div class="image-input-wrapper" style="background-image: url('<?= $isEdit ? $objProduct->image : "" ?>')"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                            <i class="fa fa-pen icon-sm text-primary"></i>
                                            <input type="file" name="productBaseImage" accept=".png, .jpg, .jpeg"/>
                                            <input type="hidden" name="productBaseImageRemove"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Upload to Product Image Gallery</label>
                                <div class="col-12">
                                    <div class="dropzone dropzone-multi" id="productEditorPhotoGallery" style="min-height: auto !important">
                                        <div class="dropzone-panel mb-lg-0 mb-3">
                                            <a class="dropzone-select btn btn-outline-primary font-weight-bold mr-5">Attach files</a>
                                            <a class="dropzone-upload btn btn-primary font-weight-bold mr-5">Upload All</a>
                                            <a class="dropzone-remove-all btn btn-light font-weight-bold">Remove All</a>
                                        </div>
                                        <div class="dropzone-items">
                                            <div class="dropzone-item" style="display:none">
                                                <div class="dropzone-file">
                                                    <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                        <span data-dz-name="">some_image_file_name.jpg</span>
                                                        <strong>(
                                                            <span data-dz-size="">340kb</span>)</strong>
                                                    </div>
                                                    <div class="dropzone-error" data-dz-errormessage=""></div>
                                                </div>
                                                <div class="dropzone-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-toolbar">
                                                    <span class="dropzone-start">
                                                        <i class="flaticon2-arrow"></i>
                                                    </span>
                                                    <span class="dropzone-cancel" data-dz-remove="" style="display: none;">
                                                        <i class="flaticon2-cross"></i>
                                                    </span>
                                                    <span class="dropzone-delete" data-dz-remove="">
                                                        <i class="flaticon2-cross"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Product Image Gallery</label>
                                <div class="col-12" id="imageGalleryContainer">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Upload a Product Catalogue</label>
                                <div class="col-12">
                                    <div class="dropzone dropzone-multi" id="productEditorCatalogues" style="min-height: auto !important">
                                        <div class="dropzone-panel mb-lg-0 mb-3">
                                            <a class="dropzone-select btn btn-outline-primary font-weight-bold mr-5">Attach files</a>
                                            <a class="dropzone-upload btn btn-primary font-weight-bold mr-5">Upload All</a>
                                            <a class="dropzone-remove-all btn btn-light font-weight-bold">Remove All</a>
                                        </div>
                                        <div class="dropzone-items">
                                            <div class="dropzone-item" style="display:none">
                                                <div class="dropzone-file">
                                                    <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                        <span data-dz-name="">some_image_file_name.jpg</span>
                                                        <strong>(
                                                            <span data-dz-size="">340kb</span>)</strong>
                                                    </div>
                                                    <div class="dropzone-error" data-dz-errormessage=""></div>
                                                </div>
                                                <div class="dropzone-progress">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-toolbar">
                                                    <span class="dropzone-start">
                                                        <i class="flaticon2-arrow"></i>
                                                    </span>
                                                    <span class="dropzone-cancel" data-dz-remove="" style="display: none;">
                                                        <i class="flaticon2-cross"></i>
                                                    </span>
                                                    <span class="dropzone-delete" data-dz-remove="">
                                                        <i class="flaticon2-cross"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Product Catalogues</label>
                                <?php foreach ($arrProductCatalog as $item): ?>
                                <div class="col-9 col-form-label">
                                    <div class="radio-inline">
                                        <label class="radio radio-outline radio-outline-2x radio-primary">
                                            <input type="radio" name="productRangeId" value="<?= $item->id ?>" <?php echo $item->id == $objProduct->productRangeId ? "checked" : "" ?> />
                                            <span></span>
                                            <?= $item->name ?>
                                        </label>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
</form>

<script src="/theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>

<script>
    <?php if($isEdit): ?>
    function fnCallbackDeleteProduct(webResponse) {
        if(webResponse.errorCode == 0){
            WebApp.alertSuccess(webResponse.message);
            WebApp.loadPage('myproducts');
        }
        else {
            WebApp.alertError(webResponse.message);
        }
    }

    function fnConfirmDeleteProductCallback(callbackResponse){
        if(callbackResponse.isConfirmed == true){
            WebApp.post('myproducts/<?= $objProduct->id ?>/delete', null, fnCallbackDeleteProduct);
        }
    }
    function deleteProduct(){
        WebApp.alertConfirm("Please confirm that you want to delete this product", fnConfirmDeleteProductCallback);
    }
    <?php endif; ?>

    $('#kt_repeater_2').repeater({
        initEmpty: <?= $isEdit ? "false" : "true" ?>,

        defaultValues: {
        },

        show: function() {
            $(this).slideDown();
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        }
    });

    if (typeof ProductEditor === 'undefined') {
        let _productId = <?= $isEdit ? $objProduct->id : 0 ?>;

        let productEditorPhotoGallery = null;

        // Class definition
        let ProductEditor = function() {

            var _initBaseImage = function (){
                let productBaseImage = new KTImageInput('productBaseImage');
                productBaseImage.on('remove', function(imageInput) {

                });
            }

            var _initPhotoGallery = function () {
                <?php if($isEdit): ?>
                WebApp.loadPartialPage('#imageGalleryContainer', 'myproducts/'+_productId+'/images' );
                <?php endif; ?>

                // set the dropzone container id
                var id = '#productEditorPhotoGallery';

                // set the preview element template
                var previewNode = $(id + " .dropzone-item");
                previewNode.id = "";
                var previewTemplate = previewNode.parent('.dropzone-items').html();
                previewNode.remove();



                productEditorPhotoGallery = new Dropzone(id, { // Make the whole body a dropzone
                    url: '/en/myproducts/'+_productId+'/gallery/upload', // Set the url for your upload script location
                    parallelUploads: 20,
                    previewTemplate: previewTemplate,
                    maxFilesize: 100, // Max filesize in MB
                    autoQueue: false, // Make sure the files aren't queued until manually added
                    autoProcessQueue: false,
                    previewsContainer: id + " .dropzone-items", // Define the container to display the previews
                    clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.

                });

                productEditorPhotoGallery.on("addedfile", function(file) {
                    // Hookup the start button
                    file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { productEditorPhotoGallery.enqueueFile(file); };
                    $(document).find( id + ' .dropzone-item').css('display', '');
                });

                // Update the total progress bar
                productEditorPhotoGallery.on("totaluploadprogress", function(progress) {
                    $(this).find( id + " .progress-bar").css('width', progress + "%");
                });

                productEditorPhotoGallery.on("sending", function(file) {
                    // Show the total progress bar when upload starts
                    $( id + " .progress-bar").css('opacity', '1');
                    // And disable the start button
                    file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
                });

                // Hide the total progress bar when nothing's uploading anymore
                productEditorPhotoGallery.on("complete", function(progress) {
                    var thisProgressBar = id + " .dz-complete";
                    setTimeout(function(){
                        $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
                    }, 300)

                });

                // Setup the buttons for all transfers
                document.querySelector( id + " .dropzone-upload").onclick = function() {
                    productEditorPhotoGallery.enqueueFiles(productEditorPhotoGallery.getFilesWithStatus(Dropzone.ADDED));
                };

                // Setup the button for remove all files
                document.querySelector(id + " .dropzone-remove-all").onclick = function() {
                    $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
                    productEditorPhotoGallery.removeAllFiles(true);
                };

                // On all files completed upload
                productEditorPhotoGallery.on("queuecomplete", function(progress){
                    $( id + " .dropzone-upload").css('display', 'none');
                    WebApp.loadPartialPage('#imageGalleryContainer', 'myproducts/'+_productId+'/images' );
                    productEditorPhotoGallery.removeAllFiles(true);

                    <?php if($isEdit): ?>
                    WebApp.alertSuccess("Product has been edited successfully");
                    <?php else: ?>
                    WebApp.alertSuccess("A new product has been added successfully");
                    <?php endif; ?>
                    WebApp.loadPage('myproducts');

                });

                // On all files removed
                productEditorPhotoGallery.on("removedfile", function(file){
                    if(productEditorPhotoGallery.files.length < 1){
                        $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
                    }
                });

            }

            function fnCallbackEditProduct(webResponse){
                if(webResponse.errorCode == 0){
                    var arrFiles = productEditorPhotoGallery.getFilesWithStatus(Dropzone.ADDED);
                    if(arrFiles.length > 0) {
                        productEditorPhotoGallery.enqueueFiles(arrFiles);
                        productEditorPhotoGallery.processQueue();
                    }
                    else {
                        WebApp.alertSuccess("Product has been edited successfully");
                        WebApp.loadPage('myproducts');
                    }

                }
                else {
                    WebApp.alertError(webResponse.message);
                }
            }

            function fnCallbackAddProduct(webResponse){
                if(webResponse.errorCode == 0){
                    _productId = webResponse.data;

                    var arrFiles = productEditorPhotoGallery.getFilesWithStatus(Dropzone.ADDED);
                    if(arrFiles.length > 0) {
                        productEditorPhotoGallery.options.url = '/en/myproducts/'+_productId+'/gallery/upload';
                        productEditorPhotoGallery.enqueueFiles(arrFiles);
                        productEditorPhotoGallery.processQueue();
                    }
                    else {
                        WebApp.alertSuccess("A new product has been added successfully");
                        WebApp.loadPage('myproducts');
                    }

                }
                else {
                    WebApp.alertError(webResponse.message);
                }
            }

            // Private functions
            var _initProductDescription = function() {
                ClassicEditor
                    .create( document.querySelector( '#productDescription' ) )
                    .then( editor => {
                        //console.log( editor );
                    } )
                    .catch( error => {
                        //console.error( error );
                    } );
            }

            var _handleFormSubmit = function (){
                $('#frmEditProduct').submit(function ( e ) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    var frmValidate = FormValidation.formValidation(
                        document.getElementById('frmEditProduct'),
                        {
                            fields: {
                                title: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Product title is required'
                                        },
                                        stringLength: {
                                            min:3,
                                            max:100,
                                            message: 'Please enter a valid product title'
                                        }
                                    }
                                },
                                scientificId: {
                                    validators: {
                                        notEmpty: {
                                            message: 'Product scientific name is required'
                                        }
                                    }
                                }
                            },

                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                // Bootstrap Framework Integration
                                bootstrap: new FormValidation.plugins.Bootstrap(),
                            }
                        }
                    );

                    frmValidate.validate().then(function(status) {
                        // status can be one of the following value
                        // 'NotValidated': The form is not yet validated
                        // 'Valid': The form is valid
                        // 'Invalid': The form is invalid
                        if(status == 'Valid') {

                            <?php if($isEdit): ?>
                            WebApp.postFormData('#frmEditProduct','myproducts/<?= $objProduct->id ?>/edit', formData, fnCallbackEditProduct);
                            <?php else: ?>
                            WebApp.postFormData('#frmEditProduct','myproducts/add', formData, fnCallbackAddProduct);
                            <?php endif; ?>
                        }
                    });


                });
            }

            var _initSelect2 = function (){
                $("#scientificNameSelection").select2({
                    placeholder: 'Search for scientific names',
                    allowClear: true,
                    ajax: {
                        url: "/en/api/select/search/scientificnames",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term, // search term
                                page: params.page
                            };
                        },
                        processResults: function(webResponse, params) {

                            params.page = params.page || 1;

                            return {
                                results: webResponse.data.items,
                                pagination: {
                                    more: (params.page * 30) < webResponse.data.totalCount
                                }
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    minimumInputLength: 1,
                    tags: true,
                    templateResult: function (item) {
                        return item.text;
                    },
                    templateSelection: function (item) {
                        return item.text;
                    }
                });

                $('#selectBuyers').select2({
                    placeholder: "Select Buyers",
                });
            }
            return {
                // public functions
                init: function() {
                    _initSelect2();
                    _initProductDescription();
                    _initBaseImage();
                    _initPhotoGallery();
                    _handleFormSubmit();
                }
            };
        }();

        ProductEditor.init();
    }
    else {
        _productId = <?= $isEdit ? $objProduct->id : 0 ?>;

        productEditorPhotoGallery = null;

        ProductEditor.init();
    }



</script>
