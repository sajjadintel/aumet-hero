<form class="form-inline mt-10" id="frmFilters">
    <!--inquiryStatus-->
    <div class="form-group col-md-3">
        <div class="input-icon">
            <input type="text" class="form-control" placeholder="Distributor name" id="kt_datatable_search_query">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    </div>
    <!--inquirySenderName-->
    <div class="form-group col-md-3">
        <select class="form-control select2 col-md-8" id="countriesDistributor" name="country">
            <?php foreach ($arrCountries as $country): ?>
                <option value='<?php echo $country['ID']; ?>'><?php echo $country['Name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!--inquiryReceiverName-->
    <div class="form-group col-md-3">
<!--        <select class="form-control select2 col-md-8" id="inquiryFromUser" name="country">-->
<!--            --><?php //foreach ($arrFromUser as $user): ?>
<!--                <option value='--><?php //echo $user->messageUserId; ?><!--'>--><?php //echo $user->displayName; ?><!--</option>-->
<!--            --><?php //endforeach; ?>
<!--        </select>-->
    </div>
</form>
<script>
    $(document).ready(function (){
        $('#inquiryStatus').select2({
            placeholder: "Select Status",
        });
        $('#countriesDistributor').select2({
            placeholder: "Country",
        });
        $('#inquiryFromUser').select2({
            placeholder: "Select Sender Name",
        });
    });
</script>