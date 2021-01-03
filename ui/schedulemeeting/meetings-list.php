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
					</span>Meetings & Calls</h2>
                    <span class="font-weight-normal font-size-h6 ml-12">You can find all the calls and meetings which distributors scheduled with you</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="#" class="btn btn-primary font-weight-bold font-size-base mr-5">Connect your calendar</a>
            <a href="#" data-toggle="modal" data-target="#availabilities_modal" class="btn btn-primary font-weight-bold font-size-base">Edit available time</a>
        </div>
    </div>
</div>

<script>
function fnCallbackSendMessage(webReponse){        
        WebApp.hideModal('.modal');
        webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message);
    }

    $( '.frmSendMessage' ).click(function ( e ) {
        e.preventDefault();
        var $form = $(this).closest(".sendForm");
        var formData = $form.serializeArray();
        WebApp.post('api/message/send', formData, fnCallbackSendMessage)
    });
</script>


<div class="d-flex flex-column-fluid pt-7">
    <div class="container-fluid">
        <input type="hidden" value="" id="company_id"/>
        <input type="hidden" value="" id="slot_selected"/>
        <input type="hidden" value="" id="selectedEventId" />
        <?php foreach ($arrEvents as $key=> $objCall): ?>
            <?php
            $events = $objCall;
            $timestamp = strtotime($events->startTime);
            $DBConvertDateStart = new DateTime("@" . $timestamp);
