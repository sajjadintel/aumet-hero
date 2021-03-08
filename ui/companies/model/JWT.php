<?php if($jwt) {?>
    <div class="modal-header">
        <h5 class="modal-title" id="inquirySubject">Get Token</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="border-bottom"> <?php echo $jwt; ?> </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
<?php } ?>
