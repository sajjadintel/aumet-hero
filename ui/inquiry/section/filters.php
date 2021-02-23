<form class="form-inline mt-10" id="frmFilters">
    <!--inquiryStatus-->
    <div class="form-group col-md-3">
        <select class="form-control select2 col-md-8 " id="inquiryStatus" name="status">
            <option value='0'>Pending</option>
            <option value='1'>Sent</option>
            <option value='2'>Replied</option>
            <option value='3'>Locked</option>
            <option value='4'>Disapproved</option>
        </select>
    </div>
    <!--inquirySenderName-->
    <div class="form-group col-md-3">
        <select class="form-control select2 col-md-8" id="inquiryToUser" name="country">
            <?php foreach ($arrToUser as $user): ?>
                <option value='<?php echo $user->messageUserId; ?>'><?php echo $user->displayName; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!--inquiryReceiverName-->
    <div class="form-group col-md-3">
        <select class="form-control select2 col-md-8" id="inquiryFromUser" name="country">
            <?php foreach ($arrFromUser as $user): ?>
                <option value='<?php echo $user->messageUserId; ?>'><?php echo $user->displayName; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>
<script>
    $(document).ready(function (){
        $('#inquiryStatus').select2({
            placeholder: "Select Status",
        });
        $('#inquiryToUser').select2({
            placeholder: "Select Receiver Name",
        });
        $('#inquiryFromUser').select2({
            placeholder: "Select Sender Name",
        });
    });
</script>