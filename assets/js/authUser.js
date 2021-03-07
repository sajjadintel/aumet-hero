"use strict";
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
var form = KTUtil.getById('kt_create_user_form');
$(form.querySelector('[name="firstName"]')).keyup(function(){
    $(form.querySelector('[name="firstName"]')).removeClass('is-invalid');
    $(form.querySelector('[name="firstName"]')).addClass('is-valid');
});
$(form.querySelector('[name="lastName"]')).keyup(function(){
    $(form.querySelector('[name="lastName"]')).removeClass('is-invalid');
    $(form.querySelector('[name="lastName"]')).addClass('is-valid');
});
$(form.querySelector('[name="email"]')).keyup(function(){
    // if(isEmail(form.querySelector('[name="email"]').value)) {
    //     console.log(form.querySelector('[name="email"]').value);
        $('#email-msg').css('display','none');
        $(form.querySelector('[name="email"]')).removeClass('is-invalid');
        $(form.querySelector('[name="email"]')).addClass('is-valid');
    // }else{
    //     $(form.querySelector('[name="email"]')).addClass('is-invalid');
    // }
});
$(form.querySelector('[name="firstName"]')).keyup(function(){
    $(form.querySelector('[name="firstName"]')).removeClass('is-invalid');
    $(form.querySelector('[name="firstName"]')).addClass('is-valid');
});
$(form.querySelector('[name="password"]')).keyup(function(){
    $('#password-msg').css('display','none');
    $(form.querySelector('[name="password"]')).removeClass('is-invalid');
    $(form.querySelector('[name="password"]')).addClass('is-valid');
});
function createUser() {
    if (firebase.apps.length === 0) {
        firebase.initializeApp(firebaseConfig);
    }
    // $('#closeAvailabilitiesPopUp').trigger('click');

    // Base elements
    let form = KTUtil.getById('kt_create_user_form');
    let validated = false;
    if(form.querySelector('[name="firstName"]').value==''){
        $(form.querySelector('[name="firstName"]')).addClass('is-invalid');
    }else{
        $(form.querySelector('[name="firstName"]')).removeClass('is-invalid');
        $(form.querySelector('[name="firstName"]')).addClass('is-valid');
    }
    if(form.querySelector('[name="lastName"]').value==''){
        $(form.querySelector('[name="lastName"]')).addClass('is-invalid');
    }else{
        $(form.querySelector('[name="lastName"]')).removeClass('is-invalid');
        $(form.querySelector('[name="lastName"]')).addClass('is-valid');
    }
    if(form.querySelector('[name="email"]').value==''){
        $(form.querySelector('[name="email"]')).addClass('is-invalid');
    }else{
        $('#email-msg').css('display','none');
        $(form.querySelector('[name="email"]')).removeClass('is-invalid');
        $(form.querySelector('[name="email"]')).addClass('is-valid');
    }
    if(form.querySelector('[name="password"]').value==''){
        $(form.querySelector('[name="password"]')).addClass('is-invalid');
    }else{
        $('#password-msg').css('display','none');
        $(form.querySelector('[name="password"]')).removeClass('is-invalid');
        $(form.querySelector('[name="password"]')).addClass('is-valid');
    }
    if(form.querySelector('[name="firstName"]').value=='' || form.querySelector('[name="lastName"]').value=='' || form.querySelector('[name="email"]').value==''
    || form.querySelector('[name="password"]').value==''){
        return false;
    }
    var formSubmitButton = KTUtil.getById('btnSignup');
    var validations = [];

    if (!form) {
        return;
    }

    var urlSignUp = "/" + docLang + "/auth/signup?_t=" + Date.now();

    _blockPage();


    firebase.auth().createUserWithEmailAndPassword(
        form.querySelector('[name="email"]').value,
        form.querySelector('[name="password"]').value)
        .then((user) => {
            firebase.auth().currentUser.getIdToken(true).then(function (idToken) {
                var urlSignUp = "/" + docLang + "/auth/signup?_t=" + Date.now();

                $.ajax({
                    url: urlSignUp,
                    type: "POST",
                    dataType: "json",
                    data: {
                        token: idToken,
                        email: form.querySelector('[name="email"]').value,
                        password: form.querySelector('[name="password"]').value,
                        firstName: form.querySelector('[name="firstName"]').value,
                        lastName: form.querySelector('[name="lastName"]').value,
                        companyId: form.querySelector('[name="companyId"]').value,
                        companyType: form.querySelector('[name="companyType"]').value,
                        returnSecureToken: true,
                    },
                    async: true
                }).done(function (webResponse) {
                    _unblockPage();
                    $('#closeAvailabilitiesPopUp').trigger('click');
                    if (webResponse && typeof webResponse === 'object') {
                        if (webResponse.errorCode == 0) {
                            WebApp.alertSuccess(webResponse.message);
                        } else {
                            WebApp.alertError(webResponse.message);
                        }
                    }
                    else {
                        _unblockPage();
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    _unblockPage();
                    $('#closeAvailabilitiesPopUp').trigger('click');
                    Swal.fire({
                        text: WebAppLocals.getMessage("error"),
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: WebAppLocals.getMessage("error_confirmButtonText"),
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                });

            }).catch(function (error) {
                _unblockPage();
                $('#closeAvailabilitiesPopUp').trigger('click');
                Swal.fire({
                    text: error.message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: WebAppLocals.getMessage("error_confirmButtonText"),
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function () {
                    KTUtil.scrollTop();
                });
                // console.log(error);
            });
        })
        .catch((error) => {
            // Handle Errors here.
            _unblockPage();
            if(error.code=='auth/weak-password'){
                $(form.querySelector('[name="password"]')).removeClass('is-valid');
                $(form.querySelector('[name="password"]')).addClass('is-invalid');
                $('#password-msg').css('display','block');
                $('#password-msg').html(error.message);
            }
            if(error.code=='auth/email-already-in-use'){
                $(form.querySelector('[name="email"]')).removeClass('is-valid');
                $(form.querySelector('[name="email"]')).addClass('is-invalid');
                $('#email-msg').css('display','block');
                $('#email-msg').html(error.message);
            }
            console.log(error);
        });
}
var _blockPage = function (_msgKey = "loading") {
    KTApp.blockPage({
        overlayColor: 'black',
        opacity: 0.2,
        message: WebAppLocals.getMessage(_msgKey),
        state: 'primary', // a bootstrap color
    });
};
var _unblockPage = function () {
    KTApp.unblockPage();
};