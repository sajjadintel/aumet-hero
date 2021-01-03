<div class="modal-body">
    <p class="display3 display4-lg display5-md text-primary">Welcome, <span class="text-dark"><?php echo $objUser->firstName ?></span></p>
    <p class="font-size-h5 font-weight-bold">Fill your company basic information to setup your account</p>
    <form class="form mt-10" id="frmOnboardingStep2">
        <div class="form-group">
            <label class="font-size-h5 font-weight-bolder">What's your company name?</label>
            <input type="text" class="form-control" placeholder="Enter company name" id="onboardingCompany" name="company">
        </div>
        <div class="form-group my-5">
            <label class="font-size-h5 font-weight-bolder">What is your position at your company?</label>
            <input type="text" class="form-control" placeholder="Enter position" name="position"  id="onboardingPosition">
        </div>
    </form>
</div>
<div class="modal-footer justify-content-between">
    <a type="button" class="btn btn-outline-primary btn-lg font-size-h5 font-weight-bold" onclick="OnBoarding.back()">Back</a>
    <a type="button" class="btn btn-primary btn-lg font-size-h5 font-weight-bold" onclick="OnBoarding.next()">Finish</a>
</div>