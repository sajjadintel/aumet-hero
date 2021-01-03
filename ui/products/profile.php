<div id="kt_subheader" class="subheader subheader-solid  m-n7">
    <div class="card-body pt-0 px-0 pb-3">
        <div style="background-color: #0a6aa1; background-image: url('<?php echo $objManufacturerCompany->Banner != null ? $objManufacturerCompany->Banner : '/assets/img/samplebg-1.jpeg'?>');background-repeat: no-repeat;background-size: 100%;background-position: top center;" class="d-flex mb-4 h-175px justify-content-between">
        </div>
        <div class="container">
            <div class="d-flex">
                <div class="flex-shrink-0 mr-7  mt-n15 ">
                    <div class="image-input image-input-empty image-input-outline mr-5" style="background-image: url('<?php echo $objManufacturerCompany->Logo != null ? $objManufacturerCompany->Logo : '/assets/img/company.svg'?>')">
                        <div class="image-input-wrapper"></div>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="mr-3">
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h2 font-weight-boldest text-uppercase mr-3"><?php echo $objManufacturerCompany->Name ?></a>
                            <div class="d-flex flex-wrap mt-1">
                                <div class="d-flex flex-column flex-grow-1 pr-8">
                                    <div class="d-flex flex-wrap text-dark-50 font-size-h3 font-weight-bold mt-2">
                                        <span><?php echo $objCountry->Name ?></span>
                                        <div class="d-flex align-items-center m1-lg-5 ml-3 mb-lg-0 mb-2">
                                            <?php if ($objCountry->FlagPath != "") : ?>
                                                <span class="symbol symbol-30">
                                                    <img alt="Pic" src="<?php echo $objCountry->FlagPath ?>">
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="my-lg-0 my-3">
                            <a href="javascript:;" class="btn btn-primary font-weight-bold mb-5 mt-3 px-12 font-size-h4" onclick="WebApp.loadPage('browse/manufacturer/<?php echo $objManufacturerCompany->ID ?>')">View Manufacturer</a>
                            <?php if ($backURL): ?>
                                <a href="javascript:;" class="btn btn-outline-primary font-weight-bold mb-5 mt-3 px-12 font-size-h4 ml-5" onclick="WebApp.loadPage('<?php echo $backURL ?>')">Back</a>
                            <?php endif; ?>
                        </div>
                    </div>
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

