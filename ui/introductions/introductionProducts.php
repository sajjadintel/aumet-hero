<?php $counter = 0; ?>
<?php foreach ($arrManufacturerProducts as $objProduct): ?>
    <div class="d-flex align-items-center mb-8">
        <input type="hidden" name="productId[]" value="<?php echo $objProduct->id; ?>">
        <div class="symbol symbol-150 mr-10 pt-1">
            <div class="symbol-label min-w-100px min-h-100px" style="background-image: url('<?php echo $objProduct->image; ?>')"></div>
        </div>
        <div class="d-flex flex-column">
            <a href="javascript:;" onclick="fnOpenProductInlineProfile(<?php echo $objProduct->id ?>)" class="text-primary font-weight-boldest text-hover-primary font-size-h3 mb-4"><?php echo $objProduct->title; ?></a>
            <span class="text-dark-75 font-weight-bold font-size-md pb-4 show-read-more"><?php echo html_entity_decode($objProduct->subTitle); ?></span>
            <div class="mt-5">
                <a href="javascript:;" onclick="fnOpenProductInlineProfile(<?php echo $objProduct->id ?>)" class="btn btn-primary">View Product</a>
            </div>
        </div>
    </div>
    <div class="separator separator-solid mb-5"></div>
    <?php
    $counter++;
    if($counter > 3) {
        break;
    }
    ?>
<?php endforeach; ?>