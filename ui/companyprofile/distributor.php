<div class="subheader subheader-solid" id="kt_subheader">
    <div class="card-body">

        <div class="d-flex mb-4 h-175px mx-n9 mt-n9 justify-content-between p-2" style="background-color: #0a6aa1;background-image: url('<?php echo $objDistributorCompany->Banner ? $objDistributorCompany->Banner : "/assets/img/samplebg-1.jpeg" ?>');background-repeat: no-repeat;background-size: 100%;background-position: top center;">
        </div>

        <div class="container">
            <div class="d-flex mb-5">

                <div class="flex-shrink-0 mr-7  mt-n15 ">
                    <div class="image-input image-input-empty image-input-outline mr-5" style="background-image: url('<?php echo $objDistributorCompany->Logo != null ? $objDistributorCompany->Logo : '/assets/img/company.svg'?>')">
                        <div class="image-input-wrapper"></div>
                    </div>
                </div>

                <div class="flex-grow-1">

                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="mr-3">
                            <a href="#" class="text-dark-75 text-hover-primary font-size-h2 font-weight-boldest text-uppercase mr-3"><?php echo $objDistributorCompany->Name ?></a>
                            <div class="d-flex flex-wrap mt-1">
                                <div class="d-flex flex-column flex-grow-1 pr-8">
                                    <div class="d-flex flex-wrap text-dark-50 font-size-h5 font-weight-bold mb-4">
                                        <span><?php echo $objCompanyCountry->Name ?></span>
                                        <div class="d-flex align-items-center m1-lg-5 ml-3 mb-lg-0 mb-2">

                                            <?php if ($objCompanyCountry->FlagPath != "") : ?>
                                                <span class="symbol symbol-20 mr-10">
                                                    <img alt="Pic" src="<?php echo $objCompanyCountry->FlagPath ?>">
                                                </span>
                                            <?php endif; ?>
                                            <span class="mr-5">|</span>
                                        </div>
                                        <span class="ml-lg-5 ml-3 text-capitalize">Medical <?php echo $objDistributorCompany->Type ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="my-lg-0 my-3">
                            <?php if($enableEdit): ?>
                                <a href="javascript:;" class="btn btn-primary font-weight-bold mb-5 mt-3 px-12 font-size-h4" onclick="WebApp.loadPage('mycompanyprofile/edit')">Edit My Company Profile</a>
                            <?php endif; ?>
                            <?php if($enableSendIntroduction): ?>
                                <a href="javascript:;" class="btn btn-primary font-weight-bold mb-5 mt-3 px-12 font-size-h4" onclick="WebApp.loadPage('potentialdistributors/country/<?php echo $objCompanyCountry->ID ?>/sendintroduction/<?php echo $objDistributorCompany->ID ?>')">Send Introduction</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <?php if($objDistributorCompany->Description): ?>
            <div class="d-flex mb-5">
                <span class="font-weight-bold text-dark-75 font-size-h6">
                    <div class="scroll scroll-pull" data-scroll="true" data-wheel-propagation="true" style="height: 150px" id="descriptionContainer">
                        <?php echo html_entity_decode(str_replace("<p><br></p>", '', $objDistributorCompany->Description)); ?>
                    </div>
                </span>
            </div>
            <?php endif; ?>
            <div class="separator separator-solid"></div>

            <div class="d-flex  justify-content-between flex-wrap mt-8">
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-diagram display-4 text-primary font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-h6">Annual Sales</span>
                        <span class="font-weight-bolder font-size-h4">
                            <?php echo $objDistributorCompany->AnnualSales == null ? "<span class='text-muted'>Not Available<span>" : $objDistributorCompany->AnnualSales ?>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-customer display-4 text-primary font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bold font-size-h6">Employees</span>
                        <span class="font-weight-bolder font-size-h4"><?php echo $objDistributorCompany->NumberOfEmployees == null ? "<span class='text-muted'>Not Available<span>" : $objDistributorCompany->NumberOfEmployees ?></span>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-calendar-1 display-4 text-primary font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bold font-size-h6">Established in</span>
                        <span class="font-weight-bolder font-size-h4"> <?php echo $objDistributorCompany->EstablishmentDate == null ? "<span class='text-muted'>Not Available<span>" :  date("Y", strtotime($objDistributorCompany->EstablishmentDate)) ?> </span>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-file-2 display-4 text-primary font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column flex-lg-fill">
                        <span class="text-dark-75 font-weight-bold font-size-h6"><?php echo(count($arrCompanyDocuments)); ?> Documents</span>
                        <a href="#" class="text-primary font-weight-bolder font-size-h4">view</a>
                    </div>
                </div>
                <div class="d-flex align-items-center flex-lg-fill mr-5 mb-2">
                    <span class="mr-4">
                        <i class="flaticon-trophy display-4 text-primary font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column">
                        <span class="text-dark-75 font-weight-bolder font-size-h6">Specialized in</span>
                        <?php if ($arrDistributorSpecialities) : ?>
                            <a href="#distributorSpecialities" class="text-primary font-weight-bold">
                                <?php $itemsCounter = 0; ?>
                                <?php foreach ($arrDistributorSpecialities as $objItem) : ?>
                                    <?php if ($itemsCounter < 3) : ?>
                                        <span class="label label-light-dark label-inline mr-1 mb-1"><?php echo $objItem->specialityName ?></span>
                                    <?php endif; ?>
                                    <?php $itemsCounter++; ?>
                                <?php endforeach; ?>
                                <?php if ($itemsCounter >= 3) : ?>
                                    <span class="label label-light label-inline"><?php echo "+" . ($itemsCounter - 3); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
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

