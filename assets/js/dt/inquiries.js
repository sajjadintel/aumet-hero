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
$('#boOnly').select2().on('select2:selecting', function (e) {
	$('#boOnlyHidden').val(e.params.args.data.id);
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
					field: 'actionStatus',
					title: 'Status',
					width: 55,
					sortable: true,
					autoHide: false,
					template: function(row) {
						var temp = '';
						switch (row.actionStatus){
							case 0:
								temp = '<span class="label label-md label-light-primary label-inline">Pending</span>';
								break;
							case 1:
								temp = '<span class="label label-md label-light-success label-inline">Sent</span>';
								break;
							case 2:
								temp = '<span class="label label-md label-light-info label-inline">Replied</span>';
								break;
							case 3:
								temp = '<span class="label label-md label-light-warning label-inline">Locked</span>';
								break;
							case 4:
								temp = '<span class="label label-md label-light-danger label-inline">Disapproved</span>';
								break;
						}
						return temp;
					}
				},
				{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return (
							'<a href="javascript:;" class="btn btn-outline-primary fab fa-readme" title="View Inquiry" onclick="KTDatatableMyProducts.viewMessage('+ row.messageId +')"></a>' +
							'<a href="javascript:;" class="btn btn-outline-primary ml-5 fa fa-check" title="Approve" onclick="KTDatatableMyProducts.approveMessage('+ row.messageId +')"></a>' +
							'<a href="javascript:;" class="btn btn-outline-primary ml-5 fa fa-times" title="Disapprove" onclick="KTDatatableMyProducts.disapproveMessage('+ row.messageId +')"></a>'
						);
					}
				}
			]
		});
		$('#submitButton').click(function(event){
			console.log('click');

			var inquiryStatusHidden = $('#filterForm').find('input[name="inquiryStatusHidden"]').val();
			var inquiryReceiverUserHidden = $('#filterForm').find('input[name="inquiryReceiverUserHidden"]').val();
			var inquirySenderUserHidden = $('#filterForm').find('input[name="inquirySenderUserHidden"]').val();
			var senderTypeHidden = $('#filterForm').find('input[name="senderTypeHidden"]').val();
			var inquiryDate = $('#filterForm').find('input[name="inquiryDate"]').val();
			var boOnly = $('#filterForm').find('input[name="boOnly"]').val();


			datatable.setDataSourceParam('inquiryStatusHidden', inquiryStatusHidden);
			datatable.setDataSourceParam('inquiryReceiverUserHidden', inquiryReceiverUserHidden);
			datatable.setDataSourceParam('inquirySenderUserHidden', inquirySenderUserHidden);
			datatable.setDataSourceParam('senderTypeHidden', senderTypeHidden);
			datatable.setDataSourceParam('inquiryDate', inquiryDate);
			datatable.setDataSourceParam('boOnly', boOnly);

			console.log(datatable);
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
		WebApp.loadPartialPage("#genericModalContent", "inquiry/"+_step);
	}

	var _approveMessage = function(_id) {
		WebApp.loadPartialPage("#genericModalContent", "inquiry/"+_step);
	}

	var _viewMessage = function(_id) {
		$("#genericModal").modal("show");
		WebApp.loadPartialPage("#genericModalContent", "inquiry/"+_id);
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
		resetDataTable: function(_id) {
			$('#filterForm').trigger("reset");
			WebApp.block();
			$('#submitButton').trigger('click');
		},
	};

})();

jQuery(document).ready(function() {
	KTDatatableInquiry.init();
});
