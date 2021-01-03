<div class="subheader subheader-solid" id="kt_subheader">
    <div class="card-body p-0">
        <form id="frmCompanyBanner">
            <div class="d-flex h-175px m-0 justify-content-center p-0 image-input image-input-outline" id="kt_companyBanner" style="background-image: url( '/assets/img/samplebg-1.jpeg' )">
                <div class="w-100 h-100 image-input-wrapper border-0" style="background-image: url('<?php echo $objCompany->Banner ? $objCompany->Banner : '/assets/img/samplebg-1.jpeg' ?>')"></div>
                <label class="btn btn-xs btn-icon btn-circle btn-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                    <i class="fa fa-pen icon-sm"></i>
                    <input type="file" name="companyBanner" accept=".png, .jpg, .jpeg">
                    <input type="hidden" name="companyBannerRemove">
                </label>
                <span class="btn btn-xs btn-icon btn-circle btn-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel logo">
                    <i class="ki ki-bold-close icon-xs"></i>
                </span>
                <span class="btn btn-xs btn-icon btn-circle btn-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove logo">
                    <i class="ki ki-bold-close icon-xs"></i>
                </span>
            </div>
        </form>
    </div>
</div>

<script src="/theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>

<div class="d-flex flex-column-fluid mt-10">
    <div class="flex-row-auto offcanvas-mobile w-300px w-xxl-350px" id="kt_profile_aside">
        <div class="card card-custom">

            <div class="card-body pt-4">

                <div class="d-flex align-items-center">
                    <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                        <div class="symbol-label" style="background-image:url(<?php echo $objCompany->Logo ? $objCompany->Logo : '/assets/img/company.svg' ?>)"></div>
                    </div>
                    <div>
                        <span class="font-weight-bolder font-size-h5 text-dark"><?php echo $objCompany->Name ?></span>
                        <div class="text-dark-65 text-capitalize mt-4">Medical <?php echo $objCompany->Type ?></div>
                    </div>
                </div>

                <div class="navi navi-bold navi-hover navi-active navi-link-rounded mt-10">
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4" onclick="WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/companyinformation')">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon ">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
                                            <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
                                            <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-h5">Company Information</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4" onclick="WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/personalinformation')">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-h5">Personal Information</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4" onclick="WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/businessinformation')">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="7" y="4" width="3" height="13" rx="1.5"/>
                                            <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8" rx="1.5"/>
                                            <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                            <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-h5">Business Information</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4" onclick="WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/documents')">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-h5">Documents & Catalogs</span>
                        </a>
                    </div>
                    <div class="navi-item mb-2">
                        <a href="javascript:;" class="navi-link py-4" onclick="WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/pictures')">
                            <span class="navi-icon mr-2">
                                <span class="svg-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
                                            <polygon fill="#000000" opacity="0.3" points="4 19 10 11 16 19"/>
                                            <polygon fill="#000000" points="11 19 15 14 19 19"/>
                                            <path d="M18,12 C18.8284271,12 19.5,11.3284271 19.5,10.5 C19.5,9.67157288 18.8284271,9 18,9 C17.1715729,9 16.5,9.67157288 16.5,10.5 C16.5,11.3284271 17.1715729,12 18,12 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                            </span>
                            <span class="navi-text font-size-h5">Pictures</span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <div class="flex-row-fluid ml-lg-8" id="profileEditWorkspace">

    </div>
</div>

<script>
    var kt_companyBanner = new KTImageInput('kt_companyBanner');

    function fnCallbackSaveCompanyBanner(webResponse){
    }

    kt_companyBanner.on('change', function(imageInput) {
        WebApp.postFormData('#frmCompanyBanner','mycompanyprofile/edit/banner/upload', (new FormData(document.getElementById('frmCompanyBanner'))), fnCallbackSaveCompanyBanner)
    });



    WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/companyinformation');
</script>