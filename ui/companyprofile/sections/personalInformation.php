<form class="form" id="frmPersonalInfo">
    <div class="card card-custom card-stretch" >
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal information</span>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                <button type="button" onclick="WebApp.loadPage('mycompanyprofile')" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Profile Picture</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="image-input image-input-outline" id="kt_profilePhoto" style="background-image: url( '/assets/img/user.svg' )">
                        <div class="image-input-wrapper" style="background-image: url('<?php echo $objUser->photoUrl ? $objUser->photoUrl : '/assets/img/user.svg' ?>')"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="profilePhoto" accept=".png, .jpg, .jpeg">
                            <input type="hidden" name="profilePhotoRemove">
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
                <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="firstName" value="<?php echo $objUser->firstName ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="lastName" value="<?php echo $objUser->lastName ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Job Title</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="position" value="<?php echo $objUser->position ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                <div class="col-lg-9 col-xl-6">
                    <input class="form-control form-control-lg form-control-solid" type="text" name="email" value="<?php echo $objUser->email ?>">
                    <span class="form-text text-muted"></span>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Personal Phone</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="la la-phone"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-lg form-control-solid"  name="phoneNumber" value="<?php echo $objUser->phoneNumber ?>">
                    </div>
                    <span class="form-text text-muted"></span>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var kt_profilePhoto = new KTImageInput('kt_profilePhoto');

    function fnCallbackSavePersonalInfo(webReponse){
        webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message);
    }

    $( '#frmPersonalInfo' ).submit(function ( e ) {
        e.preventDefault();
        WebApp.postFormData('#frmPersonalInfo','mycompanyprofile/edit/personalinformation', (new FormData(this)), fnCallbackSavePersonalInfo)
    });


</script>