<div class="subheader subheader-transparent" id="kt_subheader">
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
                                <path d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z" fill="#000000"/>
                                <path d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
					</span>
                        My Interests</h2>
                    <span class="font-weight-normal font-size-h6 ml-12">Select and manage the products and ranges you are interested in, to receive better recommendations and business opportunities</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="#" class="btn btn-primary font-weight-bold font-size-base mr-5" onclick="WebApp.loadPage('myinterests/add-products')">Add an Interest</a>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid pt-7">

    <div class="container-fluid">
        <div class="card card-custom gutter-b">
            <div class="card-body">
                    <!--begin: Search Form-->
                    <form>
                    <div class="row">
                    <div class="col-3">                        
                        <div class="input-icon d-none d-md-inline"> 
                            <input type="text" class="form-control datatable-input" id="kt_datatable_searchQuery" placeholder="Search for Products." data-col-index="0">  
                            <span class="mt-6"> 
                                <i class="flaticon2-search-1 icon-md text-primary"></i> 
                            </span> 
                        </div>
                    </div>    
                    <div class="col-3">
							<div class="form-group row">
							    <label class="col-5 col-form-label">Medical Line</label>
									<div class="col-7">
                                        <select class="form-control datatable-input" id="kt_datatable_search_medicalLine" data-col-index="1" multiple="multiple">
                                            <option value="">Select</option>
                                            <?php foreach ($arrMedicalLines as $item): ?>
                                                <option value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                                            <?php endforeach; ?>
							            </select>
									</div>
                            </div>
                    </div>        
                    <div class="col-3">
                            <div class="form-group row">
							    <label class="col-4 col-form-label">Specialty</label>
									<div class="col-8">
                                        <select class="form-control datatable-input" id="kt_datatable_specialityId" data-col-index="2" multiple="multiple">
                                            <option value="">Select</option>
                                            <?php foreach ($arrSpeciality as $special): ?>
                                                <option value="<?php echo $special->ID ?>"><?php echo $special->Name ?></option>
                                            <?php endforeach; ?>
							            </select>
									</div>
                            </div>
                    </div>        
                    <div class="col-3">
                            <div class="form-group row">
							    <label class="col-4 col-form-label">Added On</label>
									<div class="col-8">
                                        <input type='text' class="form-control datatable-input" id="kt_datatable_search_addedOn" readonly placeholder="Select time" type="text" data-col-index="3"/>
									</div>
                            </div>
                        </div>
                    </div>
					</form>                
                    <div class="row mt-8">
							<div class="col-lg-12">
									<button class="btn btn-primary btn-primary--icon" id="kt_search">
									        <span>
												<i class="la la-search"></i>
											    <span>Search</span>
											</span>
									</button>
									<button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
											<span>
												<i class="la la-close"></i>
												<span>Reset</span>
											</span>
									</button>
                            </div>
					</div>
                    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
            </div>
        </div>
    </div>
</div>

<script src="/assets/js/myinterests.js"></script>