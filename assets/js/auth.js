"use strict";

(function ($) {
	$.fn.serializeFormJSON = function () {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function () {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};
})(jQuery);

// Class Definition
var WebAuth = function () {

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

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

	var _handleGoogleSignin = function () {
		var formSubmitButton = KTUtil.getById('kt_login_singin_google_submit_button');

		// Show loading state on button
		KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");

		var provider = new firebase.auth.GoogleAuthProvider();

		firebase.auth().setPersistence(firebase.auth.Auth.Persistence.LOCAL)
			.then(function() {
				return firebase.auth().signInWithPopup(provider).
				catch(function (error) {
					// Handle Errors here.
					var errorCode = error.code;
					var errorMessage = error.message;
					// The email of the user's account used.
					var email = error.email;
					// The firebase.auth.AuthCredential type that was used.
					var credential = error.credential;
					// ...

					// Handle Errors here.
					KTUtil.btnRelease(formSubmitButton);
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
				});;
			})
			.catch(function(error) {
				KTUtil.btnRelease(formSubmitButton);
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
			});


	}

	var _handlePhoneSignin = function () {
		var formSubmitButton = KTUtil.getById('kt_login_singin_phone_submit_button');

		// Show loading state on button
		KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");

		//var provider = new firebase.auth.Phon;

		firebase.auth().setPersistence(firebase.auth.Auth.Persistence.LOCAL)
			.then(function() {
				return firebase.auth().signInWithPopup(provider).
				catch(function (error) {
					// Handle Errors here.
					var errorCode = error.code;
					var errorMessage = error.message;
					// The email of the user's account used.
					var email = error.email;
					// The firebase.auth.AuthCredential type that was used.
					var credential = error.credential;
					// ...

					// Handle Errors here.
					KTUtil.btnRelease(formSubmitButton);
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
				});;
			})
			.catch(function(error) {
				KTUtil.btnRelease(formSubmitButton);
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
			});


	}

	var _handleFormForgot = function () {
		var form = KTUtil.getById('kt_login_forgot_form');
		var formSubmitButton = KTUtil.getById('kt_login_forgot_form_submit_button');

		if (!form) {
			return;
		}

		var _url = "/" + docLang + "/auth/forgot?_t=" + Date.now();

		$.ajax({
			url: _url,
			type: "POST",
			dataType: "json",
			data: {
				email: form.querySelector('[name="email"]').value,
			},
			async: true
		}).done(function (webResponse) {

			if (webResponse && typeof webResponse === 'object') {
				if (webResponse.errorCode == 0) {
					firebase.analytics().logEvent('signup_ok');
					window.location.href = "/" + docLang + "/auth/forgot/otp";
				} else {
					_unblockPage();
					dataLayer.push({
						'event': 'error',
						'error_type': 'forget',
						'error_message': webResponse.message
					});
					Swal.fire({
						text: webResponse.message,
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: WebAppLocals.getMessage("error_confirmButtonText"),
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			}
			else {
				_unblockPage();
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
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			_unblockPage();
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
	}

	var _handleFormSignup = function () {
		if($('input[type="checkbox"]').prop("checked") == false){
			$('.checkbox > span').addClass('terms-condition-checkbox');
			return;
		}
		// Base elements
		var form = KTUtil.getById('frmSignup');
		var formSubmitButton = KTUtil.getById('btnSignup');
		var validations = [];

		if (!form) {
			return;
		}

		var urlSignUp = "/" + docLang + "/auth/signup?_t=" + Date.now();

		//KTUtil.btnWait(formSubmitButton);

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
							invitationCode: form.querySelector('[name="invitationCode"]').value,
							email: form.querySelector('[name="email"]').value,
							password: form.querySelector('[name="password"]').value,
							firstName: form.querySelector('[name="firstName"]').value,
							lastName: form.querySelector('[name="lastName"]').value,
							companyType: form.querySelector('[name="companyType"]:checked').value,
						},
						async: true
					}).done(function (webResponse) {

						if (webResponse && typeof webResponse === 'object') {
							if (webResponse.errorCode == 0) {
								firebase.analytics().logEvent('signup_ok');

								dataLayer.push({
									'event': 'sign_up_form_submission',
									'method': 'email',
									'user_type': form.querySelector('[name="companyType"]:checked').value
								});

								dataLayer.push({
									'event': 'sign_up_email_validation',
									'method': 'email',
									'user_type': form.querySelector('[name="companyType"]:checked').value
								});

								window.location.href = "/" + docLang + "/auth/signup/otp";
							} else {
								_unblockPage();
								dataLayer.push({
									'event': 'error',
									'error_type': 'registration',
									'error_message': webResponse.message
								});
								Swal.fire({
									text: webResponse.message,
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: WebAppLocals.getMessage("error_confirmButtonText"),
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function () {
									KTUtil.scrollTop();
								});
							}
						}
						else {
							_unblockPage();
							dataLayer.push({
								'event': 'error',
								'error_type': 'registration',
								'error_message': WebAppLocals.getMessage("error")
							});
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
						}
					}).fail(function (jqXHR, textStatus, errorThrown) {
						_unblockPage();
						dataLayer.push({
							'event': 'error',
							'error_type': 'registration',
							'error_message': WebAppLocals.getMessage("error")
						});
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
					dataLayer.push({
						'event': 'error',
						'error_type': 'registration',
						'error_message': error.message
					});
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
				});
			})
			.catch((error) => {
				// Handle Errors here.
				_unblockPage();
				dataLayer.push({
					'event': 'error',
					'error_type': 'registration',
					'error_message': error.message
				});
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
			});
	}

	var _handleFormSignupDistributor = function () {
		// Base elements
		var form = KTUtil.getById('frmSignup');
		var formSubmitButton = KTUtil.getById('btnSignup');
		var validations = [];

		if (!form) {
			return;
		}

		var urlSignUp = "/" + docLang + "/auth/signup?_t=" + Date.now();

		//KTUtil.btnWait(formSubmitButton);

		_blockPage();

		firebase.auth().createUserWithEmailAndPassword(
			form.querySelector('[name="email"]').value,
			form.querySelector('[name="password"]').value)
			.then((user) => {
				firebase.auth().currentUser.getIdToken(true).then(function (idToken) {
					var urlSignUp = "/" + docLang + "/auth/signup/distributor?_t=" + Date.now();

					$.ajax({
						url: urlSignUp,
						type: "POST",
						dataType: "json",
						data: {
							token: idToken,
							invitationCode: form.querySelector('[name="invitationCode"]').value,
							email: form.querySelector('[name="email"]').value,
							password: form.querySelector('[name="password"]').value,
							firstName: form.querySelector('[name="name"]').value,
							phoneNumber: form.querySelector('[name="mobile"]').value,
							lastName: "",
							companyType: "distributor",
						},
						async: true
					}).done(function (webResponse) {

						if (webResponse && typeof webResponse === 'object') {
							if (webResponse.errorCode == 0) {
								firebase.analytics().logEvent('signup_ok');

								dataLayer.push({
									'event': 'sign_up_form_submission',
									'method': 'email',
									'user_type': 'distributor'
								});

								dataLayer.push({
									'event': 'sign_up_email_validation',
									'method': 'email',
									'user_type': "distributor"
								});

								window.location.href = "/" + docLang + "/auth/distributor/onboarding";
							} else {
								_unblockPage();
								dataLayer.push({
									'event': 'error',
									'error_type': 'registration',
									'error_message': webResponse.message
								});
								jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
									"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
									"    <span aria-hidden=\"true\">&times;</span>\n" +
									"  </button>\n" +
									"  <strong>"+webResponse.message+"</strong> \n" +
									"</div>");
								KTUtil.scrollTop();
							}
						}
						else {
							_unblockPage();
							dataLayer.push({
								'event': 'error',
								'error_type': 'registration',
								'error_message': WebAppLocals.getMessage("error")
							});
							jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
								"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
								"    <span aria-hidden=\"true\">&times;</span>\n" +
								"  </button>\n" +
								"  <strong>"+WebAppLocals.getMessage("error")+"</strong> \n" +
								"</div>");
							KTUtil.scrollTop();
						}
					}).fail(function (jqXHR, textStatus, errorThrown) {
						_unblockPage();
						dataLayer.push({
							'event': 'error',
							'error_type': 'registration',
							'error_message': WebAppLocals.getMessage("error")
						});
						jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
							"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
							"    <span aria-hidden=\"true\">&times;</span>\n" +
							"  </button>\n" +
							"  <strong>"+ WebAppLocals.getMessage("error")+"</strong> \n" +
							"</div>");
						KTUtil.scrollTop();
					});

				}).catch(function (error) {
					_unblockPage();
					dataLayer.push({
						'event': 'error',
						'error_type': 'registration',
						'error_message': error.message
					});

					jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
						"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
						"    <span aria-hidden=\"true\">&times;</span>\n" +
						"  </button>\n" +
						"  <strong>"+error.message+"</strong> \n" +
						"</div>");
					KTUtil.scrollTop();
				});
			})
			.catch((error) => {
				// Handle Errors here.
				_unblockPage();
				dataLayer.push({
					'event': 'error',
					'error_type': 'registration',
					'error_message': error.message
				});
				jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
					"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
					"    <span aria-hidden=\"true\">&times;</span>\n" +
					"  </button>\n" +
					"  <strong>"+error.message+"</strong> \n" +
					"</div>");
				KTUtil.scrollTop();
			});
	}

	var _handleFormSignupDistributorOnbard = function () {
		// Base elements
		var form = KTUtil.getById('frmOnboardingDistributor');
		var validations = [];

		if (!form) {
			return;
		}

		var urlSignUp = "/" + docLang + "/onboardingDistributerOutbound/save?_t=" + Date.now();


		_blockPage();

		$.ajax({
			url: urlSignUp,
			type: "POST",
			dataType: "json",
			data: {
				company: form.querySelector('[name="company"]').value,
				position: form.querySelector('[name="jobtitle"]').value,
				specialities: jQuery('#onboardingSpecialities').val(),
				medicalLine: jQuery('#onboardingMedicalLine').val(),
				country: form.querySelector('[name="countryId"]').value,
				companyType: "distributor",
			},
			async: true
		}).done(function (webResponse) {

			if (webResponse && typeof webResponse === 'object') {
				if (webResponse.errorCode == 0) {
					dataLayer.push({
						'event': 'onboarding_success'
					});
					window.location.href = "/" + docLang + "/v2/explore";
				} else {
					_unblockPage();
					dataLayer.push({
						'event': 'error',
						'error_type': 'onboarding_error',
						'error_message': webResponse.message
					});
					jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
						"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
						"    <span aria-hidden=\"true\">&times;</span>\n" +
						"  </button>\n" +
						"  <strong>"+webResponse.message+"</strong> \n" +
						"</div>");
					KTUtil.scrollTop();
				}
			}
			else {
				_unblockPage();
				dataLayer.push({
					'event': 'error',
					'error_type': 'onboarding_error',
					'error_message': WebAppLocals.getMessage("error")
				});
				jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
					"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
					"    <span aria-hidden=\"true\">&times;</span>\n" +
					"  </button>\n" +
					"  <strong>"+WebAppLocals.getMessage("error")+"</strong> \n" +
					"</div>");
				KTUtil.scrollTop();
			}
		}).fail(function (jqXHR, textStatus, errorThrown) {
			_unblockPage();
			dataLayer.push({
				'event': 'error',
				'error_type': 'onboarding_error',
				'error_message': WebAppLocals.getMessage("error")
			});
			jQuery(".msg-box-init").html("<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">\n" +
				"  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">\n" +
				"    <span aria-hidden=\"true\">&times;</span>\n" +
				"  </button>\n" +
				"  <strong>"+ WebAppLocals.getMessage("error")+"</strong> \n" +
				"</div>");
			KTUtil.scrollTop();
		});


	}

	var _fnCallbackSignUp = function (webResponse) {

	}

	var _setupFirebase = function () {
		firebase.auth().languageCode = docLang;

		return;

		firebase.auth().onAuthStateChanged(function (user) {
			if (user) {
				let userInfo = {
					displayName: user.displayName,
					email: user.email,
					emailVerified: user.emailVerified,
					photoURL: user.photoURL,
					isAnonymous: user.isAnonymous,
					uid: user.uid,
					providerData: user.providerData
				}

				firebase.auth().currentUser.getIdToken(true).then(function (idToken) {

					userInfo.idToken = idToken;

					var urlSignIn = "/" + docLang + "/auth/signin?_t=" + Date.now();

					$.ajax({
						url: urlSignIn,
						type: "POST",
						dataType: "json",
						data: {
							token: idToken,
							userInfo: userInfo
						},
						async: true
					}).done(function (webResponse) {

						if (webResponse && typeof webResponse === 'object') {
							if (webResponse.errorCode == 0) {
								firebase.analytics().logEvent('auth_ok');
								window.location.href = "/" + docLang;
							} else {
								Swal.fire({
									text: webResponse.message,
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: WebAppLocals.getMessage("error_confirmButtonText"),
									customClass: {
										confirmButton: "btn font-weight-bold btn-light-primary"
									}
								}).then(function () {
									KTUtil.scrollTop();
								});

							}
						}
						else {
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
						}
					}).fail(function (jqXHR, textStatus, errorThrown) {
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
				});


				// ...
			} else {
				// User is signed out.
				// ...
			}
		});

	}

	// Public Functions
	return {
		init: function () {
			_setupFirebase();

			//_handleFormForgot();
			//_handleFormSignup();
		},
		signIn: function () {
			_handleFormSignin();
		},
		googleSignIn: function () {
			_handleGoogleSignin();
		},
		signUp: function () {
			console.log('signUp');
			_handleFormSignup();
		},
		signUpDistributor: function () {
			_handleFormSignupDistributor();
		},
		signUpDistributorOnboard: function () {
			_handleFormSignupDistributorOnbard();
		},
		recover: function (){
			_handleFormForgot();
		}
	};
}();

// Class Initialization
jQuery(document).ready(function () {
	WebAuth.init();
	$('input[type="checkbox"]').click(function(){
		if($(this).prop("checked") == true){
			$('.checkbox > span').removeClass('terms-condition-checkbox');
		}
		else if($(this).prop("checked") == false){
			$('.checkbox > span').removeClass('terms-condition-checkbox');
		}
	});
	$('input[type="text"]').change(function(){
		this.value = $.trim(this.value);
	});
});