<div class="subheader subheader-transparent" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">

                <div class="d-flex flex-column text-dark-75">
                    <h4 class="text-dark  mr-5 line-height-xl">
                    <span class="svg-icon svg-icon-xxl mr-1">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M3,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L3,8 C2.44771525,8 2,7.55228475 2,7 C2,6.44771525 2.44771525,6 3,6 Z" fill="#000000" opacity="0.3"/>
                                <path d="M10,6 L22,6 C23.1045695,6 24,6.8954305 24,8 L24,16 C24,17.1045695 23.1045695,18 22,18 L10,18 C8.8954305,18 8,17.1045695 8,16 L8,8 C8,6.8954305 8.8954305,6 10,6 Z M21.0849395,8.0718316 L16,10.7185839 L10.9150605,8.0718316 C10.6132433,7.91473331 10.2368262,8.02389331 10.0743092,8.31564728 C9.91179228,8.60740125 10.0247174,8.9712679 10.3265346,9.12836619 L15.705737,11.9282847 C15.8894428,12.0239051 16.1105572,12.0239051 16.294263,11.9282847 L21.6734654,9.12836619 C21.9752826,8.9712679 22.0882077,8.60740125 21.9256908,8.31564728 C21.7631738,8.02389331 21.3867567,7.91473331 21.0849395,8.0718316 Z" fill="#000000"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
					</span>
                        Sent Introduction to
                        <span class="text-primary font-weight-bolder">
                            <?php echo $objDistributor->Name; ?></span>
                        from
                        <span>
                            <div class="symbol symbol-25 mr-3">
                                <span class="text-dark font-weight-bolder">
                                    <?php echo $objDistributor->objCountry->Name; ?>
                                    <img alt="" class="ml-2" style="max-width: 30px"
                                         src="<?php echo $objDistributor->objCountry->FlagPath; ?>"/>
                                </span>
                            </div>
                        </span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function fnCallbackSendMessage(webReponse){        
        WebApp.hideModal('#modalSendMessage');
        webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message);
    }

    $( '#frmSendMessage' ).submit(function ( e ) {
        e.preventDefault();
        WebApp.postFormData('#frmSendMessage','api/message/send', (new FormData(this)), fnCallbackSendMessage)
    });
</script>

