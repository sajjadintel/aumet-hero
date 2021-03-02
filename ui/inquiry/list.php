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
					</span>Inquiry</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid pt-5">
    <div class="container-fluid">
        <div class="card card-custom">
            <div class="card-body p-0">
                <div id="inquiryFilters" class="mb-7">
                    <div class="card card-custom shadow-none gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Filter Inquiry</h3>
                        </div>
                        <!--begin::Form-->
                        <form class="form" id="filterForm">
                            <div class="card-body pb-1 pt-1">
                                <div class="form-group row">
                                    <!--inquiryStatus-->
                                    <div class="col-md-4">
                                        <label>Inquiry Status:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="inquiryStatusHidden" id="inquiryStatusHidden">
                                            <select class="form-control select2 col-md-8 " id="inquiryStatus" name="status">
                                                <option value="0">Select</option>
                                                <option value='1'>Pending</option>
                                                <option value='2'>Sent</option>
                                                <option value='3'>Replied</option>
                                                <option value='4'>Locked</option>
                                                <option value='5'>Disapproved</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--inquirySenderName-->
                                    <div class=" col-md-4">
                                        <label>Receiver Name:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="inquiryReceiverUserHidden" id="inquiryReceiverUserHidden">
                                            <select class="form-control select2 col-md-8" id="inquiryReceiverUser" name="receiverUser">
                                                <option value="0">Select</option>
                                                <?php foreach ($arrToUser as $user): ?>
                                                    <option value='<?php echo $user->receiverCompanyId; ?>'><?php echo $user->receiverCompany; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--inquiryReceiverName-->
                                    <div class="col-md-4">
                                        <label>Sender Name</label>
                                        <div class="input-group">
                                            <input type="hidden" name="inquirySenderUserHidden" id="inquirySenderUserHidden">
                                            <select class="form-control select2 col-md-8" id="inquirySenderUser" name="senderUser">
                                                <option value="0">Select</option>
                                                <?php foreach ($arrFromUser as $user): ?>
                                                    <option value='<?php echo $user->senderCompanyId; ?>'><?php echo $user->senderCompany; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!--senderType-->
                                    <div class="col-md-4">
                                        <label>Sender Type:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="senderTypeHidden" id="senderTypeHidden">
                                            <select class="form-control select2 col-md-8 " id="senderType" name="sType">
                                                <option value="0">Select</option>
                                                <option value='manufacturer'>Manufacturer</option>
                                                <option value='distributor'>Distributor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Created On Date Range-->
                                    <div class="col-lg-4">
                                        <label>Sent date:</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control" value="" name="inquiryDate" id="kt_datepicker_2" readonly="readonly" placeholder="Select date">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manufacturer Type-->
                                    <div class="col-md-4">
                                        <label>Manufacturer type:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="manufacturerTypeHidden" id="manufacturerTypeHidden">
                                            <select class="form-control select2 col-md-8 " id="manufacturerType" name="manufacturerType">
                                                <option value="0">Select</option>
                                                <option value='1'>Both</option>
                                                <option value='2'>Subscribed</option>
                                                <option value='3'>Non Subscribed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!--From Business Opportunity-->
                                    <!--<div class="col-lg-4">
                                        <label>From Business Opportunity Only :</label>
                                        <div class="radio-inline">
                                            <label class="radio radio-solid">
                                                <input type="radio" name="boOnly" class="boOnly" value="1" ><span></span>Yes
                                            </label>
                                            <label class="radio radio-solid">
                                                <input type="radio" name="boOnly" class="boOnly" checked value="0" ><span></span>No
                                            </label>
                                        </div>
                                        <span class="form-text text-muted">To show all messages sent from distributors to manufacturers.</span>
                                    </div>-->
                                    <div class="col-md-4">
                                        <label>Business Opportunity type:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="boTypeHidden" id="boTypeHidden">
                                            <select class="form-control select2 col-md-8 " id="boType" name="boType">
                                                <option value="0">Select</option>
                                                <option value='1'>Both</option>
                                                <option value='2'>Business Opportunity Only</option>
                                                <option value='3'>No Business Opportunity</option>
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">To show all messages sent from distributors to manufacturers.</span>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Email Needed:</label>
                                        <div class="radio-inline">
                                            <label class="radio radio-solid">
                                                <input type="radio" name="emailNeeded" class="emailNeeded" value="1"><span></span>Yes
                                            </label>
                                            <label class="radio radio-solid">
                                                <input type="radio" name="emailNeeded" class="emailNeeded" checked value="0"><span></span>No
                                            </label>
                                        </div>
                                        <span class="form-text text-muted">Inquiries where manufacturer has no email.</span>
                                    </div>

                                    <!--Submit and reset button-->
                                    <div class="col-lg-4 text-right mb-10">
                                        <a href="javascript:void(0)" type="reset" id="submitButton" class="btn btn-primary mr-2">Submit</a>
                                        <a href="javascript:void(0)" type="reset" onclick="KTDatatableInquiry.resetDataTable()" class="btn btn-secondary">Clear</a>
                                    </div>

                                </div>

                            </div>
                            <!--<div class="card-footer pb-1 pt-2 ">
                                <div class="row">
                                    <div class="col-lg-12 text-right mb-10">
                                        <a href="javascript:void(0)" type="reset" id="submitButton" class="btn btn-primary mr-2">Submit</a>
                                        <a href="javascript:void(0)" type="reset" onclick="KTDatatableInquiry.resetDataTable()" class="btn btn-secondary">Clear</a>
                                    </div>
                                </div>
                            </div>-->
                        </form>
                    </div>
                </div>
                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatableInquiries"></div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/dt/inquiries.js"></script>


