'use strict';
// Class definition

var OnBoarding = function() {
    // Private functions

    var _step = 1;

    var _postData = {
        phone: "",
        position: "",
        company: "",
        country: ""
    };

    // initializer
    var _init = function() {

        $('#kt_root').foggy({
            blurRadius: 8,
            opacity: 1,
            cssFilterSupport: true,
        });
        $("#modalOnboarding").modal("show");
        WebApp.loadPartialPage("#modalOnboardingContent", "onboarding/step/"+_step);
    };

    var _next = function (){

        switch (_step) {
            case 1:

                var frmValidate = FormValidation.formValidation(
                    document.getElementById('frmOnboardingStep1'),
                    {
                        fields: {
                            phoneNumber: {
                                validators: {
                                    notEmpty: {
                                        message: 'Phone number is required'
                                    },
                                    stringLength: {
                                        min:6,
                                        max:25,
                                        message: 'Please enter a valid phone number'
                                    },
                                    digits: {
                                        message: 'Please enter a valid phone number'
                                    }
                                }
                            }
                        },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            // Bootstrap Framework Integration
                            bootstrap: new FormValidation.plugins.Bootstrap(),
                        }
                    }
                );

                frmValidate.validate().then(function(status) {
                    // status can be one of the following value
                    // 'NotValidated': The form is not yet validated
                    // 'Valid': The form is valid
                    // 'Invalid': The form is invalid
                    if(status == 'Valid') {
                        _postData.phone  = $("#onboardingPhoneNumber").val();
                        _postData.country  = $("#onboardingCountry").val();

                        _step++;
                        WebApp.loadPartialPage("#modalOnboardingContent", "onboarding/step/"+_step);
                    }

                });


                break;
            case 2:

                var frmValidate = FormValidation.formValidation(
                    document.getElementById('frmOnboardingStep2'),
                    {
                        fields: {
                            company: {
                                validators: {
                                    notEmpty: {
                                        message: 'Company name is required'
                                    },
                                    stringLength: {
                                        min:3,
                                        max:50,
                                        message: 'Please enter a valid company name'
                                    }
                                }
                            },
                            position: {
                                validators: {
                                    notEmpty: {
                                        message: 'Position is required'
                                    },
                                    stringLength: {
                                        min:2,
                                        max:50,
                                        message: 'Please enter a valid company name'
                                    }
                                }
                            }
                        },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            // Bootstrap Framework Integration
                            bootstrap: new FormValidation.plugins.Bootstrap(),
                        }
                    }
                );

                frmValidate.validate().then(function(status) {
                    // status can be one of the following value
                    // 'NotValidated': The form is not yet validated
                    // 'Valid': The form is valid
                    // 'Invalid': The form is invalid
                    if(status == 'Valid') {
                        _postData.company  = $("#onboardingCompany").val();
                        _postData.position  = $("#onboardingPosition").val();
                        WebApp.post("onboarding/save", _postData, OnBoarding.submitCallback );
                    }
                });
                break;
        }
    };

    var _back = function (){
        _step--;
        WebApp.loadPartialPage("#modalOnboardingContent", "onboarding/step/"+_step);
    };

    var _finish = function (){

        WebApp.loadPartialPage("#modalOnboardingContent", "onboarding/step/"+_step);
    };

    return {
        // Public functions
        init: function() {
            _init();
        },
        next: function() {
            _next();
        },
        back: function() {
            _back();
        },
        submitCallback: function(webResponse) {
            window.location.href = webResponse.data;
        },
        stepLoadCallback: function (webResponse){
            $('.select2').select2({placeholder:'Select a state'});
        }
    };
}();