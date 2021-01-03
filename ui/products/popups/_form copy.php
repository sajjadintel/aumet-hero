<?php
/**
 * @var array $arrSpecialty
 * @var array $arrMedicalLine
 */
?>

<form method="POST" id="frmProductForm" enctype="multipart/form-data">
    <div class="modal-header">
        <h5 class="modal-title" id="popupModalTitle">Add a Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body align-items-stretch">
        <div class="row">
            <div class="col-12">
                <span class="sub-text">Fill the following information to add a new product</span>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group row">
                    <label for="product-name" class="col-12 col-form-label">Product name</label>
                    <div class="col-12">
                        <input id="product-name" class="form-control" type="text" value="" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product-subtitle" class="col-12 col-form-label">Subtitle</label>
                    <div class="col-12">
                        <input id="product-subtitle" class="form-control" type="text" value="" name="subtitle">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group row">
                    <label for="product-description" class="col-12 col-form-label">Description</label>
                    <div class="col-12">
                        <textarea id="product-description" class="form-control" rows="5" type="text" name="description"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group row">
                    <label for="product-scientific-name" class="col-12 col-form-label">Scientific name</label>
                    <div class="col-12">
                        <input id="product-scientific-name" class="form-control" type="text" value="" name="scientific_name">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group row">
                    <label for="product-specialty" class="col-12 col-form-label">Product specialty</label>
                    <div class="col-12">
                        <select id="product-specialty" class="form-control select2" name="specialty" >
                            <?php foreach ($arrSpecialty as $key => $specialty): ?>
                                <option value='<?=$key?>'><?=$specialty?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product-medical-line" class="col-12 col-form-label">Product Medical Line</label>
                    <div class="col-12">
                        <select id="product-medical-line" class="form-control select2" name="medical_line">
                            <?php foreach ($arrMedicalLine as $key => $medicalLine): ?>
                                <option value='<?=$key?>'><?=$medicalLine?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
            </div>            
            
        </div>

        <div class="form-group row">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Multiple File Upload</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
                <div class="dropzone dropzone-default dropzone-primary dz-clickable" id="kt_dropzone_4">
                    <div class="dropzone-msg dz-message needsclick">
                        <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                        <span class="dropzone-msg-desc">Upload up to 10 files</span>
                    </div>
                </div>
            </div>
        </div>     
            
        <hr>

        <div class="row">

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
        <button id="save-product" type="button" class="btn btn-primary">Save</button>
    </div>
</form>


<script>
   $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $("div#kt_dropzone_4").dropzone({ 
        autoProcessQueue: false,
        acceptedFiles: ".svg, .png", // Add accepted file types here
        url: "myproducts/add-product", // Your PHP file here
        init: function() {
            this.on("addedfile", function() {
                //Do something before the file gets processed.
            })
            this.on("sending", function(file, xhr, formData){
                //Do something when the file gets processed.
                //This is a good time to append additional information to the formData. It's where I add tags to make the image searchable.
                formData.append('tags', 'cat-cats-kittens-meow')
            }),
            this.on("success", function(file, xhr) {
                //Do something after the file has been successfully processed e.g. remove classes and make things go back to normal. 
            }),
            this.on("complete", function() {
                //Do something after the file has been both successfully or unsuccessfully processed.
                //This is where I remove all attached files from the input, otherwise they get processed again next time if you havent refreshed the page.
                myDropzone.removeAllFiles();   
            }),
            this.on("error", function(file, errorMessage, xhr) {
                //Do something if there is an error.
                //This is where I like to alert to the user what the error was and reload the page after. 
                alert(errorMessage);
                window.location.reload();
            })
        }
    });
});
</script>