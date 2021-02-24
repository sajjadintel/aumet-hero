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
                        Distributors</h2>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:;" class="btn btn-primary font-weight-normal font-size-h5 py-2 px-5" onclick="WebApp.loadPage('distributors/add');">Add Distributor</a>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid pt-10">
    <div class="container-fluid">
        <div class="card card-custom">
            <div class="card-body">

                <div id="distributorFilters" class="mb-7">

                    <div class="card card-custom shadow-none gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Filter Distributors</h3>
                        </div>
                        <!--begin::Form-->
                        <form id="filterForm" class="form">
                            <input type="hidden" value="" name="pages" id="pages">
                            <input type="hidden" value="" name="page" id="page">
                            <input type="hidden" value="" name="perpage" id="perpage">
                            <input type="hidden" value="" name="total" id="total">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Distributor Name:</label>
                                        <input type="text" class="form-control" id="kt_datatable_search_query" placeholder="Enter distributor name" name="Name">
                                        <span class="form-text text-muted">Please enter distributor name</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Country:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-flag"></i>
                                                </span>
                                            </div>
                                            <select id="country_id" name="CountryID" class="form-control selectpicker form-control-solid" data-size="7" data-live-search="true" tabindex="null">
                                                <option value="0"></option>
                                                <?php foreach ($arrCountries as $country): ?>
                                                    <option value="<?php echo $country['ID'] ?>" ><?php echo $country['Name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <span class="form-text text-muted">Select country</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Person Name:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-user"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="PersonName" class="form-control" placeholder="">
                                        </div>
                                        <span class="form-text text-muted">Please enter person name</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Email address :</label>

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="email" class="form-control" placeholder="">
                                        </div>
                                        <span class="form-text text-muted">Please enter email</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Registered date:</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" value="" name="RegistrationDate" id="kt_datepicker_2" readonly="readonly" placeholder="Select date">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <span class="form-text text-muted">Please enter date range</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Sent inquiries :</label>
                                        <div class="radio-inline">
                                            <label class="radio radio-solid">
                                                <input type="radio" name="inquirySend" value="1">
                                                <span></span>Yes</label>
                                            <label class="radio radio-solid">
                                                <input type="radio" name="inquirySend" value="0">
                                                <span></span>No</label>
                                        </div>
                                        <span class="form-text text-muted">Please select inquiry status</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Distributor Experience (Specialty):</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-bookmark-o"></i>
                                                </span>
                                            </div>

                                            <select id="SpecialityID" name="SpecialityID" class="form-control selectpicker form-control-solid" data-size="7" data-live-search="true" tabindex="null">
                                                <option value="0"></option>
                                                <?php foreach ($speciallities as $speciallity): ?>
                                                    <option value="<?php echo $speciallity->ID ?>" ><?php echo $speciallity->Name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">Please enter your postcode</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Distributor Experience (Medical line):</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-bookmark-o"></i>
                                                </span>
                                            </div>

                                            <select id="MedicallineID" name="MedicallineID" class="form-control selectpicker form-control-solid" data-size="7" data-live-search="true" tabindex="null">
                                                <option value="0"></option>
                                                <?php foreach ($arrMedicalLines as $medicalLine): ?>
                                                    <option value="<?php echo $medicalLine['ID'] ?>" ><?php echo $medicalLine['Name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">Please enter your postcode</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Status:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-bookmark-o"></i>
                                                </span>
                                            </div>

                                            <select id="country_id4" name="statusId" class="form-control selectpicker form-control-solid" data-size="7" data-live-search="true" tabindex="null">
                                                    <option value="0" ></option>
                                                    <option value="1" >Registered basic</option>
                                                    <option value="2" >Registered full</option>
                                                    <option value="3" >Onboarded</option>
                                                    <option value="4" >Activated</option>
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">Please select status</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>UTM:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="utm" placeholder="">
                                        </div>
                                        <span class="form-text text-muted">Please enter UTM</span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Registered :</label>
                                        <div class="radio-inline">
                                            <label class="radio radio-solid">
                                                <input type="radio" class="radioRegistered" name="Registered" value="1">
                                                <span></span>Yes</label>
                                            <label class="radio radio-solid">
                                                <input type="radio" class="radioRegistered" name="Registered" value="0">
                                                <span></span>No</label>
                                        </div>
                                        <span class="form-text text-muted">Please select registered status</span>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <a href="javascript:void(0)" type="reset" id="submitButton" class="btn btn-primary mr-2">Submit</a>
                                        <button type="reset" class="btn btn-secondary">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>

                </div>


                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatableDistributors"></div>


            </div>
        </div>
    </div>
</div>
<script src="/assets/js/dt/distributors.js"></script>