<div class="d-flex flex-column-fluid mt-10">

    <div class="container">

        <div class="d-flex flex-row">

            <div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">

                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 pt-5">
                        <h3 class="font-weight-boldest pt-5">Incharge Person</h3>
                    </div>

                    <div class="card-body pt-4">

                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-80 mr-5 align-self-start align-self-center">
                                <div class="symbol-label" style="background-image: url('<?php echo $objDistributorCompany->user != null ? $objDistributorCompany->user : '/assets/img/user.svg' ?>')"></div>
                            </div>

                            <div>
                                <a href="javascript:;" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"><?php echo $objInchargePerson->FirstName . ' ' . $objInchargePerson->LastName; ?></a>
                                <div class="text-muted mb-4"><?php echo $objInchargePerson->JobTitle; ?></div>
                                <div class="mt-2">
                                    <span class="label label-success label-inline">Responds in 24 hour</span>
                                </div>
                            </div>
                        </div>

                        <?php if(!$enableEdit): ?>
                        <div class="pb-3 mt-12">
                            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="WebApp.showModal('#modalSendMessage')">Send a message</button>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 pt-5">
                        <h3 class="font-weight-boldest pt-5">Distributor pictures</h3>
                    </div>
                    <div class="card-body symbol-list d-flex flex-wrap">
                        <?php if ($arrCompanyPhotos) : ?>
                            <?php $counter = 0; ?>
                            <?php foreach ($arrCompanyPhotos as $objItem) : ?>
                                <div class="symbol symbol-85 mr-3 mb-3">                                    
                                    <img alt="Pic" src="<?php echo $objItem->Link ?>" />
                                    <?php $counter++;
                                    if ($counter == 9) {
                                        $remain_pic = count($arrCompanyPhotos) - $counter;
                                        echo '<span class="symbol-label font-size-h2" style="position:absolute; top:0; background: #000000aa; color:white; font-weight: 700">+'.$remain_pic.'</span></div>';
                                        break;
                                    }
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 pt-5">
                        <h3 class="font-weight-boldest pt-5">Overview</h3>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="text-muted mb-3">Address</h5>
                        <p class="font-weight-normal font-size-h4"><?php echo $objDistributorCompany->Address == null ? "<span class='font-size-h4 font-weight-normal'>Not Available<span>" : $objDistributorCompany->Address ?></p>
                        <h5 class="text-muted mt-5 mb-3" id="distributorSpecialities">Specialties:</h5>
                        <div class="font-weight-normal font-size-h4">
                            <?php if ($arrDistributorSpecialities) : ?>
                                <?php foreach ($arrDistributorSpecialities as $objItem) : ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="<?php echo $objItem->specialityImage ?>" class="mr-5" style="width:24px">
                                        <?php echo $objItem->specialityName ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <?php if($objDistributorCompany->facebookUrl || $objDistributorCompany->linkedinUrl || $objDistributorCompany->twitterUrl || $objDistributorCompany->youtubeUrl): ?>
                        <h5 class="text-dark-65 mt-5 mb-3">Social Media:</h5>
                        <div class="font-weight-normal font-size-h4">
                            <?php if($objDistributorCompany->facebookUrl): ?>
                            <div class="d-flex align-items-center mb-2">
                               <a class="socicon-btn socicon-facebook text-dark-50" href="<?php echo $objDistributorCompany->facebookUrl ?>" target="_blank">Facebook Profile Link</a>
                            </div>
                            <?php endif; ?>
                            <?php if($objDistributorCompany->linkedinUrl): ?>
                            <div class="d-flex align-items-center mb-2">
                                <a class="socicon-btn socicon-linkedin text-dark-50" href="<?php echo $objDistributorCompany->linkedinUrl ?>" target="_blank">LinkedIn Profile Link</a>
                            </div>
                            <?php endif; ?>
                            <?php if($objDistributorCompany->twitterUrl): ?>
                            <div class="d-flex align-items-center mb-2">
                                <a class="socicon-btn socicon-twitter text-dark-50" href="<?php echo $objDistributorCompany->twitterUrl ?>" target="_blank">Twitter Profile Link</a>
                            </div>
                            <?php endif; ?>
                            <?php if($objDistributorCompany->youtubeUrl): ?>
                            <div class="d-flex align-items-center mb-2">
                                <a class="socicon-btn socicon-youtube text-dark-50" href="<?php echo $objDistributorCompany->youtubeUrl ?>" target="_blank">Youtube Channel Link</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 pt-5">
                        <h3 class="font-weight-boldest pt-5">Distributor documents</h3>
                    </div>

                    <div class="card-body d-flex flex-column pt-3">
                        <div class="font-weight-normal font-size-h4">
                            <?php if ($arrCompanyDocuments) : ?>
                                <?php foreach ($arrCompanyDocuments as $objItem) : ?>
                                    <a href="<?php echo $objItem->Link; ?>" target="_blank" class="d-flex align-items-center mb-2" style="text-decoration: underline;">
                                        <?php echo $objItem->description; ?>
                                    </a>                                    
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>


            <div class="flex-row-fluid ml-lg-8">
            <input type="hidden" value="<?php echo $totalProducts; ?>" id="randomNumber" />
            <input type="hidden" value="<?php echo $distributorId; ?>" id="disti"/>  
                <!--
                <div class="card card-custom gutter-b">


                    <div class="card-header border-0 py-10">
                        <h3 class="align-items-start flex-column">
                            <span class="card-label font-weight-boldest text-dark">Represented Brands</span>
                        </h3>
                    </div>


                    <div class="card-body pt-0 pb-3">
                        <input type="hidden" value="<?php// echo $totalProducts; ?>" id="randomNumber" />
                        <div id="Distributor-products">
                        </div>
                        <div class="text-center pb-3">
                            <a href="javascript:void(0);" class="see-more font-size-h6 font-weight-bolder" onclick="seeMoreProducts()">SEE MORE <i class="ki ki-arrow-down ml-2 text-primary"></i></a>
                            <a href="javascript:void(0);" class="see-less font-size-h6 font-weight-bolder" onclick="seeLessProducts()">SEE LESS <i class="ki ki-arrow-up ml-2 text-primary"></i></a>
                        </div>

                    </div>

                </div>
                -->

                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 py-10">
                        <h3 class="card-label font-weight-boldest">
                            Catalogs
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <?php if ($arrCatalogs) : ?>
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
                        <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 py-10">
                        <h3 class="card-label font-weight-boldest">
                            Sales Network
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-wrap">
                            <div id="chartdiv" style="width: 100%; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<div class="modal fade" id="modalSendMessage" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form id="frmSendMessage" class="form">
                    <input type="hidden" name="cid" value="<?php echo $objDistributorCompany->ID ?>">
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


