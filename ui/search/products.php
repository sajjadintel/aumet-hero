<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <?php foreach ($arrProducts as $objProduct): ?>
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Top-->
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-80 ">
                            <img alt="Pic" src="<?= $objProduct->image ?>">
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                            <!--begin::User-->
                            <div class="mr-3">
                                <!--begin::Name-->
                                <a href="/en/browse/product/<?= $objProduct->id ?>" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3"><?= $objProduct->title ?></a>
                                <!--end::Name-->
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">

                                    <a href="#" class="text-primary font-weight-bold mx-2 mb-lg-0 mb-2"><?= $objProduct->medicalLineName ?></a> /
                                    <a href="#" class="text-primary font-weight-bold mx-2 mb-lg-0 mb-2"><?= $objProduct->specialityName ?></a> /
                                    <a href="#" class="text-primary font-weight-bold mx-2 mb-lg-0 mb-2"><?= $objProduct->scientificName ?></a>
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                            <!--begin::Actions-->
                            <div class="my-lg-0 my-1">
                                <a href="#" class="btn btn-primary font-weight-bolder text-uppercase">Inquire</a>
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5"><?= $objProduct->subTitle ?></div>
                            <!--end::Description-->
                            <!--begin::Progress-->
                            <div class="d-flex mt-4 mt-sm-0">

                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Top-->
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!--end::Container-->
</div>