//            $DBConvertDateStart->setTimezone(new DateTimeZone($DBConvertDateStart->getTimezone()->getName()));
            $DBConvertDate = $DBConvertDateStart->format("M d, Y");

            $endTimestamp = strtotime($events->endTime);

            $availablities = $events->availablities;
            $disabled=false;
            if(is_array($availablities) && count($availablities)<1){
                $disabled = true;
            }

            $day = date('d', $timestamp);
            $month = date('m', $timestamp);
            $year = date('Y', $timestamp);

            $startTime = date("h:i A", $timestamp);

            $datetime_eur = date_create($events->startTimeWZ, timezone_open($events->timezone));
            $timezoneObj = timezone_open($events->timezone);
            $timeZone = ((timezone_offset_get($timezoneObj,$datetime_eur)/3600));
            if($timeZone>0){
                $timeZone = "+".$timeZone;
            }

            $DBConvertDateEnd = new DateTime("@" . $endTimestamp);
            $endTime = date("h:i A", $endTimestamp);

            $compare_date = $DBConvertDateStart->format("Y-m-d");
            $date_now = date("Y-m-d");
            $canceled_status = false;
            $finished_status = false;
            if($events->status=='finished' || ($date_now>$compare_date)){
                $finished_status = true;
            }
            if($events->status == 'canceled'){
                $canceled_status = true;
            }
            ?>
            <div id="card_event_<?php echo $events->eventId ?>" class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img alt="Pic" src="<?php echo $events->company->Logo; ?>">
                            </div>
                        </div>


                        <div class="flex-grow-1">

                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">

                                <div class="mr-3">

                                    <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">
                                        <?php echo $events->company->Name; ?>
                                        <div class="symbol symbol-20 ml-3">
                                            <img alt="Pic" src="<?php echo $events->company->country->FlagPath; ?>">
                                        </div>
                                    </a>


                                    <div class="d-flex flex-wrap my-2">
                                        <div class="symbol symbol-50 mr-5">
                                            <?php if(isset($events->organizer->photoUrl)){ ?>
                                                <img alt="Pic" src="<?php echo $events->organizer->photoUrl; ?>">
                                            <?php }else if(isset($events->organizer->ProfileImage)){ ?>
                                                <img alt="Pic" src="<?php echo $events->organizer->ProfileImage; ?>">
                                            <?php }else{ ?>
                                                <img alt="Pic" src="/theme/assets/media/users/300_20.jpg">
                                            <?php } ?>
                                        </div>
                                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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
                                            <?php echo $events->organizer->email?$events->organizer->email:$events->organizer->Email; ?>
                                        </a>
                                        <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                            <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                     viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <mask fill="white">
                                                        <use xlink:href="#path-1"></use>
                                                        </mask>
                                                        <g></g>
                                                        <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z"
                                                              fill="#000000">
                                                        </path>
                                                    </g>
                                                </svg>

                                            </span><?php echo $events->organizer->position?$events->organizer->position:$events->organizer->JobTitle; ?>
                                        </a>
                                    </div>

                                </div>

                                <?php if($canceled_status){ ?>

                                    <div id="meeting_indicator_<?php echo $events->eventId ?>" class="d-flex align-items-center mr-2 my-1">
                                        <div class="d-flex flex-column text-dark">
                                            <span class="text-dark font-size-h5">
                                                <i id="meeting_indicator_icon_<?php echo $events->eventId ?>" class="flaticon-cancel icon-2x text-danger mr-2"></i>
                                                Meeting is canceled
                                            </span>
                                        </div>
                                    </div>

                                <?php }else if($finished_status){ ?>

                                <div id="meeting_indicator_<?php echo $events->eventId ?>" class="d-flex align-items-center mr-2 my-1">
                                    <div class="d-flex flex-column text-dark">
                                        <span class="text-dark font-size-h5">
                                            <i class="flaticon2-check-mark icon-2x text-primary mr-2"></i>
                                            Meeting is finished
                                        </span>
                                    </div>
                                </div>

                                <?php }else{ ?>
                                <div id="meeting_indicator_<?php echo $events->eventId ?>" class="my-lg-0 my-1 <?php echo ($events->meetingLink)?"":"text-muted"; ?>">
                                    <a href="<?php echo ($events->meetingLink)?"$events->meetingLink":"#"; ?>" target="_blank" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">Open Call
                                        Link</a>
                                    <a href="javascript:void(0);" data-toggle="tooltip" id="copy_element_<?php echo $events->eventId; ?>" data-placement="top" title="Link Copied" onclick="copyTextToClipboard('<?php echo ($events->meetingLink)?"$events->meetingLink":"no"; ?>','<?php echo $events->eventId; ?>')" class="btn btn-sm btn-primary copy_element font-weight-bolder ">Copy Call Link</a>
                                </div>
                                <?php } ?>

                            </div>


                            <div class="d-flex align-items-center flex-wrap justify-content-between">

                                <div class="flex-grow-1 font-weight-bold text-dark-75 py-2 py-lg-2 mr-5">
                                    I want to discuss with you the ability to find distributors in the area of Jordan.
                                    <br>If you are interested please join us in this call.
                                </div>


                                <div class="d-flex mt-2 mt-sm-0">
                                    <div class="d-flex flex-column <?php if($canceled_status || $finished_status){ echo "text-muted";} ?> text-dark-75 mr-10">

                                        <span class="font-weight-bolder text-primary">Date</span>
                                        <span id="start_date_<?php echo $events->eventId; ?>" class="font-weight-bold font-size-h5"><?php echo $DBConvertDate; ?></span>
                                    </div>
                                    <div class="d-flex flex-column <?php if($canceled_status || $finished_status){ echo "text-muted";} ?> text-dark-75">
                                        <span class="font-weight-bolder text-primary">Time</span>
                                        <span id="start_time_<?php echo $events->eventId; ?>" class="font-weight-bold font-size-h5"><?php echo $startTime." "?> GMT<?php echo $timeZone;?></span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="separator separator-solid my-7"></div>


                    <div class="d-flex ">

                        <div class="d-flex align-items-center mr-2 my-1">

                            <div class="d-flex flex-column text-dark-75">
                                <a href="#" onclick="WebApp.showModal('#modalSendMessage_<?php echo $events->eventId ?>')"  class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-mail icon-2x font-weight-bold"></i>
                                </span>
                                    Send a Message</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mr-2 my-1">

                            <div class="d-flex flex-column text-dark-75">
                                <a href="#" data-toggle="modal" data-target="#kt_datetimepicker_modal" onclick="selectEventId('<?php echo $events->eventId;?>','<?php echo $key; ?>')" class="btn btn-lg btn-outline-primary reschedule font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-calendar icon-2x font-weight-bold"></i>
                                </span>
                                    Reschedule</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center my-1">

                            <div class="d-flex flex-column text-dark-75">
                                <a href="#" onclick="cancelMeeting('<?php echo $events->eventId; ?>')"
                                   class="btn btn-lg btn-outline-primary font-weight-bolder btn-hover-danger mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-cancel icon-2x font-weight-bold"></i>
                                </span>
                                    Cancel Meeting</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    <div class="modal fade" id="modalSendMessage_<?php echo $events->eventId ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form class="form sendForm">
                    <input type="hidden" name="cid" value="<?php echo $events->company->ID ?>">
                    <input type="hidden" name="toUserId" value="<?php echo $events->organizer->ID ?>">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Send a message to</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mt-5">
                            <div class="d-flex flex-wrap mt-4">
                                <div class="symbol symbol-50 mr-5">
                                    <img alt="Pic" src=" <?php echo $events->company->Logo != null ? $events->company->Logo : '/assets/img/company.svg'?>">
                                </div>
                                <div class="symbol symbol-50 mr-5">
                                    <img alt="Pic" src=" <?php echo $events->organizer->ProfileImage != null ? $events->organizer->ProfileImage : "/assets/img/user.svg"?> ">
                                </div>
                                <div class="">
                                    <h3><?php echo $events->organizer->FirstName . " ". $events->organizer->LastName ?></h3>
                                    <h4 class="font-weight-light"><?php echo $events->organizer->JobTitle ?> at <span class="font-weight-bold"><?php echo $events->company->Name ?></span></h4>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-10">
                            <label class="font-size-h5 font-weight-bold text-dark">Your email address</label>
                            <input class="form-control h-auto py-3 px-6" type="text" name="email" disabled placeholder="Work email address is recommended" value="<?php echo $userEmail; ?>">
                        </div>

                        <div class="form-group">
                            <label class="font-size-h5 font-weight-bold text-dark mb-5">Message</label>
                            <input class="form-control h-auto py-3 px-6 mb-5" type="text" name="subject" placeholder="subject">
                            <textarea class="form-control" rows="4" name="message" placeholder="message"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="frmSendMessage btn btn-primary">Send Message</button>
                        <button type="button" class="btn btn-secondary" onclick="WebApp.hideModal('#modalSendMessage_<?php echo $events->eventId;?>')">Cancel</button>
                    </div>
                </form>

            </div>

        </div>
    </div>

        <?php endforeach; ?>
    </div>
