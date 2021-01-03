<div class="modal-body">
    <p class="display3 display4-lg display5-md text-primary">Welcome, <span class="text-dark"><?php echo $objUser->firstName ?></span></p>
    <p class="font-size-h5 font-weight-bold">Fill your basic information to setup your account</p>
    <form class="form mt-10" id="frmOnboardingStep1">
        <div class="form-group">
            <label class="font-size-h5 font-weight-bolder">What is your phone number?</label>
            <input type="tel" class="form-control" placeholder="Enter phone number" value="" name="phoneNumber" id="onboardingPhoneNumber">
        </div>
        <div class="form-group my-5">
            <label class="font-size-h5 font-weight-bolder">Where are you based?</label>
            <select class="form-control select2" id="onboardingCountry" name="country">
                <?php foreach ($arrCountries as $country): ?>
                    <option value='<?php echo $country->ID; ?>'><?php echo $country->Name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>
<div class="modal-footer justify-content-between">
    <a href="/en/auth/signout" class="btn btn-outline-primary btn-lg font-size-h5 font-weight-bold">Logout</a>
    <a href="javascript:;" class="btn btn-primary btn-lg font-size-h5 font-weight-bolder" onclick="OnBoarding.next()">Next</a>
</div>
<script>
    $('#onboardingCountry').select2({
        placeholder: "Select Country",
    });
</script>