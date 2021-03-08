<div class="subheader subheader-transparent">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <div class="d-flex flex-column text-dark-75">
                    <h2 class="text-dark font-weight-bolder mr-5 line-height-xl">
                    <span class="svg-icon menu-icon">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
						<span class="svg-icon svg-icon-primary svg-icon-2x">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-02-01-052524/theme/html/demo1/dist/../src/media/svg/icons/Communication/Incoming-mail.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M18.1444251,10.8396467 L12,14.1481833 L5.85557487,10.8396467 C5.4908718,10.6432681 5.03602525,10.7797221 4.83964668,11.1444251 C4.6432681,11.5091282 4.77972206,11.9639747 5.14442513,12.1603533 L11.6444251,15.6603533 C11.8664074,15.7798822 12.1335926,15.7798822 12.3555749,15.6603533 L18.8555749,12.1603533 C19.2202779,11.9639747 19.3567319,11.5091282 19.1603533,11.1444251 C18.9639747,10.7797221 18.5091282,10.6432681 18.1444251,10.8396467 Z" fill="#000000"/>
                                    <path d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
                                </g>
                            </svg><!--end::Svg Icon-->
                        </span>
                        <!--end::Svg Icon-->
					</span>
                        Inquiry</h2>
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
                                                <option value='0'>Both</option>
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
                                        <label>Business Opportunity Status:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="boTypeHidden" id="boTypeHidden">
                                            <select class="form-control select2 col-md-8 " id="boType" name="boType">
                                                <option value="0">Both</option>
                                                <option value='2'>Active Business Opportunity</option>
                                                <option value='3'>Non-Active Business Opportunity</option>
                                            </select>
                                        </div>
                                        <span class="form-text text-muted">To show all messages sent from distributors to manufacturers.</span>
                                    </div>

                                    <!--
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
                                    -->

                                    <div class="col-md-4">
                                        <label>Email Needed:</label>
                                        <div class="input-group">
                                            <input type="hidden" name="emailNeededHidden" id="emailNeededHidden">
                                            <select class="form-control select2 col-md-8 " id="emailNeeded" name="emailNeeded">
                                                <option value="">All</option>
                                                <option value='0'>No</option>
                                                <option value='1'>Yes</option>
                                            </select>
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
                <div class="datatable datatable-bordered datatable-head-custom p-5" id="kt_datatableInquiries"></div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/dt/inquiries.js"></script>