</div>


<div class="modal fade" id="kt_datetimepicker_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Call Scheduling:</h5>
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
                                    <input value="<?php echo $startTime;?>" id="startTimeInput" type="text" class="form-control form-control-solid datetimepicker-input"
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
                                    <input value="<?php echo $endTime;?>" id="endTimeInput" type="text" class="form-control form-control-solid datetimepicker-input"
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
                    <button type="reset" onclick="rescheduleMeeting();" class="btn btn-secondary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal-->
<!--Start meeting cancel confirmation box-->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this meeting?
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Yes</button>
            </div>
        </div>
    </div>
</div>
<!--End meeting cancel confirmation box-->


<!--This is  availabilities Modal start-->
<div class="modal fade" id="availabilities_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-lg-12 d-flex justify-content-center">
                    <h5 class="modal-title" id="availabilitiesModalLabel">My Availability</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 d-flex justify-content-center">
                    <p class="text-center">Select the time you are not available for meetings at the event. This will effect your availability in matchmaking platform</p>
                </div>
                <div class="col-lg-12">
                    <p class="text-center">All time shown for <a href="#">Asia/Dubai</a></p>
                </div>
            </div>
            <form class="form">
                <div class="modal-body">
                    <div class="row">
                        <div id="error-message" style="display: none;" class="col-12">
                            <div class="alert alert-danger" role="alert">

                            </div>
                        </div>
                    </div>
                    <div class="row availabilities">
                        <table id="availabilities_tbl" class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col"></th>
                                <th scope="col">Mon<a onclick="makeWholeDayBusy(this,'0')" class="btn btn-primary d-block mx-auto">Make day busy</a></th>
                                <th scope="col">Tue<a onclick="makeWholeDayBusy(this,'1')" class="btn btn-primary d-block mx-auto">Make day busy</a></th>
                                <th scope="col">Wed<a onclick="makeWholeDayBusy(this,'2')" class="btn btn-primary d-block mx-auto">Make day busy</a></th>
                                <th scope="col">Thu<a onclick="makeWholeDayBusy(this,'3')" class="btn btn-primary d-block mx-auto">Make day busy</a></th>
                                <th scope="col">Fri<a onclick="makeWholeDayBusy(this,'4')" class="btn btn-primary d-block mx-auto">Make day busy</a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(is_array($allSlots)){
                            foreach ($allSlots as $k=> $availableSlot){
                                ?>
                                <tr class="text-center">
                                    <td scope="col"><?php echo $k; ?></td>
                            <?php
                                    foreach ($availableSlot as $key=> $slot){
                                        $status = 'available';
                                        if($slot['status']=='available'){
                                            $status = 'busy';
                                        }
                            ?>
                                            <td onclick="updateSlotStatus(this,'<?php echo $slot['day']?>','<?php echo $k; ?>')" scope="col" class="<?php echo $slot['status']; ?>"><?php echo ucfirst($slot['status']); ?></td>
                            <?php
                            ?>

                            <?php
                                }?>
                                </tr>
                            <?php
                            }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" id="closeAvailabilitiesPopUp" class="btn btn-primary mr-2" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--This is  availabilities Modal End-->
<script>
    $(function () {

        $("body").on("click",".reschedule",function(){

            var p = $( this );
            var offset = p.offset();

            let screen_height = $( document ).height();
            let screen_width = $( document ).width();
            let left = parseInt(offset.left)+30;
            let left_percent = left / screen_width * 100;

            console.log( "left: " + offset.left + ", top: " + offset.top );

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
            $('.modal-lg').css('left',left_percent+'%');
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
        $('#availabilities_modal').on('shown.bs.modal', function () {
            $(".modal-backdrop").hide();
        });
        $('#confirm').on('shown.bs.modal', function () {
            $(".modal-backdrop").hide();
        });

        let dateSelected = new Date(<?php echo $year; ?>,<?php echo $month-1; ?>,<?php echo $day; ?>);
        let month = parseInt(dateSelected.getMonth())+1;
        let selectedDate = dateSelected.getFullYear()+"-"+month+"-"+dateSelected.getDate();

        $('#meeting_date').val(selectedDate);
        var datepicker = $('#calendar-div').datepicker({
            startDate: new Date(),
            dateFormat: "yy-mm-dd"
        });
        datepicker.datepicker("setDate", new Date(<?php echo $year; ?>,<?php echo $month-1; ?>,<?php echo $day; ?>) ).on('changeDate',function (e){
            // var dateObject = $(this).datepicker('getDate');
            let month = parseInt(e.date.getMonth())+1;
            month = ('0' + month).slice(-2);
            let selectedDate = e.date.getFullYear()+"-"+month+"-"+e.date.getDate();
            $('#meeting_date').val(selectedDate);
            let date = $(this).datepicker('getDate');
            let dayOfWeek = date.getUTCDay();
            let company_id = $('#company_id').val();
            $('#slot_selected').val('');
            console.log(dayOfWeek);
            getFreeSlots(company_id,dayOfWeek);
        });


        $('#startTime').datetimepicker({
            showClose: true,
            format:'LT',
            icons: {
                close: 'OK',
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
            }
        });
        $("#startTime").on("dp.show", function(e) {
            $('.OK').html("Add");
        });
        $('.timepicker button.add').on('click',function(){
            $('.timepicker').hide();
        });

        $('#endTime').datetimepicker({
            format: 'LT',
            stepping:30,
            icons: {
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                close: "fa fa-times"
            }
        });
    });
    function selectEventId(event_id, index){
        console.log(event_id);
        var arrEvent = <?php echo json_encode($arrEvents); ?>;
        let event;
        event = arrEvent[index];
        console.log(event);
        let date = new Date(event.startTimeWZ.split("+")[0]);
        let end_date = new Date(event.endTimeWZ.split("+")[0]);
        let defaultTimeZone = "+0400";

        hours = moment(new Date(event.startTimeWZ).getTime()).zone(defaultTimeZone).format('hh:mm A');
        endHours = moment(new Date(event.endTimeWZ).getTime()).zone(defaultTimeZone).format('hh:mm A');

        $('#startTimeInput').val(hours);
        $('#company_id').val('<?php echo $companyID; ?>');
        $('#endTimeInput').val(endHours);
        $("#selectedEventId").val(event_id);
        let date2 = new Date($("#calendar-div").data('datepicker').getFormattedDate('yyyy-mm-dd'));
        let dayOfWeek = date2.getUTCDay()-1;
        getFreeSlots('<?php echo $companyID; ?>',dayOfWeek);
    }

    function rescheduleMeeting(){
        $('#error-message').css('display','none');
        let defaultTimeZone = "+0400";
        var offset = new Date().getTimezoneOffset();
        let timeZoneRegon = Intl.DateTimeFormat().resolvedOptions().timeZone;

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

        //console.log(offset);
        let selectedDate =  $('#meeting_date').val();
        let StartTime =     $('#startTimeInput').val().split(" ")[0];
        let maridiumStart = $('#startTimeInput').val().split(" ")[1];
        let maridiumEnd =   $('#endTimeInput').val().split(" ")[1];
        let EndTime =       $('#endTimeInput').val().split(" ")[0];
        let event_id =      $("#selectedEventId").val();

        let hours = moment($('#startTimeInput').val(), "h:mm A");
        let endHours = moment($('#endTimeInput').val(), "h:mm A");

        if(!hours.isBefore(endHours)){
            $('#error-message').css('display','block');
            $('#error-message .alert-danger').html('Please correct your meeting end time.')
            return;
        }
        let slot_selected = $('#slot_selected').val();
        let data = {
            'date':               selectedDate,
            'startTime':          StartTime,
            'endTime':            EndTime,
            'event_id':           event_id,
            'timZone':            timeZoneRegon,
            'maridiumStart':      maridiumStart,
            'maridiumEnd':        maridiumEnd,
            'slot_selected':      slot_selected

        };
        WebApp.post('meetings/updateAMeeting',data,function(response){
            if(response.data!=null) {
                let date = new Date(selectedDate);
                const month = date.toLocaleString('default', {month: 'long'});
                let timezone = parseInt((date.getTimezoneOffset() / 60))*(-1);

                if(timezone<0){
                    timezone = "-"+timezone;
                }else{
                    timezone = "+"+timezone;
                }
                let startDate = month.substring(0, 3) + ", " + date.getDate() + " " + date.getFullYear();
                $("#start_time_" + event_id).text(StartTime+" "+maridiumStart +" GMT"+timezone);
                $("#start_date_" + event_id).text(startDate);
                $('#closePopUp').trigger('click');
            }else{
                $('#error-message').css('display','block');
                $('#error-message .alert-danger').html(response.message)
                console.log(response.message);
            }
        });
    }

    // Cancel meeting/event
    $('button[name="remove_levels"]').on('click', function(e) {
        var $form = $(this).closest('form');
        e.preventDefault();
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
            .on('click', '#delete', function(e) {
                $form.trigger('submit');
            });
        $("#cancel").on('click',function(e){
            e.preventDefault();
            $('#confirm').modal.model('hide');
        });
    });

    function cancelMeeting(event_id){
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        }).on('click', '#delete', function(e) {
                let data = {'event_id':event_id};
                WebApp.post('meetings/cancelMeeting', data, function (response) {

                    $('#meeting_indicator_'+event_id).html(
                        '<div class="d-flex flex-column text-dark"> <span class="text-dark font-size-h5"> <i id="meeting_indicator_icon_'+event_id+'" class="flaticon-cancel icon-2x text-danger mr-2"></i>Meeting is canceled </span> </div>'
                    );

                });
            });
        $("#cancel").on('click',function(e){
            e.preventDefault();
            $('#confirm').modal.model('hide');
        });
    }

    function copyTextToClipboard(text,event_id) {
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(function() {
            if(text!='no') {
                $('#copy_element_'+event_id).attr('title','Link Copied');
            }else{
                $('#copy_element_'+event_id).attr('title','No meeting link available.');
            }
            $('#copy_element_'+event_id).tooltip({
                trigger: 'click'
            });

        }, function(err) {
            console.error('Async: Could not copy text: ', err);
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
                }
            }else{
                $('#available_slots tbody').html('<tr> No Slot available. </tr>');
                $('#startTimeInput').removeAttr('disabled');
                $('#endTimeInput').removeAttr('disabled');
            }
        });
    }

    function updateSlotStatus($this, day, time){
        let timeZoneRegon = Intl.DateTimeFormat().resolvedOptions().timeZone;
        let data = {
            'time':               time,
            'timeZone':           timeZoneRegon,
            'day':                day

        };
        WebApp.post('meetings/updateSlotStatus',data,function(response){
            let rows = '';
            if(response.data){
                $($this).text(response.data.status);
                if(response.data.status=='Busy'){
                    $($this).addClass('busy');
                }else{
                    $($this).removeClass('busy');
                }
            }
        });
    }
    function makeWholeDayBusy($this, day){
        let timeZoneRegon = Intl.DateTimeFormat().resolvedOptions().timeZone;
        let data = {
            'timeZone':           timeZoneRegon,
            'day':                day

        };
        WebApp.post('meetings/makeWholeDayBusy',data,function(response){
            if(response.data){
                $("#availabilities_tbl").find('tr').each(function () {
                    var $td = $(this).find('td');
                    $td.eq(parseInt(day)+1).text('Busy');
                    $td.eq(parseInt(day)+1).addClass('busy');
                });
            }
        });
    }

    //This function is converting 24 hours slot selection to 12 hours for user in the input field
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