<script>

    const ps = new PerfectScrollbar('#descriptionContainer', {
        wheelSpeed: 2,
        wheelPropagation: true,
        minScrollbarLength: 20
    });

    var imgProfile = new KTImageInput('imgProfile');

    var maxLength = 300;
    $(".show-read-more").each(function() {
        var myStr = $(this).text();
        if ($.trim(myStr).length > maxLength) {
            var newStr = myStr.substring(0, maxLength);
            var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
            $(this).empty().html(newStr);
            $(this).append(' <a href="javascript:void(0);" class="read-more">see more...</a>');
            $(this).append('<span class="more-text">' + removedStr + '</span>');
        }
    });
    $(".read-more").click(function() {
        $(this).siblings(".more-text").contents().unwrap();
        $(this).remove();
    });

    function extractContent(s, space) {
        var span = document.createElement('span');
        span.innerHTML = s;
        if (space) {
            var children = span.querySelectorAll('*');
            for (var i = 0; i < children.length; i++) {
                if (children[i].textContent)
                    children[i].textContent += ' ';
                else
                    children[i].innerText += ' ';
            }
        }
        return [span.textContent || span.innerText].toString().replace(/ +/g, ' ');
    };

    var pagelimit = 5;
    var totalProducts = 0;
    var distributorId = undefined;
    $(document).ready(function() {
        totalProducts = $('#randomNumber').val();
        distributorId = $('#disti').val();
        loadProducts(pagelimit, totalProducts, true, distributorId);
    });

    function seeMoreProducts() {        
        pagelimit +=5;
        loadProducts(pagelimit, totalProducts, false, distributorId);
    }

    function seeLessProducts() {
        pagelimit -=5;
        loadProducts(pagelimit, totalProducts, false, distributorId);
    }

   function loadProducts(_pagelimit, _totalProducts, initial_load, distriId) {
        WebApp.loadPartialPage('#Distributor-products', 'distributor-products/'+_pagelimit+'/'+_totalProducts+'/'+distriId, function(res){
            if(res.errorCode == 0) {

                if(res.message=="No More Products Found!") {
                    $('.see-more').hide();
                    $('.see-less').show();
                } else {
                    $('.see-less').hide();
                    $('.see-more').show();
                }
            }
        });
    }
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create map instance
        var chart = am4core.create("chartdiv", am4maps.MapChart);

        // Set map definition
        chart.geodata = am4geodata_worldLow;

        // Set projection
        chart.projection = new am4maps.projections.Miller();

        // Create map polygon series
        var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

        // Exclude Antartica
        polygonSeries.exclude = ["AQ"];

        // Make map load polygon (like country names) data from GeoJSON
        polygonSeries.useGeodata = true;

        // Configure series
        var polygonTemplate = polygonSeries.mapPolygons.template;
        polygonTemplate.tooltipText = "{name}";
        polygonTemplate.polygon.fillOpacity = 0.6;


        // Create hover state and set alternative fill color
        var hs = polygonTemplate.states.create("hover");
        hs.properties.fill = chart.colors.getIndex(0);

        // Add image series
        var imageSeries = chart.series.push(new am4maps.MapImageSeries());
        imageSeries.mapImages.template.propertyFields.longitude = "longitude";
        imageSeries.mapImages.template.propertyFields.latitude = "latitude";
        imageSeries.mapImages.template.tooltipText = "{title}";
        imageSeries.mapImages.template.propertyFields.url = "url";

        var circle = imageSeries.mapImages.template.createChild(am4core.Circle);
        circle.radius = 3;
        circle.propertyFields.fill = "color";

        var circle2 = imageSeries.mapImages.template.createChild(am4core.Circle);
        circle2.radius = 3;
        circle2.propertyFields.fill = "color";


        circle2.events.on("inited", function(event) {
            animateBullet(event.target);
        })


        function animateBullet(circle) {
            var animation = circle.animate([{
                property: "scale",
                from: 1,
                to: 5
            }, {
                property: "opacity",
                from: 1,
                to: 0
            }], 1000, am4core.ease.circleOut);
            animation.events.on("animationended", function(event) {
                animateBullet(event.target.object);
            })
        }

        var colorSet = new am4core.ColorSet();

        imageSeries.data = [

            {
            "title": "Brussels",
            "latitude": 50.8371,
            "longitude": 4.3676,
            "color": colorSet.next()
        }, {
            "title": "Copenhagen",
            "latitude": 55.6763,
            "longitude": 12.5681,
            "color": colorSet.next()
        }, {
            "title": "Paris",
            "latitude": 48.8567,
            "longitude": 2.3510,
            "color": colorSet.next()
        }, {
            "title": "Reykjavik",
            "latitude": 64.1353,
            "longitude": -21.8952,
            "color": colorSet.next()
        }, {
            "title": "Moscow",
            "latitude": 55.7558,
            "longitude": 37.6176,
            "color": colorSet.next()
        }, {
            "title": "Madrid",
            "latitude": 40.4167,
            "longitude": -3.7033,
            "color": colorSet.next()
        }, {
            "title": "London",
            "latitude": 51.5002,
            "longitude": -0.1262,
            "url": "http://www.google.co.uk",
            "color": colorSet.next()
        }, {
            "title": "Peking",
            "latitude": 39.9056,
            "longitude": 116.3958,
            "color": colorSet.next()
        }, {
            "title": "New Delhi",
            "latitude": 28.6353,
            "longitude": 77.2250,
            "color": colorSet.next()
        }, {
            "title": "Tokyo",
            "latitude": 35.6785,
            "longitude": 139.6823,
            "url": "http://www.google.co.jp",
            "color": colorSet.next()
        }, {
            "title": "Ankara",
            "latitude": 39.9439,
            "longitude": 32.8560,
            "color": colorSet.next()
        }, {
            "title": "Buenos Aires",
            "latitude": -34.6118,
            "longitude": -58.4173,
            "color": colorSet.next()
        }, {
            "title": "Brasilia",
            "latitude": -15.7801,
            "longitude": -47.9292,
            "color": colorSet.next()
        }, {
            "title": "Ottawa",
            "latitude": 45.4235,
            "longitude": -75.6979,
            "color": colorSet.next()
        }, {
            "title": "Washington",
            "latitude": 38.8921,
            "longitude": -77.0241,
            "color": colorSet.next()
        }, {
            "title": "Kinshasa",
            "latitude": -4.3369,
            "longitude": 15.3271,
            "color": colorSet.next()
        }, {
            "title": "Cairo",
            "latitude": 30.0571,
            "longitude": 31.2272,
            "color": colorSet.next()
        }, {
            "title": "Pretoria",
            "latitude": -25.7463,
            "longitude": 28.1876,
            "color": colorSet.next()
        }];
    }); // end am4core.ready()

</script>