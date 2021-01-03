<?php if ($arrProducts) : ?>

<?php foreach ($arrProducts as $objProduct) : ?>

    <div class="d-flex align-items-center mb-8">

        <div class="symbol symbol-150 mr-5 pt-1">
            <div class="symbol-label min-w-100px min-h-100px" style="background-image: url('<?php echo $objProduct->image; ?>')"></div>
        </div>


        <div class="d-flex flex-column">

            <a href="#" class="text-primary font-weight-boldest text-hover-primary font-size-h3 mb-4"><?php echo $objProduct->title; ?></a>

            <span class="text-dark-75 font-weight-bold font-size-md pb-4 show-read-more"><?php echo html_entity_decode($objProduct->subTitle); ?></span>

            <span class="font-weight-bolder font-size-h5">
                <?php echo $objProduct->slug; ?>
            </span>

        </div>

    </div>

    <div class="separator separator-solid mb-5"></div>

<?php endforeach; ?>

<?php endif; ?>