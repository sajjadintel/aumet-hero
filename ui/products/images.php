<?php foreach ($arrProductImage as $image): ?>
    <div class="image-input image-input-outline mr-5 mb-8 productImage" id="productImage_<?=$image->id?>" style="background-image: url(/assets/img/photo.png)">
        <div class="image-input-wrapper" style="background-image: url('<?=$image->image_url?>')"></div>
        <label class="btn btn-xs btn-icon btn-circle btn-transparent-white " data-action="change" data-toggle="tooltip" title="" data-original-title="Change">

            <input type="file" name="productImage[<?=$image->id?>][]" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="productImageRemove[<?=$image->id?>]" value="0">
        </label>
        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
<?php endforeach; ?>

<script>
    $(".productImage").each(function () {
        var productImage = new KTImageInput($(this).attr('id'));
        productImage.on('remove', function(imageInput) {
            $(imageInput.element).fadeOut();
        });
    });
</script>
