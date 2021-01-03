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

<div class="d-flex flex-column-fluid pt-10">
    <div class="container-fluid">
        <form id="frmIntroduction">
            <div class="card card-custom gutter-b">
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
                <div class="card card-custom gutter-b">
                    <div class="card-body px-20 py-14">
                        <div class="row  d-flex align-items-center">
                            <div class="image-input image-input-empty image-input-outline mr-5" style="background-image: url('<?php echo $objUser->photoUrl != null ? $objUser->photoUrl : '/assets/img/user.svg'?>')">
                                <div class="image-input-wrapper"></div>
                            </div>
                            <div class="form-group d-flex flex-column flex-grow-1">
                                <label class="font-size-h3 mb-5">Message from <?php echo $objUser->displayName ?> - <?php echo $objUser->position ?> at <?php echo $objCompany->Name ?></label>
                                <textarea class="form-control" rows="4" name="message" readonly disabled><?php echo $objIntroduction->message ?></textarea>
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
                                    <label class="col-4 col-form-label font-size-h3 text-right">Manufacturer of</label>
                                    <div class="col-4">
                                        <input class="form-control" type="text" name="manufacturerOf"  readonly disabled value="<?php echo $objIntroduction->manufacturerOf ?>" >
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12" id="manufacturer-products">
                                <?php $counter = 0; ?>
                                <?php foreach ($arrProducts as $objProduct): ?>
                                    <input type="hidden" name="productId[]" value="<?php echo $objProduct->id; ?>">
                                    <div class="d-flex align-items-center mb-8">
                                        <div class="symbol symbol-150 mr-10 pt-1">
                                            <div class="symbol-label min-w-100px min-h-100px" style="background-image: url('<?php echo $objProduct->image; ?>')"></div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-primary font-weight-boldest text-hover-primary font-size-h3 mb-4"><?php echo $objProduct->title; ?></a>
                                            <span class="text-dark-75 font-weight-bold font-size-md pb-4 show-read-more"><?php echo html_entity_decode($objProduct->subTitle); ?></span>
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
                            <div class="form-group row mt-5">
                                <div data-repeater-list="brandAdvantage" class="col">
                                    <div data-repeater-item class="mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="la la-star"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your brand advantage" name="advantage" />
                                            <div class="input-group-append">
                                                <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                                    <i class="la la-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col text-right">
                                    <div data-repeater-create="" class="btn font-weight-bold btn-primary">
                                        <i class="la la-plus"></i>
                                        Add Brand Advantage
                                    </div>
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
                                <input type="number" class="form-control col-6" placeholder="Recommended 3 years" name="exclusivityPeriod" readonly disabled value="<?php echo $objIntroduction->exclusivityPeriod ?>">
                                <span class="form-text text-muted">Please enter your exclusivity period in years</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label font-size-h4 text-right">Other Terms:</label>
                            <div class="col-6">
                                <textarea class="form-control" rows="3" name="exclusivityTerms" readonly disabled ><?php echo $objIntroduction->exclusivityTerms ?></textarea>
                                <span class="form-text text-muted">Please enter any other exclusivity terms you may have</span>
                            </div>
                        </div>

                        <div class="separator separator-solid  my-6"></div>

                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-dark mt-5">Manufacturer Documents</h2>
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