<div class="container mb-12">
    <div class="row">
        <div class="col-12">
            <div class="card card-custom mt-15 px-0">
                <div class="row p-15">
                    <div class="col-6 text-center">
                        <div class="text-left">
                            <span class="font-size-h6 text-primary mx-2"><?php echo $objProduct->medicalLineName ?></span> /
                            <span class="font-size-h6 text-primary mx-2"><?php echo $objProduct->specialityName ?></span> /
                            <span class="font-size-h6 text-primary mx-2"><?php echo $objProduct->childSpecialityName ?></span> /
                            <span class="font-size-h6 text-dark mx-2"><?php echo $objProduct->scientificName ?></span></div>
                        <?php if ($arrProductImages) : ?>
                            <div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
                                <div class="carousel-cell"><img class="max-h-300px mt-15" src="<?php echo $objProduct->image ?>"/></div>
                                <?php foreach ($arrProductImages as $image) : ?>
                                    <div class="carousel-cell"><img class="max-h-300px mt-15" src="<?php echo $image['URL']; ?>"/></div>
                                <?php endforeach; ?>    
                            </div>
                            <div class="carousel carousel-nav"
                                data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
                                <div class="carousel-cell"><img class="max-h-120px max-w-90px" src="<?php echo $objProduct->image; ?>"/></div>
                                <?php foreach ($arrProductImages as $image) : ?>
                                    <div class="carousel-cell"><img class="max-h-120px max-w-90px" src="<?php echo $image['URL']; ?>"/></div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <img class="max-h-300px mt-15" src="<?php echo $objProduct->image ?>"/>
                        <?php endif ?>
                    </div>
                    <div class="col-6">
                        <h1 class="font-size-h1"><?php echo $objProduct->title ?></h1>
                        <p class="mt-6 font-size-h4">
                            <?php echo $objProduct->subTitle ?>
                        </p>
                        <div class="row mt-15">
                            <div class="col-12">
                                <h5 class="font-size-h5 text-dark-65">Incharge Person</h5>
                            </div>
                            <div class="col-8">

                                <div class="mt-7">
                                    <div class="d-flex flex-wrap mt-4">
                                        <div class="symbol symbol-100">
                                            <img alt="Pic" src=" <?php echo $objInchargePerson->ProfileImage != null ? $objInchargePerson->ProfileImage : "/assets/img/user.svg"?> ">
                                        </div>
                                        <div class="ml-4">
                                            <h3><?php echo $objInchargePerson->FirstName . " ". $objInchargePerson->LastName ?></h3>
                                            <h3 class="font-weight-light"><?php echo $objInchargePerson->JobTitle ?></h3>

                                            <span class="text-dark text-hover-primary font-weight-bold mt-10">
                                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"/>
                                                        <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                                                    </g>
                                                </svg>

                                                </span>Responds in 24 hours
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-4 text-right">
                                <a class="btn btn-primary px-10 mt-25" onclick="WebApp.showModal('#modalSendMessage')">Send Message</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-7">
        <div class="col-4">
            <!--begin::Card-->
            <div class="card card-custom card-stretch">
                <div class="card-body">
                    <h3 class="">Overview</h3>
                    <h6 class="text-dark-50 mt-8">Product Origin</h6>
                    <h6 class="text-dark mt-5"><?php echo $objOriginCountry->Name ?>
                        <span class="symbol symbol-20 ml-2">
                            <img alt="Pic" src="<?php echo $objOriginCountry->FlagPath ?>">
                        </span>
                    </h6>
                    <?php if ($arrProductSpecialities) : ?>
                        <h6 class="text-dark-50 mt-10">Specialties</h6>
                        <div class="font-weight-normal font-size-h6 mt-5">
                                <?php foreach ($arrProductSpecialities as $objItem) : ?>
                                    <span class="d-flex align-items-center mb-2">
                                        <img src="<?php echo $objItem->image ?>" class="mr-5" style="width:24px">
                                        <?php echo $objItem->name ?>
                                    </span>
                                <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($arrSoldTo) : ?>
                        <h6 class="text-dark-50 mt-10">This Product is sold to these entities.</h6>
                        <div class="d-inline font-weight-normal font-size-h6 mt-5">
                                <?php foreach ($arrSoldTo as $objSoldTo) : ?>
                                    <p class="d-inline">
                                        <?php echo $objSoldTo['Name'] ?>,
                                    </p>
                                <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!--end::Card-->

        </div>
        <div class="col-8">
            <!--begin::Card-->
            <div class="card card-custom card-stretch ">
                <div class="card-body">
                    <h3 class="mb-8">Description</h3>
                    <?php if($objProduct->subTitle != "" && $objProduct->subTitle != null): ?>
                        <h6 class="text-dark-50">Product Overview</h6>
                        <p class="text-dark mt-5 font-size-h6">
                            <?php echo $objProduct->subTitle ?>
                        </p>
                    <?php endif; ?>
                    <?php if($objProduct->description != "" && $objProduct->description != null): ?>
                    <h6 class="text-dark-50 mt-10">Product Highlights</h6>
                    <p class="text-dark mt-5 font-size-h6">
                        <?php echo html_entity_decode($objProduct->description) ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
    <div class="row mt-7">
        <div class="col-4">
            <?php if ($arrCompanyDocuments) : ?>
            <div class="card card-custom card-stretch">
                <div class="card-body">
                    <h3 class="">Manufacturer Documents</h3>

                        <?php foreach ($arrCompanyDocuments as $objItem) : ?>
                            <a href="<?php echo $objItem->Link; ?>" target="_blank" class="d-flex align-items-center mb-2" style="text-decoration: underline;">
                                <?php echo $objItem->description; ?>
                            </a>
                        <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-8">
            <?php if ($arrCatalogs) : ?>
            <div class="card card-custom card-stretch ">
                <div class="card-body">

                        <h3 class="mb-8">Catalogs</h3>
                        <div class="row">
                        <?php foreach ($arrCatalogs as $objCatalog): ?>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-custom overlay">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper p-10">
                                            <img src="<?php echo $objCatalog->previewImageUrl; ?>" alt="" class="w-100 rounded" />
                                        </div>
                                        <div class="overlay-layer bg-dark-o-80">
                                            <a href="<?php echo $objCatalog->catalogueUrl; ?>" target='_blank' class="btn font-size-h4 font-weight-bold btn-primary px-10 btn-shadow">View</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-center font-size-h5 font-weight-bolder mt-5 mb-10"><?php echo $objCatalog->name; ?></p>
                            </div>
                        <?php endforeach; ?>
                        </div>

                </div>
            </div>
            <?php endif; ?>
        </div>
