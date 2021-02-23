/*
'use strict';

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

			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
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
					field: 'Actions',
					title: 'Actions',
					sortable: false,

					width: 200,
					autoHide: false,
					template: function(row) {
						return (
							'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit" onclick="KTDatatableInquiry.edit('+ row.messageId +')">Edit</a>' +
							'<a href="javascript:;" class="btn btn-outline-primary" title="View" onclick="KTDatatableInquiry.view('+ row.messageId +')">View</a>'
						);
					}
				}
			]
		});
	};

	return {
		// Public functions
		init: function() {
			_init();
		},
		edit: function(_id) {
			WebApp.loadPage('inquiry/' + _id + '/edit' );
		},
		view: function(_id) {
			WebApp.loadPage('inquiry/' + _id );
		},
	};
})();

KTDatatableInquiry.init();*/

'use strict';
// Class definition

var KTDatatableMyProducts = (function() {

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
				serverPaging: false,
				serverFiltering: true,
				serverSorting: false,
				saveState: {
					cookie: true,
					webstorage: true,
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
			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
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
					sortable: true,
					autoHide: false,
					template: function(row) {
						var temp = '';
						switch (row.actionStatus){
							case 0:
								temp = '<span class="label label-primary">Pending</span>';
								break;
							case 1:
								temp = '<span class="label label-success">Sent</span>';
								break;
							case 2:
								temp = '<span class="label label-info">Replied</span>';
								break;
							case 3:
								temp = '<span class="label label-warning">Locked</span>';
								break;
							case 4:
								temp = '<span class="label label-danger">Disapproved</span>';
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
							'<a href="javascript:;" class="btn btn-outline-primary" title="View Product" onclick="KTDatatableMyProducts.viewMessage('+ row.messageId +')">View</a>' +
							'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit Product" onclick="KTDatatableMyProducts.approveMessage('+ row.messageId +')">Approve</a>' +
							'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit Product" onclick="KTDatatableMyProducts.disapproveMessage('+ row.messageId +')">Disapprove</a>'
						);
					}
				}
			]
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
	};
})();



jQuery(document).ready(function() {
	KTDatatableMyProducts.init();

	$(document).on('click', '#add-product', function(e) {
		e.preventDefault();
		WebApp.loadPage('myproducts/add');
	});

	/*$(document).on('click', '#add-product', function(e) {
		e.preventDefault();
		WebApp.loadPage('myproducts/add');
	});

	$(document).on('click', '#save-product', function(e) {
		e.preventDefault();
		WebApp.postForm('#frmProductForm', 'myproducts/add-product', fnCallbackSave);
		addProduct();
	});*/
});
