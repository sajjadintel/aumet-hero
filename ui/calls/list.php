<script>
    WebFB.logPageView('meetings');
</script>
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
            <a href="#" class="btn btn-primary font-weight-bold font-size-base">Edit available time</a>
        </div>
    </div>
</div>

<div class="d-flex flex-column-fluid pt-7">
    <div class="container-fluid">
        <?php foreach ($arrCalls as $objCall): ?>
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img alt="Pic" src="https://www.mckesson.com/img/svg/mck_logo_blue.svg">
                            </div>
                        </div>


                        <div class="flex-grow-1">

                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">

                                <div class="mr-3">

                                    <a href="#"
                                       class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">McKesson
                                        Corporation
                                        <div class="symbol symbol-20 ml-3">
                                            <img alt="Pic" src="/theme/assets/media/svg/flags/260-united-kingdom.svg">
                                        </div>
                                    </a>


                                    <div class="d-flex flex-wrap my-2">
                                        <div class="symbol symbol-50 mr-5">
                                            <img alt="Pic" src="/theme/assets/media/users/300_20.jpg">
                                        </div>
                                        <a href="#"
                                           class="text-dark-75 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>maria@mckesson.com</a>
                                        <a href="#"
                                           class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>PR Manager</a>
                                    </div>

                                </div>


                                <div class="my-lg-0 my-1">
                                    <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">Open Call
                                        Link</a>
                                    <a href="#" class="btn btn-sm btn-primary font-weight-bolder ">Copy Call Link</a>
                                </div>

                            </div>


                            <div class="d-flex align-items-center flex-wrap justify-content-between">

                                <div class="flex-grow-1 font-weight-bold text-dark-75 py-2 py-lg-2 mr-5">
                                    I want to discuss with you the ability to find distributors in the area of Jordan.
                                    <br>If you are interested please join us in this call.
                                </div>


                                <div class="d-flex mt-2 mt-sm-0">
                                    <div class="d-flex flex-column text-dark-75 mr-10">
                                        <span class="font-weight-bolder text-primary">Date</span>
                                        <span class="font-weight-bold font-size-h5">Jan 13, 2021</span>
                                    </div>
                                    <div class="d-flex flex-column text-dark-75">
                                        <span class="font-weight-bolder text-primary">Time</span>
                                        <span class="font-weight-bold font-size-h5">03:30 PM GMT+4</span>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="separator separator-solid my-7"></div>


                    <div class="d-flex ">

                        <div class="d-flex align-items-center mr-2 my-1">

                            <div class="d-flex flex-column text-dark-75">
                                <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-mail icon-2x font-weight-bold"></i>
                                </span>
                                    Send a Message</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mr-2 my-1">

                            <div class="d-flex flex-column text-dark-75">
                                <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-calendar icon-2x font-weight-bold"></i>
                                </span>
                                    Reschedule</a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center my-1">

                            <div class="d-flex flex-column text-dark-75">
                                <a href="#"
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
        <?php endforeach; ?>

        <div class="card card-custom gutter-b">
            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic" src="https://www.mckesson.com/img/svg/mck_logo_blue.svg">
                        </div>
                    </div>


                    <div class="flex-grow-1">

                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">

                            <div class="mr-3">

                                <a href="#"
                                   class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">McKesson
                                    Corporation
                                    <div class="symbol symbol-20 ml-3">
                                        <img alt="Pic" src="/theme/assets/media/svg/flags/260-united-kingdom.svg">
                                    </div>
                                </a>


                                <div class="d-flex flex-wrap my-2">
                                    <div class="symbol symbol-50 mr-5">
                                        <img alt="Pic" src="/theme/assets/media/users/300_20.jpg">
                                    </div>
                                    <a href="#"
                                       class="text-dark-75 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>maria@mckesson.com</a>
                                    <a href="#"
                                       class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>PR Manager</a>
                                </div>

                            </div>


                            <div class="my-lg-0 my-1">
                                <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder mr-2">Open Call
                                    Link</a>
                                <a href="#" class="btn btn-sm btn-primary font-weight-bolder ">Copy Call Link</a>
                            </div>

                        </div>


                        <div class="d-flex align-items-center flex-wrap justify-content-between">

                            <div class="flex-grow-1 font-weight-bold text-dark-75 py-2 py-lg-2 mr-5">
                                I want to discuss with you the ability to find distributors in the area of Jordan.
                                <br>If you are interested please join us in this call.
                            </div>


                            <div class="d-flex mt-2 mt-sm-0">
                                <div class="d-flex flex-column text-dark-75 mr-10">
                                    <span class="font-weight-bolder text-primary">Date</span>
                                    <span class="font-weight-bold font-size-h5">Jan 13, 2021</span>
                                </div>
                                <div class="d-flex flex-column text-dark-75">
                                    <span class="font-weight-bolder text-primary">Time</span>
                                    <span class="font-weight-bold font-size-h5">03:30 PM GMT+4</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="separator separator-solid my-7"></div>


                <div class="d-flex ">

                    <div class="d-flex align-items-center mr-2 my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-mail icon-2x font-weight-bold"></i>
                                </span>
                                Send a Message</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mr-2 my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-calendar icon-2x font-weight-bold"></i>
                                </span>
                                Reschedule</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder btn-hover-danger mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-cancel icon-2x font-weight-bold"></i>
                                </span>
                                Cancel Meeting</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="card card-custom gutter-b">
            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic"
                                 src="https://www.medline.com/wp-content/uploads/2019/05/medline-logo-180-180.jpg">
                        </div>
                    </div>


                    <div class="flex-grow-1">

                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">

                            <div class="mr-3">

                                <a href="#"
                                   class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">Medline
                                    <div class="symbol symbol-20 ml-3">
                                        <img alt="Pic" src="/theme/assets/media/svg/flags/226-united-states.svg">
                                    </div>
                                </a>


                                <div class="d-flex flex-wrap my-2">
                                    <div class="symbol symbol-50 mr-5">
                                        <img alt="Pic" src="/theme/assets/media/users/300_6.jpg">
                                    </div>
                                    <a href="#"
                                       class="text-dark-75 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>mike@medline.com</a>
                                    <a href="#"
                                       class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>Director</a>
                                </div>

                            </div>


                            <div class="d-flex align-items-center mr-2 my-1">

                                <div class="d-flex flex-column text-dark">
                                <span class="text-dark font-size-h5">
                                    <i class="flaticon2-check-mark icon-2x text-primary mr-2"></i>
                                    Meeting is finished
                                </span>

                                </div>
                            </div>

                        </div>


                        <div class="d-flex align-items-center flex-wrap justify-content-between">

                            <div class="flex-grow-1 font-weight-bold text-dark-75 py-2 py-lg-2 mr-5">
                                I want to discuss with you the ability to find distributors in the area of Jordan.
                                <br>If you are interested please join us in this call.
                            </div>


                            <div class="d-flex mt-2 mt-sm-0">
                                <div class="d-flex flex-column text-muted mr-10">
                                    <span class="font-weight-bolder text-muted">Date</span>
                                    <span class="font-weight-bold font-size-h5">Sep 22, 2020</span>
                                </div>
                                <div class="d-flex flex-column text-muted">
                                    <span class="font-weight-bolder text-muted">Time</span>
                                    <span class="font-weight-bold font-size-h5">10:45 AM GMT+4</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="separator separator-solid my-7"></div>


                <div class="d-flex ">

                    <div class="d-flex align-items-center mr-5 my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-mail icon-2x font-weight-bold"></i>
                                </span>
                                Send a Message</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder btn-hover-danger mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-safe-shield-protection icon-2x font-weight-bold"></i>
                                </span>
                                Report Scam/Abuse</a>
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="card card-custom gutter-b">
            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120">
                            <img alt="Pic"
                                 src="https://media-exp1.licdn.com/dms/image/C560BAQHbqyrdXvDV8Q/company-logo_200_200/0?e=2159024400&v=beta&t=-a60a3CQs2OKagquLVlMta0B3mrhDMbrKV7jn_PviC0">
                        </div>
                    </div>


                    <div class="flex-grow-1">

                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">

                            <div class="mr-3">

                                <a href="#"
                                   class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">AmerisourceBergen
                                    <div class="symbol symbol-20 ml-3">
                                        <img alt="Pic" src="/theme/assets/media/svg/flags/226-united-states.svg">
                                    </div>
                                </a>


                                <div class="d-flex flex-wrap my-2">
                                    <div class="symbol symbol-50 mr-5">
                                        <img alt="Pic" src="/theme/assets/media/users/300_12.jpg">
                                    </div>
                                    <a href="#"
                                       class="text-dark-75 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>john@amerisourcebergen.com</a>
                                    <a href="#"
                                       class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
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

