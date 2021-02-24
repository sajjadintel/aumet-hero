<h3 class="card-title">Filter Inquiry</h3>
<!--begin::Form-->
<form class="form" id="frmFilters">
    <div class="form-group row">
        <!--inquiryStatus-->
        <div class="col-md-4">
            <label>Inquiry Status:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-bookmark-o"></i>
                    </span>
                </div>
                <select class="form-control select2 col-md-8 " id="inquiryStatus" name="status">
                    <option value=""></option>
                    <option value='0'>Pending</option>
                    <option value='1'>Sent</option>
                    <option value='2'>Replied</option>
                    <option value='3'>Locked</option>
                    <option value='4'>Disapproved</option>
                </select>
            </div>
        </div>
        <!--inquirySenderName-->
        <div class=" col-md-4">
            <label>Receiver Name:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-user"></i>
                    </span>
                </div>
                <select class="form-control select2 col-md-8" id="inquiryReceiverUser" name="country">
                    <option value=""></option>
                    <?php foreach ($arrToUser as $user): ?>
                        <option value='<?php echo $user->messageUserId; ?>'><?php echo $user->displayName; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <!--inquiryReceiverName-->
        <div class="col-md-4">
            <label>Sender Name</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-user"></i>
                    </span>
                </div>
                <select class="form-control select2 col-md-8" id="inquirySenderUser" name="country">
                    <option value=""></option>
                    <?php foreach ($arrFromUser as $user): ?>
                        <option value='<?php echo $user->messageUserId; ?>'><?php echo $user->displayName; ?></option>
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
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="la la-bookmark-o"></i>
                    </span>
                </div>
                <select class="form-control select2 col-md-8 " id="senderType" name="status">
                    <option value=""></option>
                    <option value='0'>Manufacturer</option>
                    <option value='1'>Distributor</option>
                </select>
            </div>
        </div>
        <!--Created On Date Range-->
        <div class="col-md-4">
            <label>Created On Date Range</label>
            <div class="input-group">
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="la la-calendar-check-o"></i>
                    </span>
                </div>
                <input type="text" class="form-control pull-right" readonly="readonly" name="dtr" id="rangetime" placeholder="Select Date and Time range" value="<?php echo ($dtr ? $dtr : ''); ?>" style="background-color: #fff;">
            </div>
        </div>
        <!--From Business Opportunity-->
        <div class="col-lg-4">
            <label>From Business Opportunity Only :</label>
            <div class="radio-inline">
                <label class="radio radio-solid">
                    <input type="radio" name="BOonly" value="2">
                    <span></span>Yes
                </label>
            </div>
            <span class="form-text text-muted">To show all messages sent from distributors to manufacturers.</span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-right mb-10">
            <button type="submit" class="btn btn-primary mr-2 frmSetInquiryFilter">Submit</button>
            <button type="reset" class="btn btn-secondary">Clear</button>
        </div>
    </div>
</form>
<!--end::Form-->
<script>
    $(document).ready(function (){
        //Select 2
        $('#inquiryStatus').select2({
            placeholder: "Select Status",
        });
        $('#senderType').select2({
            placeholder: "Select Sender Type",
        });
        $('#inquirySenderUser').select2({
            placeholder: "Select Sender Name",
        });
        $('#inquiryReceiverUser').select2({
            placeholder: "Select Receiver Name",
        });

        // Date range picker with time picker
        $('#rangetime').daterangepicker({
            autoUpdateInput: false,
            timePicker: true,
            locale: {
                format: 'MM/DD/YYYY hh:mm A',
                cancelLabel: 'Clear',
                applyLabel: 'OK'
            }
        });

        $('#rangetime').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A') + ' - ' + picker.endDate.format('MM/DD/YYYY hh:mm A'));
        });

        //Submit form
        $( '.frmSetInquiryFilter' ).click(function ( e ) {
            e.preventDefault();
            var formId = $(this).parents('form').attr('id');
            var $form = $(this).closest("#frmFilters");
            var formData = $form.serializeArray();
            WebApp.post('api/message/send', formData, fnCallbackSendMessage);

            function fnCallbackSendMessage(webReponse){
                WebApp.hideModal('.modal');
                (webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message));
            }
        });

        function resetForm() {
            console.log('reset');
        }

    });
</script>