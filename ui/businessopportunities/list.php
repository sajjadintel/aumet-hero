<div class="subheader subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <div class="d-flex flex-column text-dark-75">
                    <h2 class="text-dark  mr-5 line-height-xl">
                    <span class="svg-icon svg-icon-xxl mr-1">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                      fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                      fill="#000000" fill-rule="nonzero"/>
                                <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z"
                                      fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
					</span>
                        Business Opportunities
                    </h2>
                    <span class="font-weight-normal font-size-h6 ml-12 pr-48">My Business Opportunities</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">

        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid pt-10">
    <div class="container-fluid">

        <div class="card card-custom gutter-b">
            <div class="card-body">
                <span class="font-size-h6 font-weight-bolder">Filter</span>
            </div>
        </div>

        <input type="hidden" value="" id="company_id"/>
        <input type="hidden" value="" id="slot_selected"/>
        <input type="hidden" value="" id="selectedEventId" />
        <?php foreach ($arrBusinessOpportunities as $key=> $objItem): ?>
            <input type="hidden" value="" id="selectedAttendeeId" />
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-100">
                                <img alt="Pic" src="<?php echo $objItem->Logo != null ? $objItem->Logo : '/theme/assets/media/users/blank.png' ?>">
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-4">
                                <div class="mr-3">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                                        <a href="javascript:;" onclick="WebApp.loadPage('browse/manufacturer/<?php echo $objItem->ID ?>')" class="d-flex align-items-center text-dark text-hover-primary font-size-h4 font-weight-bold mr-3">
                                            <?php echo $objItem->Name ?>
                                            <img alt="" class="ml-2" style="max-width: 30px"
                                                 src="<?php echo $objItem->CountryFlag; ?>"/>

                                        </a>
                                        <div class="my-lg-0 my-1">
                                            <span class="label label-inline label-lg label-primary font-weight-bolder">
                                                <?php echo $objItem->connectionStatusName ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap mt-4">
                                        <div class="symbol symbol-50">
                                            <img alt="Pic" src=" <?php echo $objItem->objUser->ProfileImage != null ? $objItem->objUser->ProfileImage : "/assets/img/user.svg"?> ">
                                        </div>
                                        <div class="ml-4">
                                            <h6><?php echo $objItem->objUser != null ? $objItem->objUser->FirstName . " ". $objItem->objUser->LastName  : ""?></h6>
                                            <a href="javascript:;"
                                               class="text-dark text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">

                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                  fill="#000000"></path>
                                            <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
                                            </g>
                                            </svg>

                                            </span>
                                                <?php echo $objItem->objUser != null ? $objItem->objUser->Email : "" ?></a>
                                            <a href="#"
                                               class="text-dark text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <mask fill="white">
                                                <use xlink:href="#path-1"></use>
                                                </mask>
                                                <g></g>
                                                <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                      fill="#000000"></path>
                                                </g>
                                                </svg>

                                                </span><?php echo $objItem->objUser != null ? $objItem->objUser->JobTitle : ""?></a>

                                            <a href="#" class="text-dark text-hover-primary font-weight-bold">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                                                    </g>
                                                </svg>

                                                </span>Responds in 24 hours</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <a href="javascript:;" class="btn btn-lg btn-outline-primary font-weight-bold font-size-base mr-5" onclick="WebApp.loadPage('view-introduction/<?php echo $objItem->introductionId ?>')">View Business Opportunity</a>
                                    <a href="#" data-toggle="modal" data-target="#kt_datetimepicker_modal" onclick="selectAttendeesId('<?php echo $key; ?>')" class="btn btn-primary font-weight-bold font-size-base">Schedule a call</a>
                                </div>


                            </div>

                            <div class="d-flex align-items-center flex-wrap justify-content-between mt-6">
                                <a href="#" class="btn btn-sm btn-outline-primary font-weight-bolder mr-2">Aumet Indicator</a>
                                <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5 mt-2">
                                    <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-350px">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 63%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="d-flex mt-4 mt-sm-0">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator separator-solid my-7"></div>

                    <div class="d-flex align-items-center flex-wrap">

                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                            <i class="flaticon-diagram display-4 text-primary font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-h6">Annual Sales</span>
                                <span class="font-weight-bolder font-size-h4">
                                <?php echo $objItem->AnnualSales == null ? "<span class='text-muted'>Not Available<span>" : $objItem->AnnualSales ?>
                            </div>
                        </div>


                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                            <i class="flaticon-customer display-4 text-primary font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column text-dark-75">
                                <span class="font-weight-bolder font-size-h6">Employees</span>
                                <span class="font-weight-bolder font-size-h4"><?php echo $objItem->NumberOfEmployees == null ? "<span class='text-muted'>Not Available<span>" : $objItem->NumberOfEmployees ?></span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                            <span class="mr-4">
                            <i class="flaticon-trophy display-4 text-primary font-weight-bold"></i>
                            </span>
                            <div class="d-flex flex-column">
                                <span class="text-dark-75 font-weight-bolder font-size-h6">Specialized in</span>
                                <a href="#companyProfileOverView" class="text-primary font-weight-bold">
                                    <?php $itemsCounter = 0; ?>
                                    <?php foreach ($_SESSION['arrSpecialities'] as $objItem):?>
                                        <?php if($itemsCounter < 3): ?>
                                            <span class="label label-light-dark label-inline mr-1 mb-1"><?php echo $objItem->Name?></span>
                                        <?php endif; ?>
                                        <?php $itemsCounter++; ?>
                                    <?php endforeach; ?>
                                    <?php if($itemsCounter >= 3): ?>
                                        <span class="label label-light label-inline"><?php echo "+".($itemsCounter-3); ?></span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<!--Start schedule call modal -->