</span>Business Development Manager</a>
                                </div>

                            </div>


                            <div class="d-flex align-items-center mr-2 my-1">

                                <div class="d-flex flex-column text-dark">
                                <span class="text-dark font-size-h5">
                                    <i class="flaticon-cancel icon-2x text-danger mr-2"></i>
Meeting is canceled
</span>

                                </div>
                            </div>

                        </div>


                        <div class="d-flex align-items-center flex-wrap justify-content-between">

                            <div class="flex-grow-1 font-weight-bold text-dark-75 py-2 py-lg-2 mr-5">
                                I want to discuss with you the ability to find distributors in the area of Jordan.
                                <br>If you are interested please join us in this call.
                            </div>


                            <div class="d-flex mt-2 mt-sm-0">
                                <div class="d-flex flex-column text-muted mr-10">
                                    <span class="font-weight-bolder text-muted">Date</span>
                                    <span class="font-weight-bold font-size-h5">Dec 19, 2020</span>
                                </div>
                                <div class="d-flex flex-column text-muted">
                                    <span class="font-weight-bolder text-muted">Time</span>
                                    <span class="font-weight-bold font-size-h5">08:20 AM GMT+4</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="separator separator-solid my-7"></div>


                <div class="d-flex ">

                    <div class="d-flex align-items-center mr-5 my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-mail icon-2x font-weight-bold"></i>
                                </span>
                                Send a Message</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mr-2 my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-calendar icon-2x font-weight-bold"></i>
                                </span>
                                Reschedule</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center my-1">

                        <div class="d-flex flex-column text-dark-75">
                            <a href="#" class="btn btn-lg btn-outline-primary font-weight-bolder btn-hover-danger mr-2">
                                <span class="mr-2">
                                    <i class="flaticon-safe-shield-protection icon-2x font-weight-bold"></i>
                                </span>
                                Report Scam/Abuse</a>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // predefined ranges
    var start = moment().startOf('month');
    var end = moment().endOf('month');

    $('#dashboardDateRange').daterangepicker({
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',

        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, function (start, end, label) {
        $('#dashboardDateRange .form-control').val(start.format('DD/MM/YY') + ' - ' + end.format('DD/MM/YY'));
    });
</script>