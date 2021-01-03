<?php foreach ($arrCompanyPhotos as $image): ?>
    <div class="image-input image-input-outline mr-5 mb-8 companyImage" id="productImage_<?=$image->Id?>" data-photoid="<?=$image->Id?>" style="background-image: url(/assets/img/photo.png)">
        <div class="image-input-wrapper" style="background-image: url('<?=$image->Link?>')"></div>
        <label class="btn btn-xs btn-icon btn-circle btn-transparent-white " data-action="change" data-toggle="tooltip" title="" data-original-title="Change">

            <input type="file" name="companyImage[<?=$image->Id?>][]" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="companyImageRemove[<?=$image->Id?>]" value="0">
        </label>
        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="" data-original-title="Remove">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
<?php endforeach; ?>

<script>
    $(".companyImage").each(function () {
        var companyImage = new KTImageInput($(this).attr('id'));
        companyImage.on('remove', function(imageInput) {

            var photoId = $(imageInput.element).data('photoid');

            WebApp.post('mycompanyprofile/edit/pictures/'+photoId+'/remove', null, function (webResponse) {
                $(imageInput.element).fadeOut();
            });


        });
    });
</script>