</div>
</div>
<div class="container-fluid ask-section-container mt-10 mb-10 ml-n7 mr-n7">
    <div class="container text-center mt-20 mb-20">
        <div class="row">
            <div class="col-12">
                <p class="font-size-h1 font-weight-boldest">What do you need to know about this product?</p>
            </div>
        </div>          
        <div class="row mt-10">
            <div class="col-12">
                <a href="javascript:;" onclick="WebApp.showModal('#modalSendMessage')" class="p-6 btn btn-primary font-weight-bold mb-5 mt-3 mr-10 font-size-h4" onclick="WebApp.loadPage('browse/manufacturer/221179')">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-10-081610/theme/html/demo2/dist/../src/media/svg/icons/Shopping/Dollar.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">                        
                        <rect fill="#000000" opacity="0.3" x="11.5" y="16" width="2" height="5" rx="1"/>
                        <path style="fill: #ffff !important;" d="M15.493,8.044 C15.2143319,7.68933156 14.8501689,7.40750104 14.4005,7.1985 C13.9508311,6.98949895 13.5170021,6.885 13.099,6.885 C12.8836656,6.885 12.6651678,6.90399981 12.4435,6.942 C12.2218322,6.98000019 12.0223342,7.05283279 11.845,7.1605 C11.6676658,7.2681672 11.5188339,7.40749914 11.3985,7.5785 C11.2781661,7.74950085 11.218,7.96799867 11.218,8.234 C11.218,8.46200114 11.2654995,8.65199924 11.3605,8.804 C11.4555005,8.95600076 11.5948324,9.08899943 11.7785,9.203 C11.9621676,9.31700057 12.1806654,9.42149952 12.434,9.5165 C12.6873346,9.61150047 12.9723317,9.70966616 13.289,9.811 C13.7450023,9.96300076 14.2199975,10.1308324 14.714,10.3145 C15.2080025,10.4981676 15.6576646,10.7419985 16.063,11.046 C16.4683354,11.3500015 16.8039987,11.7268311 17.07,12.1765 C17.3360013,12.6261689 17.469,13.1866633 17.469,13.858 C17.469,14.6306705 17.3265014,15.2988305 17.0415,15.8625 C16.7564986,16.4261695 16.3733357,16.8916648 15.892,17.259 C15.4106643,17.6263352 14.8596698,17.8986658 14.239,18.076 C13.6183302,18.2533342 12.97867,18.342 12.32,18.342 C11.3573285,18.342 10.4263378,18.1741683 9.527,17.8385 C8.62766217,17.5028317 7.88033631,17.0246698 7.285,16.404 L9.413,14.238 C9.74233498,14.6433354 10.176164,14.9821653 10.7145,15.2545 C11.252836,15.5268347 11.7879973,15.663 12.32,15.663 C12.5606679,15.663 12.7949989,15.6376669 13.023,15.587 C13.2510011,15.5363331 13.4504991,15.4540006 13.6215,15.34 C13.7925009,15.2259994 13.9286662,15.0740009 14.03,14.884 C14.1313338,14.693999 14.182,14.4660013 14.182,14.2 C14.182,13.9466654 14.1186673,13.7313342 13.992,13.554 C13.8653327,13.3766658 13.6848345,13.2151674 13.4505,13.0695 C13.2161655,12.9238326 12.9248351,12.7908339 12.5765,12.6705 C12.2281649,12.5501661 11.8323355,12.420334 11.389,12.281 C10.9583312,12.141666 10.5371687,11.9770009 10.1255,11.787 C9.71383127,11.596999 9.34650161,11.3531682 9.0235,11.0555 C8.70049838,10.7578318 8.44083431,10.3968355 8.2445,9.9725 C8.04816568,9.54816454 7.95,9.03200304 7.95,8.424 C7.95,7.67666293 8.10199848,7.03700266 8.406,6.505 C8.71000152,5.97299734 9.10899753,5.53600171 9.603,5.194 C10.0970025,4.85199829 10.6543302,4.60183412 11.275,4.4435 C11.8956698,4.28516587 12.5226635,4.206 13.156,4.206 C13.9160038,4.206 14.6918294,4.34533194 15.4835,4.624 C16.2751706,4.90266806 16.9686637,5.31433061 17.564,5.859 L15.493,8.044 Z" fill="#000000"/>
                    </g>
                </svg><!--end::Svg Icon--></span>
                Price List</a>
                <a href="javascript:;" onclick="WebApp.showModal('#modalSendMessage')" class="p-6 btn btn-primary font-weight-bold mb-5 mt-3 mr-10 font-size-h4">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-10-081610/theme/html/demo2/dist/../src/media/svg/icons/Map/Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path style="fill: #ffff !important;" d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                    </g>
                </svg><!--end::Svg Icon--></span>Available in Your Country</a>
                <a href="javascript:;" onclick="WebApp.showModal('#modalSendMessage')" class="p-6 btn btn-primary font-weight-bold mb-5 mt-3 mr-10 font-size-h4">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-10-081610/theme/html/demo2/dist/../src/media/svg/icons/Code/Compiling.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path style="fill: #ffff !important;" d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"/>
                    </g>
                </svg><!--end::Svg Icon--></span>
                Quality certificate</a>
                <a href="javascript:;" onclick="WebApp.showModal('#modalSendMessage')" class="p-6 btn btn-primary font-weight-bold mb-5 mt-3 mr-10 font-size-h4">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-12-10-081610/theme/html/demo2/dist/../src/media/svg/icons/Code/Question-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                        <path style="fill: #ffff !important;" d="M12,16 C12.5522847,16 13,16.4477153 13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 C11,16.4477153 11.4477153,16 12,16 Z M10.591,14.868 L10.591,13.209 L11.851,13.209 C13.447,13.209 14.602,11.991 14.602,10.395 C14.602,8.799 13.447,7.581 11.851,7.581 C10.234,7.581 9.121,8.799 9.121,10.395 L7.336,10.395 C7.336,7.875 9.31,5.922 11.851,5.922 C14.392,5.922 16.387,7.875 16.387,10.395 C16.387,12.915 14.392,14.868 11.851,14.868 L10.591,14.868 Z" fill="#000000"/>
                    </g>
                </svg><!--end::Svg Icon--></span>
                General Question</a>
            </div>
        </div>          
    </div>
