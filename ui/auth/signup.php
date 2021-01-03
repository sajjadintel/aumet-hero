<script>
    firebase.analytics().setCurrentScreen('signup');
</script>
<div class="d-flex flex-column flex-root" id="signupContainer">
    <!--begin::Login-->
    <div class="login login-3 wizard d-flex flex-column flex-lg-row flex-column-fluid">

        <!--begin::Content-->
        <div class="login-content flex-row-fluid d-flex flex-column p-10">

            <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-5 show-mobile">
                <!--begin::Aside header-->
                <a href="/" class="login-logo text-center pt-lg-25 pb-10">
                    <img src="/assets/img/aumet-logo.svg" class="max-h-70px" alt=""/>
                </a>
                <!--end::Aside header-->
                <!--begin::Aside Title-->
                <h5 class="font-weight-bolder text-center font-size-h6 text-dark line-height-xl">
                    <?php echo $vLogin_slogan ?></h5>
                <!--end::Aside Title-->
            </div>
            <!--begin::Wrapper-->
            <div class="d-flex flex-row-fluid flex-center">
                <!--begin::Signin-->
                <div class="login-form" id="authContainer">
                    <!--begin::Form-->
                    <form class="form" id="frmSignup" action="/<?php echo $LANGUAGE ?>/auth/signup">
                        <input type="hidden" name="invitationCode" value="<?php echo $objInvitation ? $objInvitation->code : "" ?>"/>
                        <!--begin::Title-->
                        <div class="pb-5 pb-lg-15">
                            <h1 class="font-weight-bolder text-dark display-4 pb-3"><?php echo $vLogin_signup ?></h1>
                            <div class="text-dark font-weight-bold font-size-h3 mt-5"><?php echo $vLogin_alreadyAccountAdv ?>
                                <a href="/<?php echo $LANGUAGE ?>/auth/signin"
                                   class="text-primary font-weight-bolder"><?php echo $vLogin_signinAdv ?></a></div>
                        </div>
                        <div class="form-group">
                            <label class="font-size-h2 font-weight-bolder text-dark">I'm a</label>
                            <div class="radio-inline">
                                <label class="radio radio-square radio-lg font-size-h4 font-weight-bolder text-dark mr-5">
                                    <input type="radio" checked="checked" name="companyType" value="manufacturer">
                                    <span class=""></span>Manufacturer</label>
                                <label class="radio radio-square radio-lg font-size-h4 font-weight-bolder text-dark mr-5">
                                    <input type="radio" name="companyType" value="distributor" <?php echo $objInvitation ? 'checked="checked"' : "" ?> >
                                    <span></span>Distributor</label>
                                <label class="radio radio-square radio-lg font-size-h4 font-weight-bolder text-dark">
                                    <input type="radio" name="companyType" value="pharmacy">
                                    <span></span>Pharmacy</label>
                            </div>
                        </div>

                        <!--begin::Form group-->
                        <div class="form-group row">
                            <div class="col-6">
                                <label class="font-size-h6 font-weight-bolder text-dark"><?php echo $vLogin_firstName ?></label>
                                <input class="form-control h-auto py-3 px-6 border-1" type="text" name="firstName" value="<?php echo $objInvitation ? $objInvitation->name : "" ?>"/>
                            </div>
                            <div class="col-6">
                                <label class="font-size-h6 font-weight-bolder text-dark"><?php echo $vLogin_lastName ?></label>
                                <input class="form-control h-auto py-3 px-6 border-1" type="text" name="lastName"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark"><?php echo $vLogin_email ?></label>
                            <input class="form-control h-auto py-3 px-6 border-1" type="text" name="email" value="<?php echo $objInvitation ? $objInvitation->email : "" ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="font-size-h6 font-weight-bolder text-dark"><?php echo $vSignup_password ?></label>
                            <input class="form-control h-auto py-3 px-6 border-1" type="password" name="password"/>
                        </div>
                        <!--end::Form group-->
                        <!--begin::Action-->
                        <div class="pb-lg-0 pb-5">
                            <button type="button" id="btnSignup" onclick="WebAuth.signUp()"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3"><?php echo $vLogin_signup ?></button>
                        </div>
                        <!--end::Action-->

                        <div class="text-left d-flex justify-content-start">
                            <a href="/" class=" text-left pt-lg-35">
                                <img src="/assets/img/aumet-logo.svg" class="max-h-30px" alt="" style="max-width: 170px;"/>
                                <h3 class="text-left font-size-h4 text-dark pl-10 pr-10 pt-5">
                                    A product of Aumet<i class="icon-md text-dark la la-copyright pb-2"></i></h3>
                            </a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Top-->

            <!--end::Top-->
        </div>
        <!--end::Content-->
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-column flex-row-auto hide-mobile">
            <!--begin::Aside Top-->
            <div class="d-flex flex-column-auto flex-column pt-lg-20 pt-10">
                <h1 class="font-weight-bolder text-center font-size-h1 text-primary line-height-0 pt-lg-15 pb-15" style="font-size: 3.5rem !important;">
                    Aumet <span class="font-weight-bolder text-dark">OnEx</span></h1>
                <h3 class="font-weight-bolder text-center font-size-h2 text-dark-75 line-height-0">
                    <?php echo $vLogin_slogan ?></h3>
                <!--begin::Aside header-->


                <!--end::Aside header-->
                <!--begin::Aside Title-->

                <!--end::Aside Title-->
            </div>
            <!--end::Aside Top-->
            <!--begin::Aside Bottom-->
            <div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-x-center"
                 style="background-position-y: calc(100% + 1rem); background-image: url('/assets/img/undraw_setup_analytics_8qkl.svg'); background-size: contain;">

            </div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
    </div>
    <!--end::Login-->
</div>