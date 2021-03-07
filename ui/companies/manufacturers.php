<div class="subheader subheader-transparent">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <div class="d-flex flex-column text-dark-75">
                    <h2 class="text-dark font-weight-bolder mr-5 line-height-xl">
                    <span class="svg-icon svg-icon-xxl mr-1">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
					</span>
                        Manufacturers</h2>
                </div>
            </div>
        </div>
<!--        <div class="d-flex align-items-center">-->
<!--            <a href="javascript:;" class="btn btn-primary font-weight-normal font-size-h5 py-2 px-5" onclick="WebApp.loadPage('manufacturers/add');">Add Manufacturer</a>-->
<!--        </div>-->
    </div>
</div>

<div class="d-flex flex-column-fluid pt-10">
    <div class="container-fluid">
        <div class="card card-custom">
            <div class="card-body">
                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatableManufacturers"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="adduser_modal" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card card-custom example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Add User</h3>
                </div>
                <!--begin::Form-->
                <form id="kt_create_user_form" class="frmSignup">
                    <input type="hidden" name="companyId" id="companyId">
                    <input type="hidden" name="companyType" value="manufacturer" id="companyType">
                    <div class="card-body">
                        <!--begin::Code-->
                        <!--end::Code-->
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3">First Name</label>
                            <div class="col-lg-9">
                                <div class="input-group date">
                                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name">
                                </div>
                                <span class="form-text text-muted">Please enter user first name.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3">Last Name</label>
                            <div class="col-lg-9">
                                <div class="input-group date">
                                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name">
                                </div>
                                <span class="form-text text-muted">Please enter user last name.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3">Email</label>
                            <div class="col-lg-9">
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <span class="form-text text-muted">Please enter user email.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label text-right col-lg-3">Password</label>
                            <div class="col-lg-9">
                                <div class="input-group date">
                                    <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                                </div>
                                <span class="form-text text-muted">Please enter user password</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6 ml-lg-auto">
                                <a href="javascript:void(0)" onclick="createUser()" type="reset" class="btn btn-primary mr-2">Submit</a>
                            </div>
                            <div class="col-lg-3">
                                <button type="reset" id="closeAvailabilitiesPopUp" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/dt/manufacturers.js"></script>
<script>
    <?php if ( getenv('ENV') == Constants::ENV_LOC): ?>
    var firebaseConfig = {
        apiKey: "AIzaSyC5kStRUB63Jae9jGbvul93ZNi_jgTjs8Q",
        authDomain: "aumet-dev.firebaseapp.com",
        projectId: "aumet-dev",
        storageBucket: "aumet-dev.appspot.com",
        messagingSenderId: "773243474783",
        appId: "1:773243474783:web:22bc0baa02aca627495cea",
        measurementId: "G-B1GS9BKE18"
    };
    <?php else: ?>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyBy1rh8zZNp1lnUBLyQ15a-cgNvZzsNFBU",
        authDomain: "aumet-com.firebaseapp.com",
        databaseURL: "https://aumet-com.firebaseio.com",
        projectId: "aumet-com",
        storageBucket: "aumet-com.appspot.com",
        messagingSenderId: "380649916442",
        appId: "1:380649916442:web:8ff3bfa9cd74f7c69969a3",
        measurementId: "G-YJ2BRPK2JD"
    };
    <?php endif; ?>


    // Initialize Firebase
</script>
<script src="/assets/js/authUser.js"></script>

