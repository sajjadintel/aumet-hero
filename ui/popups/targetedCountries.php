<form method="POST" id="frmTargetedCountries">
    <div class="modal-header">
        <h5 class="modal-title" id="popupModalTitle">Edit Targeted Countries</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
        </button>
    </div>
    <div class="modal-body align-items-stretch">
        <select id="selectTargetedCountries" class="dual-listbox " multiple name="targetCountries" >
            <?php foreach ($arrCountries as $country): ?>
                <?php $isSelected=""; foreach ($arrTargetedCountries as $tCountry){ if($tCountry->countryId == $country->ID) {$isSelected="selected";} }?>
                <option value='<?php echo $country->ID; ?>' <?php echo $isSelected; ?>><?php echo $country->Name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="WebApp.postForm('#frmTargetedCountries', 'profile/countries/targeted', fnCallbackEditTargetedCountries)">Save changes</button>
    </div>
</form>
<script>
    function fnCallbackEditTargetedCountries(webResponse){
        if(webResponse.errorCode == 0){
            $("#modalMDStatic").modal("hide");
            WebApp.loadPartialPage("#potentialCountriesContainer", "potentialdistributors/list");
        }
    }
</script>

