<div class="row">
    <?php foreach ($arrProducts as $objItem): ?>
    <div class="col-2">
        <div class="card card-custom gutter-b card-stretch">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-column h-100">
                    <div class="h-100">
                        <div class="d-flex flex-column flex-center">
                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-180px w-100" style="background-image: url('<?php echo $objItem->productImage; ?>')"></div>
                            <a href="javascript:;" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-2" onclick="WebApp.loadPage('browse/product/<?php echo $objItem->id; ?>')"><?php echo $objItem->productTitle; ?></a>
                            <div class="font-weight-bold text-dark-75 font-size-base pb-3"><?php echo $objItem->scientificName; ?> by
                                <a href="#" class="font-weight-bold text-primary"><?php echo $objItem->manufacturerName; ?></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
