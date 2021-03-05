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
	var _handleFormSignin = function () {
		var form = KTUtil.getById('kt_login_singin_form');
		var formSubmitUrl = KTUtil.attr(form, 'action');
		var formSubmitButton = KTUtil.getById('kt_login_singin_form_submit_button');
		if (!form) {
			return;
		}
		_blockPage();
		firebase.auth().signInWithEmailAndPassword(
			form.querySelector('[name="email"]').value,
			form.querySelector('[name="password"]').value)
			.then((user) => {
				firebase.auth().currentUser.getIdToken(true).then(function (idToken) {
					var urlSignIn = "/" + docLang + "/auth/signin?_t=" + Date.now();
					$.ajax({
						url: urlSignIn,
						type: "POST",
						dataType: "json",
						data: {
							token: idToken
						},
						async: true
					}).done(function (webResponse) {
						if (webResponse && typeof webResponse === 'object') {
							if (webResponse.errorCode == 0) {
								window.location.href = "/" + docLang + '/dashboard';
							}
							else {
								_unblockPage();
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
				}).catch(function (error) {
					_unblockPage();
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
				//KTUtil.btnRelease(formSubmitButton);
				_unblockPage();
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
					window.location.href = "/" + docLang + "/auth/forgot/otp";
				} else {
					_unblockPage();
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
	var _setupFirebase = function () {
		firebase.auth().languageCode = docLang;
	}
	// Public Functions
	return {
		init: function () {
			_setupFirebase();
		},
		signIn: function () {
			_handleFormSignin();
		},
		recover: function (){
			_handleFormForgot();
		}
	};
}();
// Class Initialization
jQuery(document).ready(function () {
	WebAuth.init();
});