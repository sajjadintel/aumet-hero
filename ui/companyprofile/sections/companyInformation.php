<form class="form" id="frmCompanyInfo">
    <div class="card card-custom card-stretch" >
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Company Information</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your company information</span>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                <button type="button" onclick="WebApp.loadPage('mycompanyprofile')" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Company Logo</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="image-input image-input-outline" id="kt_companyLogo" style="background-image: url( '/assets/img/company.svg' )">
                        <div class="image-input-wrapper" style="background-image: url('<?php echo $objCompany->Logo ? $objCompany->Logo : '/assets/img/company.svg' ?>')"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="Logo" accept=".png, .jpg, .jpeg">
                            <input type="hidden" name="companyLogoRemove">
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove logo">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                    </div>
                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Company Name</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="Name" value="<?php echo $objCompany->Name ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Country</label>
                <div class="col-lg-9 col-xl-6">
                    <select class="form-control select2" id="kt_selectCountry" name="CountryID">
                        <option label="Label"></option>
                        <?php foreach ($arrCountries as $objCountry): ?>
                            <option value="<?php echo $objCountry->ID?>" <?php echo $objCountry->ID == $objCompany->CountryID ? "selected" : "" ?>><?php echo $objCountry->Name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Company Address</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text"  name="Address" value="<?php echo $objCompany->Address ?>">
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Website Address</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="WebsiteUrl" value="<?php echo $objCompany->WebsiteUrl ?>">
                    <span class="form-text text-muted"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-phone"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-lg form-control-solid"  name="Phone" value="<?php echo $objCompany->Phone ?>">
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Description</label>
                <div class="col-lg-9 col-xl-6">
                    <textarea class="form-control form-control-lg form-control-solid" name="Description" id="companyDescription"><?php echo html_entity_decode($objCompany->Description) ?></textarea>
                </div>
            </div>
            <div class="row">
                <label class="col-xl-3"></label>
                <div class="col-lg-9 col-xl-6">
                    <h4 class="font-weight-bold mt-10 mb-6">Social Media</h4>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">LinkedIn Page Link</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="linkedinUrl" value="<?php echo $objCompany->linkedinUrl ?>" placeholder="https://linkedin.com/example">
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Facebook Page Link</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="facebookUrl" value="<?php echo $objCompany->facebookUrl ?>" placeholder="https://facebook.com/example">
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Twitter Account Link</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="twitterUrl" value="<?php echo $objCompany->twitterUrl ?>" placeholder="https://twitter.com/example">
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Youtube Channel Link</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="youtubeUrl" value="<?php echo $objCompany->youtubeUrl ?>" placeholder="https://youtube.com/example">
                    <span class="form-text text-muted"></span>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var kt_companyLogo = new KTImageInput('kt_companyLogo');

    $('#kt_selectCountry').select2({
        placeholder: "Select a country"
    });

    ClassicEditor
        .create( document.querySelector( '#companyDescription' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ]
        } )
        .then( editor => {
            //console.log( editor );
        } )
        .catch( error => {
            //console.error( error );
        } );

    function fnCallbackSaveCompanyInfo(webReponse){
        webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message);
    }

    $( '#frmCompanyInfo' ).submit(function ( e ) {
        e.preventDefault();
        WebApp.postFormData('#frmCompanyInfo','mycompanyprofile/edit/companyinformation', (new FormData(this)), fnCallbackSaveCompanyInfo);
    });


</script>