</div>
<div class="container mt-10 related-product-section">    
        <?php if ($objRelatedProducts) : ?>
            <p class="font-size-h1 font-weight-boldest">Other Products from the same manufacturer</p>
                        <div class="row">
                        <?php foreach ($objRelatedProducts as $objItem): ?>
                            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 column">
                                <div class="card card-custom card-stretch">
                                    <div class="card-body p-0">
                                        <div class="overlay">
                                            <div class="overlay-wrapper p-10">
                                                <img src="<?php echo $objItem->image; ?>" alt="" class="w-100 rounded related-product-image" />
                                            </div>
                                            <div class="overlay-layer rounded bg-dark-o-80">
                                                <a href="javascript:;" onclick="WebApp.loadPage('browse/product/<?php echo $objItem->id ?>')" class="btn font-size-h4 font-weight-bold btn-primary px-10 btn-shadow">View</a>
                                            </div>
                                        </div>
                                        <p class="text-center font-size-h5 text-primary font-weight-bolder mt-2 mb-5"><?php echo $objItem->title; ?></p>
                                        <p class="text-center font-size-h6 font-weight-bolder mb-10"><?php echo $objItem->scientificName; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
            <?php endif; ?>       
</div>
<div class="container mt-10">    
        <?php if ($arrSimilarProductsByScientificName) : ?>
            <p class="font-size-h1 font-weight-boldest">Other <?php echo $objProduct->scientificName ?> </p>
                        <div class="row">
                        <?php foreach ($arrSimilarProductsByScientificName as $objItem): ?>                        
                            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-custom card-stretch">
                                    <div class="card-body p-0">
                                        <div class="overlay">
                                            <div class="overlay-wrapper p-10 ">
                                                <img src="<?php echo $objItem->image; ?>" alt="" class="w-100 rounded" />
                                            </div>
                                            <div class="overlay-layer rounded bg-dark-o-80">
                                                <a href="javascript:;" onclick="WebApp.loadPage('browse/product/<?php echo $objItem->id ?>')" class="btn font-size-h4 font-weight-bold btn-primary px-10 btn-shadow">View</a>
                                            </div>
                                        </div>
                                        <p class="text-center font-size-h5 text-primary font-weight-bolder mt-2 mb-5"><?php echo $objItem->title; ?></p>
                                        <p class="text-center font-size-h6 font-weight-bolder mb-10"><?php echo $objItem->scientificName; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
            <?php endif; ?>       
