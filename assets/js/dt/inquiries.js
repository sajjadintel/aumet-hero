'use strict';

// Date range picker with time picker
$('#rangetime').daterangepicker({
	autoUpdateInput: false,
	timePicker: true,
	locale: {
		format: 'MM/DD/YYYY hh:mm A',
		cancelLabel: 'Clear',
		applyLabel: 'OK'
	}
});

//Setting fields in hidden fields
$('#rangetime').on('apply.daterangepicker', function(ev, picker) {
	$(this).val(picker.startDate.format('MM/DD/YYYY hh:mm A') + ' - ' + picker.endDate.format('MM/DD/YYYY hh:mm A'));

});
$('#senderType').select2().on('select2:selecting', function (e) {
	$('#senderTypeHidden').val(e.params.args.data.id);
});
$('#inquiryStatus').select2().on('select2:selecting', function (e) {
	$('#inquiryStatusHidden').val(e.params.args.data.id);
});
$('#inquirySenderUser').select2().on('select2:selecting', function (e) {
	$('#inquirySenderUserHidden').val(e.params.args.data.id);
});
$('#inquiryReceiverUser').select2().on('select2:selecting', function (e) {
	$('#inquiryReceiverUserHidden').val(e.params.args.data.id);
});
$('#kt_datepicker_2').daterangepicker({
}, function(start, end, label) {
	console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
$('#manufacturerType').select2().on('select2:selecting', function (e) {
	$('#manufacturerTypeHidden').val(e.params.args.data.id);
});
$('#boType').select2().on('select2:selecting', function (e) {
	$('#boTypeHidden').val(e.params.args.data.id);
});

//reset form
$('#filterForm').trigger("reset");

// Class definition
var KTDatatableInquiry = (function() {
	// Private functions
	var _init = function() {
		var datatable = $('#kt_datatableInquiries').KTDatatable({
			data: {
				type: 'remote',
				source: {
					read: {
						url: HOST_URL + '/' + docLang + '/inquiries/datatable' + '?_t=' + Date.now()
					}
				},
				pageSize: 10,
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
				saveState: {
					cookie: false,
					webstorage: false,
				},
			},
			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,
			buttonInRowClick:function(event) {
				event.stopPropagation();
				console.log('Button in the row clicked.');
			},
			// columns definition
			columns: [
				{
					field: 'senderCompany',
					title: 'Sender Company',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.senderCompany;
					}
				},
				{
					field: 'senderCountry',
					title: 'Sender Country',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.senderCountry;
					}
				},
				{
					field: 'senderType',
					title: 'Sender Type',
					width: 90,
					sortable: true,
					autoHide: false,
					template: function(row) {

						return row.senderType;
					}
				},
				{
					field: 'receiverCompany',
					title: 'Receiver Company',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.receiverCompany;
					}
				},
				{
					field: 'sentOnDate',
					title: 'Sent On Date',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.sentOnDate;
					}
				},
				{
					field: 'repliedOnDate',
					title: 'Received Reply On',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.repliedOnDate;
					}
				},
				{
					field: 'actionStatus',
					title: 'Status',
					width: 70,
					sortable: true,
					autoHide: false,
					template: function(row) {
						var temp = '';
						switch (row.actionStatus){
							case 0:
								temp = '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Pending</span>';
								break;
							case 1:
								temp = '<span class="label font-weight-bold label-lg  label-success label-inline">Sent</span>';
								break;
							case 2:
								temp = '<span class="label font-weight-bold label-lg label-light-info label-inline">Replied</span>';
								break;
							case 3:
								temp = '<span class="label font-weight-bold label-lg label-light-danger label-inline">Locked</span>';
								break;
							case 4:
								temp = '<span class="label font-weight-bold label-sm label-danger label-inline pt-4 pb-4">Disapproved</span>';
								break;
						}
						return temp;
					}
				},
				{
					field: 'Actions',
					title: 'Actions',
					width: 220,
					sortable: false,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						let emailNeeded = '';
						if(row.noOfRcverUsers==0){
							emailNeeded += '<a href="javascript:;" class="btn btn-outline-primary ml-5 fa fa-envelope" title="Add Email" onclick="KTDatatableInquiry.addEmail('+ row.messageId +')"></a>';
						}
						var temp='<a href="javascript:;" class="btn btn-outline-secondary fab fa-readme" title="View Inquiry" onclick="KTDatatableInquiry.viewMessage('+ row.messageId +')"></a>';
						if(row.actionStatus == 0 && row.parentId == 0){
							temp += '<a href="javascript:;" class="btn btn-outline-primary ml-5" title="Approve" onclick="KTDatatableInquiry.approveMessage('+ row.messageId +')"> <i class="ki ki-bold-check-1 icon-sm"></i></a>' +
								'<a href="javascript:;" class="btn btn-outline-danger ml-5" title="Disapprove" onclick="KTDatatableInquiry.disapproveMessage('+ row.messageId +')"> <i class="ki ki-bold-close icon-sm"></a>';
						}
						temp += emailNeeded;
						return temp;

						return (
							'<a href="javascript:;" class="btn btn-outline-secondary fab fa-readme" title="View Inquiry" onclick="KTDatatableInquiry.viewMessage('+ row.messageId +')"></a>' +
							'<a href="javascript:;" class="btn btn-outline-primary ml-5" title="Approve" onclick="KTDatatableInquiry.approveMessage('+ row.messageId +')"> <i class="ki ki-bold-check-1 icon-sm"></i></a>' +
							'<a href="javascript:;" class="btn btn-outline-danger ml-5" title="Disapprove" onclick="KTDatatableInquiry.disapproveMessage('+ row.messageId +')"> <i class="ki ki-bold-close icon-sm"></a>' +
							emailNeeded
						);
					}
				}
			]
		}).sort('sentOnDate','desc');

		$('#submitButton').click(function(event){

			var inquiryStatusHidden = $('#filterForm').find('input[name="inquiryStatusHidden"]').val();
			var inquiryReceiverUserHidden = $('#filterForm').find('input[name="inquiryReceiverUserHidden"]').val();
			var inquirySenderUserHidden = $('#filterForm').find('input[name="inquirySenderUserHidden"]').val();
			var senderTypeHidden = $('#filterForm').find('input[name="senderTypeHidden"]').val();
			var inquiryDate = $('#filterForm').find('input[name="inquiryDate"]').val();
			var manufacturerType = $('#filterForm').find('input[name="manufacturerTypeHidden"]').val();
			var boTypeHidden = $('#filterForm').find('input[name="boTypeHidden"]').val();
			var emailNeeded = ($('#filterForm .emailNeeded:checked').length>0)? $('#filterForm .emailNeeded:checked').val() : 0;

			datatable.setDataSourceParam('inquiryStatusHidden', inquiryStatusHidden);
			datatable.setDataSourceParam('inquiryReceiverUserHidden', inquiryReceiverUserHidden);
			datatable.setDataSourceParam('inquirySenderUserHidden', inquirySenderUserHidden);
			datatable.setDataSourceParam('senderTypeHidden', senderTypeHidden);
			datatable.setDataSourceParam('inquiryDate', inquiryDate);
			datatable.setDataSourceParam('boTypeHidden', boTypeHidden);
			datatable.setDataSourceParam('manufacturerTypeHidden', manufacturerType);
			datatable.setDataSourceParam('emailNeeded', emailNeeded);

			//console.log(datatable);
			WebApp.block();
			datatable.reload();
		});
		$('#kt_datatableInquiries').on('datatable-on-ajax-done',function(){
			WebApp.unblock();
		});
		$('#kt_datatableInquiries').on('datatable-on-ajax-fail',function(){
			WebApp.unblock();
		});
	};

	var _disapproveMessage = function(_id) {
		WebApp.get( "inquiry/disapprove/"+_id,KTDatatableInquiry.submitCallback);
	}

	var _approveMessage = function(_id) {
		WebApp.get( "inquiry/approve/"+_id,KTDatatableInquiry.submitCallback);
	}

	var _viewMessage = function(_id) {
		$("#genericModal").modal("show");
		WebApp.loadPartialPage("#genericModalContent", "inquiry/"+_id);
	}

	var _submitNewEmail = function(){
		var msgId = $('#msgId').val();
		var newEmail = $('#newEmail').val();
		if(newEmail==''){
			$('#newEmailError').text('Please add email');
			return false;
		}

		let _url = '/' + docLang + '/inquiry/add_email';
		$.ajax({
			url: _url + '?_t=' + Date.now(),
			type: 'POST',
			dataType: 'json',
			data: {'msgId':msgId,'email':newEmail},
			async: true,
		})
		.done(function (webResponse) {
			if (webResponse && typeof webResponse === 'object') {
				if (webResponse.errorCode == 200) {
					WebApp.alertSuccess(webResponse.message);
					$("#genericModal").modal("hide");
				}else{
					WebApp.alertError(webResponse.message);
				}
			} else {
				WebApp.alertError(webResponse.message);
			}
		});
	}

	var _addEmail = function(_id) {
		var modelConent = `<div class="modal-header">
			<h5 class="modal-title" id="inquirySubject">Add Email</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i aria-hidden="true" className="ki ki-close"></i>
			</button>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-9">
					<label id="newEmailError" class="text-danger"></label>
					<input type="hidden" id="msgId" name="msgId" value="${_id}" /> 
					<input type="email" id="newEmail" name="newEmail" class="form-control" /> 
				</div>
				<div class="col-3">
					<label id="btnLabel" class="text-danger"></label>
					<button type="button" name="add_email" class="btn btn-primary mt-6" onclick="KTDatatableInquiry.submitNewEmail()">Add Email</button>
				</div>
        	</div>   
        </div>
        <div class="modal-footer">
        <label class="text-danger"></label>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>`;

		$('#genericModalContent').html(modelConent);
		$("#genericModal").modal("show");
	}

	return {
		// Public functions
		init: function() {
			_init();
		},
		disapproveMessage: function(_id) {
			_disapproveMessage(_id);
		},
		approveMessage: function(_id) {
			_approveMessage(_id);
		},
		viewMessage: function(_id) {
			_viewMessage(_id);
		},
		addEmail: function(_id) {
			_addEmail(_id);
		},
		submitNewEmail: function() {
			_submitNewEmail();
		},
		resetDataTable: function(_id) {
			$('#filterForm').trigger("reset");

			$('#inquiryStatusHidden').val('0');
			$('#inquiryStatus').val('0');
			$('#inquiryStatus').trigger('change.select2');

			$('#inquiryReceiverUserHidden').val('0');
			$('#inquiryReceiverUser').val('0');
			$('#inquiryReceiverUser').trigger('change.select2');

			$('#inquirySenderUserHidden').val('0');
			$('#inquirySenderUser').val('0');
			$('#inquirySenderUser').trigger('change.select2');

			$('#senderTypeHidden').val('0');
			$('#senderType').val('0');
			$('#senderType').trigger('change.select2');

			$('#manufacturerTypeHidden').val('0');
			$('#manufacturerType').val('0');
			$('#manufacturerType').trigger('change.select2');


			$('#boTypeHidden').val('0');
			$('#boType').val('0');
			$('#boType').trigger('change.select2');


			$("input:radio").val(0);
			$("input:radio").attr("checked", false);

			WebApp.block();
			$('#submitButton').trigger('click');
		},
		submitCallback: function(webResponse) {
			if(webResponse.errorCode == 0){
				WebApp.alertSuccess(webResponse.message);
				window.location.reload();
			}else {
				WebApp.alertError(webResponse.message);
			}
		},
	};

})();

jQuery(document).ready(function() {
	function disapproveModel(webResponse){
		WebApp.alertSuccess(webResponse.message);
	}

	KTDatatableInquiry.init();
});
