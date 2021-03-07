'use strict';

// JQuery Functions
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

var datatableVar;

// Class Definition
var WebApp = (function () {
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	var _pageContainerId = '#kt_content';

	var _lastWebResponse = null;
	var _stackWebResponse = [];

	var _idToken = '';

	var _timeoutSession;

	var _alertError = function (msg) {
		Swal.fire({
			text: msg,
			icon: 'error',
			buttonsStyling: false,
			confirmButtonText: WebAppLocals.getMessage('error_confirmButtonText'),
			customClass: {
				confirmButton: 'btn font-weight-bold btn-light-primary',
			},
		}).then(function () {
			KTUtil.scrollTop();
		});
	};

	var _alertSuccess = function (msg) {
		Swal.fire({
			text: msg,
			icon: 'success',
			buttonsStyling: false,
			confirmButtonText: WebAppLocals.getMessage('success_confirmButtonText'),
			customClass: {
				confirmButton: 'btn font-weight-bold btn-light-primary',
			},
		}).then(function () {
			KTUtil.scrollTop();
		});
	};

	var _alertConfirm = function (msg, fnCallback) {
		Swal.fire({
			text: msg,
			icon: 'warning',
			buttonsStyling: false,
			confirmButtonText: WebAppLocals.getMessage('success_confirmButtonText'),
			showCancelButton: true,
			cancelButtonText: WebAppLocals.getMessage('cancel'),
			customClass: {
				confirmButton: 'btn font-weight-bold btn-light-primary',
				cancelButton: 'btn font-weight-bold btn-light-danger',
			},

		}).then(function (result) {
			fnCallback(result);
		});
	};

	var _get = function (url, fnCallback = null) {
		_blurPage();
		_blockPage();
		let _url = '/' + docLang + '/'+ url;
		$.ajax({
			url: _url + '?_t=' + Date.now(),
			type: 'GET',
			dataType: 'json',
			async: true,
		})
			.done(function (webResponse) {
				if (webResponse && typeof webResponse === 'object') {
					if (webResponse.errorCode == -1) {
						window.location.href = "/en/auth/signout";
					}
					else if (webResponse.errorCode == 0) {
						if (typeof fnCallback === 'function') {
							fnCallback(webResponse);
						}
						_unblurPage();
						_unblockPage();
					} else {
						_unblurPage();
						_unblockPage();
						_alertError(webResponse.message);
					}
				} else {
					_unblurPage();
					_unblockPage();
					_alertError(WebAppLocals.getMessage('error'));
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				_alertError(WebAppLocals.getMessage('error'));
				_unblurPage();
				_unblockPage();
			});
	};

	var _post = function (url, data = null, fnCallback = null) {
		_blurPage();
		_blockPage();
		let _url = '/' + docLang + '/'+ url;
		$.ajax({
			url: _url + '?_t=' + Date.now(),
			type: 'POST',
			dataType: 'json',
			data: data,
			async: true,
		})
			.done(function (webResponse) {
				if (webResponse && typeof webResponse === 'object') {
					if (webResponse.errorCode == -1) {
						window.location.href = "/en/auth/signout";
					}
					else if (webResponse.errorCode == 0) {
						if (typeof fnCallback === 'function') {
							fnCallback(webResponse);
						}
						_unblurPage();
						_unblockPage();
					} else {
						_unblurPage();
						_unblockPage();
						_alertError(webResponse.message);
					}
				} else {
					_unblurPage();
					_unblockPage();
					_alertError(WebAppLocals.getMessage('error'));
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				_alertError(WebAppLocals.getMessage('error'));
				_unblurPage();
				_unblockPage();
			});
	};

	var _postForm = function (formId, url, fnCallback = null) {
		_blurPage();
		_blockPage();
		let _data = $(formId).serializeFormJSON();
		let _url = '/' + docLang + '/'+ url;
		$.ajax({
			url: _url + '?_t=' + Date.now(),
			type: 'POST',
			dataType: 'json',
			data: _data,
			async: true,
		})
			.done(function (webResponse) {
				if (webResponse && typeof webResponse === 'object') {
					if (webResponse.errorCode == -1) {
						window.location.href = "/en/auth/signout";
					}
					else if (webResponse.errorCode == 0) {
						if (typeof fnCallback === 'function') {
							fnCallback(webResponse);
						}
						_unblurPage();
						_unblockPage();
					} else {
						_unblurPage();
						_unblockPage();
						_alertError(webResponse.message);
					}
				} else {
					_unblurPage();
					_unblockPage();
					_alertError(WebAppLocals.getMessage('error'));
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				_alertError(WebAppLocals.getMessage('error'));
				_unblurPage();
				_unblockPage();
			});
	};

	var _postFormData = function (formId, url, _data, fnCallback = null) {
		_blurPage();
		_blockPage();
		let _url = '/' + docLang + '/'+ url;
		$.ajax({
			url: _url + '?_t=' + Date.now(),
			type: 'POST',
			data: _data,
			async: true,
			cache: false,
			contentType: false,
			processData: false
		})
			.done(function (webResponse) {
				if (webResponse && typeof webResponse === 'object') {
					if (webResponse.errorCode == -1) {
						window.location.href = "/en/auth/signout";
					}
					else if (webResponse.errorCode == 0) {
						if (typeof fnCallback === 'function') {
							fnCallback(webResponse);
						}
						_unblurPage();
						_unblockPage();
					} else {
						_unblurPage();
						_unblockPage();
						_alertError(webResponse.message);
					}
				} else {
					_unblurPage();
					_unblockPage();
					_alertError(WebAppLocals.getMessage('error'));
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				_alertError(WebAppLocals.getMessage('error'));
				_unblurPage();
				_unblockPage();
			});
	};

	var _loadPage = function (url, isSubPage = false, fnCallback = null) {
		_blurPage();
		_blockPage();
		let _url = '/' + docLang + '/'+ url;
		$.ajax({
			url: _url + '?_t=' + Date.now(),
			type: 'GET',
			dataType: 'json',
			async: true,
		})
			.done(function (webResponse) {
				if (webResponse && typeof webResponse === 'object') {
					if (webResponse.errorCode == -1) {
						window.location.href = "/en/auth/signout";
					}
					else if (webResponse.errorCode == 0) {
						let title = webResponse.title != null ? webResponse.title : document.title;

						WebFB.logPageView(_url);

						webResponse.url = _url;
						if (!isSubPage) {
							_lastWebResponse = webResponse;
						} else {
							_stackWebResponse.push(webResponse);
						}

						$(_pageContainerId).empty();

						$(_pageContainerId).html(webResponse.data);

						window.history.pushState(
							{
								id: _id,
								url: _url,
								title: title,
							},
							title,
							_url
						);

						if (typeof fnCallback === 'function') {
							fnCallback(webResponse);
						}
						_unblurPage();
						_unblockPage();
					} else if (webResponse.errorCode == 404) {
						window.location.href = '/' + docLang + '/dashboard';
					} else {
						_unblurPage();
						_unblockPage();
						_alertError(webResponse.message);
					}
				} else {
					_unblurPage();
					_unblockPage();
					_alertError(WebAppLocals.getMessage('error'));
				}

				_initModal();
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				_alertError(WebAppLocals.getMessage('error'));
				_unblurPage();
				_unblockPage();
			});
	};

	var _loadPartialPage = function (containerId,  url, fnCallback = null) {
		KTApp.block(containerId, {
			overlayColor: '#000000',
			state: 'primary',
			message: 'Processing...'
		});

		let _url = '/' + docLang + '/'+ url;
		if(_url.includes("?")){
			_url +='&_t=' + Date.now()
		}
		else{
			_url +='?_t=' + Date.now()
		}
		$.ajax({
			url: _url ,
			type: 'GET',
			dataType: 'json',
			async: true,
		})
			.done(function (webResponse) {
				if (webResponse && typeof webResponse === 'object') {
					if (webResponse.errorCode == -1) {
						window.location.href = "/en/auth/signout";
					}
					else if (webResponse.errorCode == 0) {

						$(containerId).html(webResponse.data);


						if (typeof fnCallback === 'function') {
							fnCallback(webResponse);
						}
						KTApp.unblock(containerId);
					} else if (webResponse.errorCode == 404) {
						window.location.href = '/' + docLang + '/dashboard';
					} else {
						KTApp.unblock(containerId);
						_alertError(webResponse.message);
					}
				} else {
					KTApp.unblock(containerId);
					_alertError(WebAppLocals.getMessage('error'));
				}
			})
			.fail(function (jqXHR, textStatus, errorThrown) {
				_alertError(WebAppLocals.getMessage('error'));
				KTApp.unblock(containerId);
			});
	};

	var _closeSubPage = function (fnCallback = null) {
		var _pre = _stackWebResponse.pop();
		if (!_pre) {
			_pre = _lastWebResponse;
			_lastWebResponse = null;
		}

		if (_pre) {
			var title = _pre.title != null ? _pre.title : document.title;

			$('#subHeaderPageTitle').text(title);

			$(_pageContainerId).html(_pre.data);

			if (typeof fnCallback === 'function') {
				fnCallback();
			}
			_unblurPage();
			_unblockPage();
		} else {
			_loadPage('/web/product/search');
		}
	};

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

	var _blurPage = function () {
		$(_pageContainerId).foggy({
			blurRadius: 3,
			opacity: 1,
			cssFilterSupport: true,
		});
	};

	var _unblurPage = function () {
		$(_pageContainerId).foggy(false);
	};

	var _showModal = function (_modalId) {
		$(_modalId).modal('show');
        $('.modal-backdrop').hide();
        //KTUtil.scrollTop();
	};

	var _hideModal = function (_modalId) {
		$(_modalId).modal('hide');
		_unblurPage();
	};


	var _initModal = function () {
		$('.modalAction').each(function () {
			$(this).off('click');
			$(this).click(function (e) {
				e.preventDefault();
				var form = $(this).parent().parent().parent();
				var url = $(form).attr('action');
				var data = $(form).serializeJSON();

				var callback = null;
				if ($(form).find('.modalValueCallback').val() != '') {
					callback = eval($(form).find('.modalValueCallback').val());
				}
				_post(url, data, callback);
				$(form).parent().parent().parent().modal('hide');
			});
		});
	};

	var _openModal = function (webResponse) {
		_resetModal();
		$('.modalForm').attr('action', webResponse.data.modalRoute);
		$('#popupModalTitle').html(webResponse.data.modalTitle);
		$('#popupModalText').html(webResponse.data.modalText);
		$('#popupModalValueId').val(webResponse.data.id);
		$('.modalValueCallback').val(webResponse.data.fnCallback);
		$('.modalAction').html(webResponse.data.modalButton);
		$('#popupModal').modal('show');
	};

	var _resetModal = function () {
		$('.modalForm').attr('action', '#');
		$('#popupModalTitle').html('');
		$('#popupModalText').html('');
		$('#popupModalValueId').val('');
		$('.modalValueCallback').val('');
		$('.modalAction').html('');
	};

	var _signout = function () {
		firebase
			.auth()
			.signOut()
			.then(function () {
				// Sign-out successful.
			})
			.catch(function (error) {
				// An error happened.
			});
	};

	var _setUpFirebase = function () {

		firebase.auth().onAuthStateChanged(function (user) {
			if (!user) {
				_loadPage('/en/auth/signout', false, null);
			} else {
				firebase
					.auth()
					.currentUser.getIdToken(true)
					.then(function (idToken) {
						_idToken = idToken;
					})
					.catch(function (error) {
						// Handle error
					});
			}
		});
	};

	var _setSessionTimeoutCallback = function () {
		/*
		_timeoutSession = setTimeout(function () {
			if (confirm("Press a button!\nEither OK or Cancel.")) {
				_setSessionTimeoutCallback();
			}
			else {
				_signout();
			}
		}, 5000); //30s
		*/
	};

	var _initSessionTimeout = function () {
		document.addEventListener(
			'mousemove',
			function (e) {
				clearTimeout(_timeoutSession);
				_setSessionTimeoutCallback();
			},
			true
		);
	};

	var _createDatatable = function (vElementId, vColumns, vData, vAdditionalOptions) {
		//////////////////////////
		// delete cached datatable
		if (datatableVar != null && $.fn.DataTable.isDataTable(datatableVar)) {
			datatableVar.clear();
			datatableVar.destroy();
		}

		var table = $('#' + vElementId);

		///////////////////////
		// initialize datatable
		var fileName = 'Aumet Marketplace';
		// if (!$('#pageTitle').is(':hidden')) {
		// 	fileName += ' - ' + $('#pageTitle').text();
		// }
		// if (!$('#dashboard_daterangepicker_start').is(':hidden')) {
		// 	fileName += ' - ' + $('#dashboard_daterangepicker_start').data('dateFrom') + ' to ' + $('#dashboard_daterangepicker_start').data('dateTo');
		// }
		// if (!$('#dashboard_daterangepicker_end').is(':hidden')) {
		// 	fileName += ' -- ' + $('#dashboard_daterangepicker_end').data('dateFrom') + ' to ' + $('#dashboard_daterangepicker_start').data('dateTo');
		// }

		var dbOptions = {
			data: vData,
			columns: vColumns,
			rowId: 'id',
			dom: 'Blfrtip',
			buttons: [
				{ extend: 'excelHtml5', filename: fileName },
				{ extend: 'pdfHtml5', filename: fileName },
			],
			responsive: true,
			pageLength: 25,
			scrollX: false,
			orderCellsTop: true,
			order: [[0, 'asc']],
		};

		var dbOptionsObj = { ...dbOptions };

		if (vAdditionalOptions && vAdditionalOptions.datatableOptions) {
			var dbOptionsObj = { ...dbOptions, ...vAdditionalOptions.datatableOptions };
		}

		datatableVar = $(table).DataTable(dbOptionsObj).draw();

		if (vAdditionalOptions && vAdditionalOptions.addSettings) {
			$('#' + vAdditionalOptions.addSettings.addButton).on('click', function () {
				datatableVar.row.add(vAdditionalOptions.addSettings.addText).draw(false);
			});
		}

		return datatableVar;
	};

	// Public Functions
	return {
		init: function () {
			//_setUpFirebase();
			WebAppLocals.init();
			_initModal();
			_loadPage(_ajaxUrl);

			//RegistrationWizard.init();

			_initSessionTimeout();

			//$("#webGuidedTourModal").modal();
		},
		signout: function () {
			return _signout();
		},
		loadPage: function (url, fnCallback = null) {
			return _loadPage(url, false, fnCallback);
		},
		loadSubPage: function (url, fnCallback = null) {
			return _loadPage(url, true, fnCallback);
		},
		loadPartialPage: function (containerId,  url, fnCallback = null){
			return _loadPartialPage(containerId, url, fnCallback);
		},
		closeSubPage: function (fnCallback = null) {
			return _closeSubPage(fnCallback);
		},
		block: function (_msgKey = "loading") {
			return _blockPage(_msgKey);
		},
		unblock: function () {
			return _unblockPage();
		},
		alertSuccess: function (msg) {
			return _alertSuccess(msg);
		},
		alertError: function (msg) {
			return _alertError(msg);
		},
		alertConfirm: function (msg, fnCallback) {
			_alertConfirm(msg, fnCallback);
		},
		get: function (url, fnCallback = null) {
			return _get(url, fnCallback);
		},
		post: function (url, data = null, fnCallback = null) {
			return _post(url, data, fnCallback);
		},
		postForm: function (formId, url, fnCallback = null) {
			return _postForm(formId, url, fnCallback);
		},
		postFormData: function (formId, url, formData, fnCallback = null) {
			return _postFormData(formId, url, formData, fnCallback);
		},
		openModal: function (webResponse) {
			_openModal(webResponse);
		},
		createDatatable: function (vElementId, vColumns, vData, vAdditionalOptions) {
			_createDatatable(vElementId, vColumns, vData, vAdditionalOptions);
		},
		showModal: function (_modalId){
			_showModal(_modalId);
		},
		hideModal: function (_modalId){
			_hideModal(_modalId);
		},
	};
})();