<div class="modal fade" id="kt_datetimepicker_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Schedule meeting on</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form class="form">
                <div class="modal-body">
                    <div class="row">
                        <div id="error-message" style="display: none;" class="col-12">
                            <div class="alert alert-danger" role="alert">

                            </div>
                        </div>
                        <div class="col-lg-5 pr-0">
                            <div>
                                <div id="calendar-div"></div>
                                <input id="meeting_date" type="hidden" />
                            </div>
                        </div>
                        <div class="col-lg-3 pl-0 col-md-12 col-sm-15">
                            <div class="row mb-4">
                                <div class="input-group input-group-solid date" id="startTime"
                                     data-target-input="nearest">
                                    <input id="startTimeInput" type="text" class="form-control form-control-solid datetimepicker-input"
                                           placeholder="start time" data-target="#startTime"/>
                                    <div class="input-group-append" data-target="#startTime"
                                         data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-group input-group-solid date" id="endTime"
                                     data-target-input="nearest">
                                    <input id="endTimeInput" type="text" class="form-control form-control-solid datetimepicker-input"
                                           placeholder="End time" data-target="#endTime"/>
                                    <div class="input-group-append" data-target="#endTime"
                                         data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 pr-0 availabble-col">
                            <table id="available_slots" class="table table-bordered">
                                <thead>
                                <tr id="onDay" class="text-center">
                                    <?php if(is_array($availablities)) {?>
                                        <th scope="col">Please select a day</th>
                                    <?php }else{
                                        $t=date('d-m-Y');
                                        ?>
                                        <th scope="col">Available slots on <span class="font-weight-bold"><?php echo date('l',strtotime($t));?></span></th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (is_array($availablities)) {
                                    foreach ($availablities as $available){
                                        ?>
                                        <tr><td><?php echo $available->freeSlotStart; ?> to <?php echo $available->freeSlotEnd; ?></td></tr>
                                    <?php }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" id="closePopUp" class="btn btn-primary mr-2" data-dismiss="modal">Close</button>
                    <button type="reset" onclick="scheduleMeeting();" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END schedule call modal -->
<script>
    $(function () {

        $("body").on("click",".reschedule",function(){

            var p = $( this );
            var offset = p.offset();

            let screen_height = $( document ).height();
            let screen_width = $( document ).width();
            let left = parseInt(offset.left)+30;
            let left_percent = (screen_width-left) / screen_width * 100;



            let bottom = parseInt(screen_height)-(parseInt(offset.top)+130);
            if(parseInt(offset.top)<500){
                $('.modal-lg').css('top',(parseInt(offset.top)-350)+'px');
                $('.modal-lg').css('bottom','auto');
            }else{
                $('.modal-lg').css('bottom',bottom+'px');
                $('.modal-lg').css('top','auto');
            }
            $('.modal-lg').css('position','absolute');
            $('.modal-lg').css('width','100%');
            $('.modal-lg').css('right',(left_percent*2)+'%');
            $('.modal-lg').css('left','auto');
        });

        $( "#startTimeInput" ).on( "blur", function() {
            $('#endTimeInput').val($( this ).val());
            $('#slot_selected').val('');
            $('#error-message').css('display','none');
        });
        $('.copy_element').mouseleave(function(){
            $('.copy_element').tooltip('hide');
        });
        $('#kt_datetimepicker_modal').on('shown.bs.modal', function () {
            $(".modal-backdrop").hide();
        });
        var datepicker = $('#calendar-div').datepicker({
            startDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        datepicker.datepicker("setDate", new Date() ).on('changeDate',function (e){
            // var dateObject = $(this).datepicker('getDate');
            let month = parseInt(e.date.getMonth())+1;
            month = ('0' + month).slice(-2);
            let selectedDate = e.date.getFullYear()+"-"+month+"-"+e.date.getDate();
            $('#meeting_date').val(selectedDate);
            let company_id = $('#company_id').val();
            $('#slot_selected').val('');
            let date = $(this).datepicker('getDate');
            let dayOfWeek = date.getUTCDay();

            getFreeSlots(company_id,dayOfWeek);
        });


        $('#startTime').datetimepicker({
            format: 'LT'
        });

        $('#endTime').datetimepicker({
            format: 'LT'
        });

    });

    function selectAttendeesId(index){
        $("#selectedAttendeeId").val(index);

        var arrEvent = <?php echo json_encode($arrBusinessOpportunities); ?>;
        let event;
        event = arrEvent[index];


        $('#company_id').val(event.ID);
        let date2 = new Date($("#calendar-div").data('datepicker').getFormattedDate('yyyy-mm-dd'));
        let dayOfWeek = date2.getUTCDay()-1;
        getFreeSlots(event.ID,dayOfWeek);
    }

    function scheduleMeeting(){
        let index = $("#selectedAttendeeId").val();
        if($('#startTimeInput').val()==''){
            $('#error-message').css('display','block');
            $('#error-message .alert-danger').html('Please enter meeting start time.')
            return;
        }
        if($('#endTimeInput').val()==''){
            $('#error-message').css('display','block');
            $('#error-message .alert-danger').html('Please enter meeting end time.')
            return;
        }
        var arrAttendee = <?php echo json_encode($arrBusinessOpportunities); ?>;
        let attendee;
        attendee = arrAttendee[index];
        //console.log(attendee);

        $('#error-message').css('display','none');
        var offset = new Date().getTimezoneOffset();
        let timeZoneRegon = Intl.DateTimeFormat().resolvedOptions().timeZone;
        //console.log(offset);
        let selectedDate = $('#meeting_date').val();
        if(!selectedDate){
            // selectedDate = new Date();
            selectedDate = new Date();
            let month = selectedDate.getMonth();
            let day = selectedDate.getDate();
            if(month<10){
                month ="0"+month;
            }
            if(day<10){
                day ="0"+day;
            }
            selectedDate = selectedDate.getFullYear()+"-"+month+"-"+day;
        }
        let StartTime = $('#startTimeInput').val().split(" ")[0];
        let maridiumStart = $('#startTimeInput').val().split(" ")[1];
        let maridiumEnd = $('#endTimeInput').val().split(" ")[1];
        let EndTime = $('#endTimeInput').val().split(" ")[0];

        let hours = moment($('#startTimeInput').val(), "h:mm A");
        let endHours = moment($('#endTimeInput').val(), "h:mm A");

        if(!hours.isBefore(endHours)){
            $('#error-message').css('display','block');
            $('#error-message .alert-danger').html('Please correct your meeting end time.')
            return;
        }
        let slot_selected = $('#slot_selected').val();
        let data = {
            'date':             selectedDate,
            'startTime':        StartTime,
            'endTime':          EndTime,
            'timZone':          timeZoneRegon,
            'maridiumStart':    maridiumStart,
            'maridiumEnd':      maridiumEnd,
            'attendee_email':   attendee.objUser.Email,
            'attendee_id':      attendee.objUser.ID,
            'attendee_name':    attendee.objUser.FirstName+" "+attendee.objUser.LastName,
            'attendee_companyId':  attendee.ID,
            'slot_selected':       slot_selected
        };
        WebApp.post('meetings/createAMeeting',data,function(response){
            if(response.data!=null) {
                $('#closePopUp').trigger('click');
            }else{
                $('#error-message').css('display','block');
                $('#error-message .alert-danger').html(response.message)

            }
        });
    }
    function getFreeSlots(companyId, day){
        let days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday','Sunday'];
        $('#error-message').css('display','none');

        $('#onDay').html('<th scope="col">Available slots on <span class="font-weight-bold" >'+days[day]+'</span></th>');
        let data = {
            'companyId':          companyId,
            'day':                day

        };
        WebApp.post('meetings/getFreeSlots',data,function(response){
            let rows = '';
            if(response.data){
                if(response.data.length<1) {
                    $('#available_slots tbody').html('<tr> No Slot available. </tr>');
                    $('#startTimeInput').removeAttr('disabled');
                    $('#endTimeInput').removeAttr('disabled');
                }else{
                    response.data.forEach((element)=>{
                        // console.log(element);
                        if(element.status=='busy'){
                            //rows +='<tr onclick="javascript:;" class="text-center bg-danger"><td>'+element.freeSlotStart+' to '+element.freeSlotEnd+'</td></tr>';
                        }else{
                            rows +='<tr onclick="updateSelectedTime(\''+element.freeSlotStart+'\',\''+element.freeSlotEnd+'\')" class="text-center"><td>'+element.freeSlotStart+' to '+element.freeSlotEnd+'</td></tr>';
                        }
                    });
                    $('#available_slots tbody').html( rows );
                    $('#startTimeInput').attr('disabled','disabled');
                    $('#endTimeInput').attr('disabled','disabled');
                    $('#startTimeInput').val('');
                    $('#endTimeInput').val('');
                }
            }else{
                $('#available_slots tbody').html('<tr> No Slot available. </tr>');
                $('#startTimeInput').removeAttr('disabled');
                $('#endTimeInput').removeAttr('disabled');
            }
        });
    }
    function updateSelectedTime(startTime, endTime){
        $('#slot_selected').val(1);
        const dateObj = new Date();

        const dateStr = dateObj.toISOString().split('T').shift();
        var time = startTime;

        var timeAndDate = moment(dateStr + ' ' + time);
        var timeAndDate2 = moment(dateStr + ' ' + endTime);
        $('#startTimeInput').val(moment(timeAndDate).format("hh:mm A"));
        $('#endTimeInput').val(moment(timeAndDate2).format("hh:mm A"));
    }

</script>