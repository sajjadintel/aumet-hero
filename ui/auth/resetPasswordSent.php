<script>
    firebase.analytics().setCurrentScreen('reset_password_sent');

</script>
<div class="d-flex flex-column flex-root">
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
                    <div class="text-center  pt-lg-20">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1 class="text-center font-size-h1 text-primary pl-10 pr-10 pb-15">
                                    We sent you an email
                                </h1>
                                <h5 class="text-center font-size-h5 text-dark pl-10 pr-10 pb-10">
                                    We've sent you an account recovery email. Please continue your account recovery by clicking on the link you will find there. If you don't see it don't forget to check the spam.
                                </h5>

                                <img src="/assets/img/mailSent.svg" class="max-h-150px" alt="" style=""/>
                            </div>
                        </div>
                    </div>
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