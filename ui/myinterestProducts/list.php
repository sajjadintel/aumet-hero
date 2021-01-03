<div class="subheader subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <div class="d-flex flex-column text-dark-75">
                    <h2 class="text-dark font-weight-bolder mr-5 line-height-xl">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-10-081610/theme/html/demo2/dist/../src/media/svg/icons/General/Heart.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M16.5,4.5 C14.8905,4.5 13.00825,6.32463215 12,7.5 C10.99175,6.32463215 9.1095,4.5 7.5,4.5 C4.651,4.5 3,6.72217984 3,9.55040872 C3,12.6834696 6,16 12,19.5 C18,16 21,12.75 21,9.75 C21,6.92177112 19.349,4.5 16.5,4.5 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                        Add Products Interested in</h2>
                        <span class="font-weight-normal font-size-h6">Select the products and ranges you are interested in, to receive better recommendations.</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="#" class="btn btn-secondary font-weight-bold font-size-base mr-5 back-btn">Back</a>
            <a href="#" class="btn btn-secondary font-weight-bold font-size-base mr-5" onclick="WebApp.loadPage('myinterests')">Cancel</a>
            <a href="#" class="btn btn-primary font-weight-bold font-size-base mr-5 save-btn" onClick="attachNewItems()">Save</a>
        </div>
    </div>
</div>    
<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap mt-4">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <div class="d-flex flex-column text-dark-75">
                    <h3 class="text-dark font-weight-bolder mr-5 line-height-xl">Selected Products</h3>
                        <div class="selected-products">
                        </div>
                </div>
            </div>
        </div>
    </div>
<div class="d-flex flex-column-fluid pt-7">
    <div class="container-fluid">
        <div class="card card-custom gutter-b">
        <div class="card-header border-0">
            <div class="input-icon d-md-inline mt-4">
                <input type="text" class="form-control filter-medical-line" placeholder="Search..">
                <span class="h-75">
                    <i class="flaticon2-search-1 icon-md text-primary"></i>
                </span>
            </div>
        </div>        
            <?php  
                if(isset($editTrue) && $editTrue) {
                    echo "<input type='hidden' class='hidden-value' value='".$distributorinteresetId."'/>";   
                }
            ?>
            <div class="card-body">
            <div class="breadcrumbs-section">
            </div>
                <div class="row">
                    <div class="col-xl-6 medical-lines-section">         
                    </div>
                    <div class="col-xl-6 spcialities-section">
                    </div>
                    <!--used for append modified objects-->
                    <div class="cloned-dom">
                            <!--begin::Item-->
                            <div class="align-items-center mb-5 list-item">
                                    <div class="card card-custom card-stretch gutter-b">
                                        <div class="card-body pt-2">
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-60 symbol-1by2 flex-shrink-0 mr-4">
                                                    <div class="symbol-label image-section" style="background-image: url('')"></div>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Title-->
                                                <div class="d-flex flex-wrap flex-column flex-grow-1 my-lg-0 my-2 mr-2">
                                                    <a href="#" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1 title-name"></a>
                                                </div>
                                                <!--begin::Label-->
                                                <div class="d-flex flex-wrap mr-6 align-items-center">
                                                    <span class="text-dark-75 font-weight-bolder product-total"></span>                                                                                
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Section-->
                                                <div class="d-flex align-items-center mt-lg-0 mt-3">
                                                <!--begin::Btn-->
                                                    <a href="#" class="btn btn-icon btn-light btn-sm get-speciality">
                                                        <span class="svg-icon svg-icon-success">
                                                            <span class="svg-icon svg-icon-md">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </a>
                                                <!--end::Btn-->
                                            </div>
                                        <!--end::Section-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Item-->
                    </div>
                </div>
                <script src="/assets/js/myinterestProductCRUD.js"></script>
            </div>
        </div>
    </div>
</div>