<div class="d-flex flex-column-fluid pt-10">
    <div class="container-fluid">
        <form id="frmIntroduction">
            <div class="card card-custom gutter-b d-none">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-1">
                                <div class="col-3">
                                    <span class="font-size-h6 font-weight-bolder">From:</span>
                                </div>
                                <div class="col-9">
                                    <span class="font-size-h6 font-weight-normal">info@aumet.com</span>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-3">
                                    <span class="font-size-h6 font-weight-bolder">Sent to:</span>
                                </div>
                                <div class="col-9">
                                    <span class="font-size-h6 font-weight-normal"><?php echo $objDistributor->objUser != null ? $objDistributor->objUser->FirstName . " ". $objDistributor->objUser->LastName  : ""?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <span class="font-size-h6 font-weight-bolder">Subject:</span>
                                </div>
                                <div class="col-9">
                                    <span class="font-size-h6 font-weight-normal">Business Opportunity in <?php echo $objDistributor->objCountry->Name; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right" id="sendIntroductionActionsContainer">
                            <a href="javascript:;" class="btn btn-sm btn-outline-primary font-weight-normal font-size-h5 py-2 px-5"
                               onclick="WebApp.loadPage('introductions')">Back</a>
                        </div>
                    </div>
                    <div class="separator separator-solid my-8"></div>
                    <div class="row">
                        <div class="d-flex">
                            <div class="flex-shrink-0 mr-7">
                                <div class="symbol symbol-100">
                                    <img alt="Pic" src="<?php echo $objDistributor->Logo != null ? $objDistributor->Logo : '/assets/img/company.svg' ?>">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-4">
                                    <div class="mr-3">
                                        <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h4 font-weight-bold mr-3">
                                            <?php echo $objDistributor->Name ?>
                                            <i class="flaticon2-correct text-success icon-md ml-2"></i></a>


                                        <div class="d-flex flex-wrap mt-4">
                                            <div class="symbol symbol-50">
                                                <img alt="Pic" src="<?php echo $objDistributor->objUser != null && $objDistributor->objUser->ProfileImage != null ? $objDistributor->objUser->ProfileImage : '/assets/img/user.svg'?>">
                                            </div>
                                            <div class="ml-4">
                                                <h6><?php echo $objDistributor->objUser != null ? $objDistributor->objUser->FirstName . " ". $objDistributor->objUser->LastName  : ""?></h6>
                                                <a href="#"
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
                                                    <?php echo $objDistributor->objUser != null ? $objDistributor->objUser->Email : ""?></a>
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

                                                    </span><?php echo $objDistributor->objUser != null ? $objDistributor->objUser->JobTitle : ""?></a>
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

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            

            <div class="container">
                <div class="row mb-10">
                    <div class="col-12">
                        <img src="/assets/img/aumet-logo.svg" class="w-150px">
                    </div>
                </div>
                <input type="hidden" value="" id="company_id"/>
                <input type="hidden" value="" id="slot_selected"/>
                <input type="hidden" value="" id="selectedEventId" />
                <input type="hidden" value="" id="selectedAttendeeId" />
                <div class="card card-custom gutter-b">
                    <div class="card-body px-20 py-14">
                            <div class="d-flex flex-row">
                                <div class="form-group">
                                    <div class="image-input image-input-empty image-input-outline mr-5" style="background-image: url('<?php echo $objUser->photoUrl != null ? $objUser->photoUrl : '/assets/img/user.svg'?>')">
                                        <div class="image-input-wrapper"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class="font-size-h3 mb-5"><strong>Message from <?php echo $objUser->FirstName.' '.$objUser->LastName ?> </strong></p>
                                    <p class="font-size-h6"><?php echo $objUser->JobTitle ?> at <?php echo $objCompany->Name ?></p>
                                    <p class="font-size-h6"><?php echo $objIntroduction->message ?></p>
                                </div>
                                <div class="ml-auto p-2">
                                    <a href="javascript:;" class="btn btn-lg btn-outline-primary font-weight-bold font-size-base mr-5" onclick="WebApp.showModal('#modalSendMessage')">Send a Message</a>
                                    <a href="#" data-toggle="modal" data-target="#kt_datetimepicker_modal" onclick="selectAttendeesId('0')" class="btn btn-primary font-weight-bold font-size-base">Schedule a call</a>
                                </div>
                            </div>                            

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="image-input image-input-empty image-input-outline mr-5" style="background-image: url('<?php echo $objCompany->Logo != null ? $objCompany->Logo : '/assets/img/company.svg'?>')">
                                    <div class="image-input-wrapper"></div>
                                </div>
                                <h2 class="mt-5 font-weight-bold"><?php echo $objCompany->Name ?></h2>
                                <div class="symbol symbol-25 mt-2">
                                        <span class="text-dark font-weight-bold font-size-h2">
                                            <img alt="" class="mr-2" style="max-width: 50px"
                                                 src="<?php echo $objCountry->FlagPath; ?>"/>
                                            <?php echo $objCountry->Name; ?>
                                        </span>
                                </div>
                                <div class="form-group row mt-5">
                                    <div class="col-12">
                                        <p class="font-size-h3"> <strong>Manufacturer of </strong><?php echo $objIntroduction->manufacturerOf ?></p>                                        
                                    </div>
                                </div>
                                <div class="mt-4">
                                                <a onclick="WebApp.loadPage('browse/manufacturer/<?php echo $objIntroduction->toCompanyId ?>')" href="javascript:;" class="btn btn-sm btn-outline-primary font-weight-normal font-size-h5 py-2 px-5">
                                                    View Profile
                                                </a>
                                </div>  

                            </div>
                        </div>

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12 mb-5">
                                <h2 class="text-dark mt-5">Product Range</h2>
                            </div>
                            <div class="col-12" id="manufacturer-products">
                                <?php $counter = 0; ?>
                                <?php foreach ($arrProducts as $objProduct): ?>
                                    <input type="hidden" name="productId[]" value="<?php echo $objProduct->id; ?>">
                                    <div class="d-flex align-items-center mb-8">
                                        <div class="symbol symbol-150 mr-10 pt-1">
                                            <div class="symbol-label min-w-100px min-h-100px" style="background-image: url('<?php echo $objProduct->image; ?>')"></div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div>
                                                <a href="#" class="text-primary font-weight-boldest text-hover-primary font-size-h3 mb-4"><?php echo $objProduct->title; ?></a>
                                                <span class="text-dark-75 font-weight-bold font-size-md pb-4 show-read-more"><?php echo html_entity_decode($objProduct->subTitle); ?></span>
                                            </div>
                                            <div class="mt-4">
                                                <a onclick="WebApp.loadPage('browse/product/<?php echo $objProduct->id ?>')" href="javascript:;" class="btn btn-sm btn-outline-primary font-weight-normal font-size-h5 py-2 px-5">
                                                    View Product
                                                </a>
                                            </div>    
                                        </div>
                                    </div>
                                    <div class="separator separator-solid mb-5"></div>
                                    <?php
                                    $counter++;
                                    if($counter > 3) {
                                        //break;
                                    }
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        </div>                                    

                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-dark mt-5">Brand Advantages</h2>
                                <h6 class="text-dark mt-5">Here are the advantages of the brand</h6>
                            </div>
                        </div>
                        <div id="_BrandAdvantagesFormRepeater">
                                <?php $arrColors = ['#3AAEE0', '#593ae0', '#E0B53A', '#e03a3a' ]; $i=0; ?>
                                    <?php foreach ($objBrandAdv as $obj): ?>
											<div class="button-container" align="left" style="padding-top:10px;padding-right:30px;padding-bottom:10px;padding-left:40px;">
												<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 30px; padding-bottom: 10px; padding-left: 40px" align="left"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:33pt; width:178.5pt; v-text-anchor:middle;" arcsize="60%" stroke="false" fillcolor="#3AAEE0"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:16px"><![endif]-->
												<div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:<?php echo $arrColors[$i%4];?>;border-radius:26px;-webkit-border-radius:26px;-moz-border-radius:26px;width:auto; width:auto;;border-top:1px solid <?php echo $arrColors[$i%4];?>;border-right:1px solid<?php echo $arrColors[$i%4];?>;border-bottom:1px solid <?php echo $arrColors[$i%4];?>;border-left:1px solid <?php echo $arrColors[$i%4];?>;padding-top:10px;padding-bottom:10px;font-family:Arial, Helvetica Neue, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;"><span style="font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px;"><span style="line-height: 24px; font-size: 16px;" data-mce-style="line-height: 24px; font-size: 16px;"><?php echo $obj->strAdvantage;?></span></span></span></div>
												<!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
											</div>
                                            <?php $i++;?>
                                    <?php endforeach;?>
                        </div>

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-dark mt-5">Deadline</h2>
                            </div>
                        </div>
                        <div class="form-group row">                                        
                            <div class="col-12">                                
                                    <h3 class="text-dark mt-5">Last date to approve</h3>
                            </div>
                        </div>
						<div style="form-group row">
							<div class="button-container">
                                    <div class="deadline-section">                                        
                                        <span class="p-4">
                                                <?php echo $endDate; ?>
                                        </span>
                                    </div>												
							</div>
						</div>

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-dark mt-5">Exclusivity Commercial Terms</h2>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label font-size-h4 text-right">Exclusivity Period (Years):</label>
                            <div class="col-6">
								<div class="button-container">
									<div class="exclusive-period-year">
                                        <span style="padding-left:30px;padding-right:30px;font-size:16px;display:inline-block;">
                                                <?php echo $objIntroduction->exclusivityPeriod; ?>                                            
                                        </span>
                                    </div>
								</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label font-size-h4 text-right">Other Terms:</label>
                            <div class="col-6">                                
                                <div class="button-container">
									<div class="exclusive-period-year">
                                    <span style="padding-left:30px;padding-right:30px;font-size:16px;display:inline-block;"><span style="font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px;"><?php echo $objIntroduction->exclusivityTerms; ?></span></span></div>
								</div>
                            </div>
                        </div>

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-dark mt-5">Company Documents</h2>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="dropzone dropzone-multi" style="min-height: auto !important;">
                                    <div class="dropzone-items">
                                        <?php foreach ($arrManufacturerDocuments as $objFile): ?>
                                            <div class="dropzone-item" style="">
                                                <div class="dropzone-file">
                                                    <div class="dropzone-filename" title="<?php echo $objFile->description ?>">
                                                        <span data-dz-name=""><a target="_blank" href="<?php echo $objFile->Link ?>"><?php echo $objFile->description == "" ? "Open Document" : $objFile->description ?></a></span>
                                                    </div>
                                                </div>
                                                <div class="dropzone-progress">
                                                    <div class="progress" style="opacity: 0;">
                                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress="" style="opacity: 0; width: 100%;"></div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-toolbar">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>                                            
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <a href="javascript:;" class="btn btn-sm btn-outline-primary font-weight-normal font-size-h5 py-2 px-5"
                           onclick="WebApp.loadPage('introductions')">Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalSendMessage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form id="frmSendMessage" class="form">
                    <input type="hidden" name="cid" value="<?php echo $objCompany->ID ?>">
                    <input type="hidden" name="toUserId" value="<?php echo $objUser->ID ?>">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Send a message to</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mt-5">
                            <div class="d-flex flex-wrap mt-4">
                                <div class="symbol symbol-50 mr-5">
                                    <img alt="Pic" src=" <?php echo $objCompany->Logo != null ? $objCompany->Logo : '/assets/img/company.svg'?>">
                                </div>
                                <div class="symbol symbol-50 mr-5">
                                    <img alt="Pic" src=" <?php echo $objUser->ProfileImage != null ? $objUser->ProfileImage : "/assets/img/user.svg"?> ">
                                </div>
                                <div class="">
                                    <h3><?php echo $objUser->displayName ?></h3>
                                    <h4 class="font-weight-light"><?php echo $objUser->position ?> at <span class="font-weight-bold"><?php echo $objCompany->Name ?></span></h4>
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
                        <button type="submit" class="btn btn-primary">Send Message</button>
                        <button type="button" class="btn btn-secondary" onclick="WebApp.hideModal('#modalSendMessage')">Cancel</button>
                    </div>
                </form>

            </div>

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
<script>
    $(function () {

        $("body").on("click",".reschedule",function(){

            var p = $( this );
            var offset = p.offset();

            let screen_height = $( document ).height();
            let screen_width = $( document ).width();
            let left = parseInt(offset.left)+30;
            let left_percent = (screen_width-left) / screen_width * 100;

            console.log( "left: " + offset.left + ", top: " + offset.top+" screen width "+screen_width );

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
