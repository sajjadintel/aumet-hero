<div class="container mb-12">
    <div class="row">
        <div class="col-12">
            <div class="card card-custom px-0">
                <div class="row p-15">
                    <div class="col-5 text-center">
                        <img class="max-h-150px mt-7" src="<?php echo $objProduct->image ?>"/>
                    </div>
                    <div class="col-7">
                        <h3 class="font-size-h3 mb-2"><?php echo $objProduct->title ?></h3>
                        <div class="font-size-base text-left mb-7"><span class=" text-primary mr-1"><?php echo $objProduct->medicalLineName ?></span> / <span class="text-primary mx-2"><?php echo $objProduct->specialityName ?></span> / <span class="text-dark mx-2"><?php echo $objProduct->scientificName ?></span></div>
                        <p class="mt-6 font-size-h6">
                            <?php echo $objProduct->subTitle ?>
                        </p>

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
</div>