</div>

<div class="modal fade" id="modalSendMessage"   data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form id="frmSendMessage" class="form">
                <input type="hidden" name="pid" value="<?php echo $objProduct->id ?>">
                <input type="hidden" name="cid" value="<?php echo $objManufacturerCompany->ID ?>">
                <input type="hidden" name="toUserId" value="<?php echo $objInchargePerson->ID ?>">
                <div class="modal-header">
                    <h5 class="modal-title text-primary">Send a message to</h5>
                </div>
                <div class="modal-body">
                    <div class="mt-5">
                        <div class="d-flex flex-wrap mt-4">
                            <div class="symbol symbol-50 mr-5">
                                <img alt="Pic" src=" <?php echo $objManufacturerCompany->Logo != null ? $objManufacturerCompany->Logo : '/assets/img/company.svg'?>">
                            </div>
                            <div class="symbol symbol-50 mr-5">
                                <img alt="Pic" src=" <?php echo $objInchargePerson->ProfileImage != null ? $objInchargePerson->ProfileImage : "/assets/img/user.svg"?> ">
                            </div>
                            <div class="">
                                <h3><?php echo $objInchargePerson->FirstName . " ". $objInchargePerson->LastName ?></h3>
                                <h4 class="font-weight-light"><?php echo $objInchargePerson->JobTitle ?> at <span class="font-weight-bold"><?php echo $objManufacturerCompany->Name ?></span></h4>
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
<!-- JavaScript -->
<script src="/assets/js/flickity.min.js" defer="defer"></script>