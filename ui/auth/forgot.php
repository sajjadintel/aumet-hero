<script>
    firebase.analytics().setCurrentScreen('forgotpassword');
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
                <div class="login-form">
                    <!--begin::Form-->
                    <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_login_forgot_form" method="post" action="/en/auth/forgot" novalidate="novalidate">
                        <!--begin::Title-->
                        <div class="pb-5 pb-lg-15">
                            <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forgotten Password ?</h3>
                            <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
                        </div>
                        <!--end::Title-->
                        <!--begin::Form group-->
                        <div class="form-group fv-plugins-icon-container">
                            <input class="form-control h-auto py-7 px-6 border-0 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off">
                            <div class="fv-plugins-message-container"></div></div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group d-flex flex-wrap">
                            <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Submit</button>
                            <a href="/en/auth/signin" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Cancel</a>
                        </div>
                        <!--end::Form group-->
                        <input type="hidden"><div></div></form>
                    <!--end::Form-->
                </div>
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
                 style="background-position-y: calc(100% + 1rem); background-image: url('/assets/img/resetPassword.svg'); background-size: contain;">

            </div>
            <!--end::Aside Bottom-->
        </div>
        <!--begin::Aside-->
    </div>
    <!--end::Login-->
</div>