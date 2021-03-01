'use strict';
// $('#kt_datepicker_2').daterangepicker({
// 	autoUpdateInput: false
// });
$('#kt_datepicker_2').daterangepicker({
}, function(start, end, label) {
	// console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
$('#country_id').select2().on('select2:selecting', function (e) {
	$('#CountryID').val(e.params.args.data.id);
});
$('#Speciality_ID').select2().on('select2:selecting', function (e) {
	$('#SpecialityID').val(e.params.args.data.id);
});
$('#Medicalline_ID').select2().on('select2:selecting', function (e) {
	$('#MedicallineID').val(e.params.args.data.id);
});
$('#status_Id').select2().on('select2:selecting', function (e) {
	$('#statusId').val(e.params.args.data.id);
});
$('#filterForm').trigger("reset");



var KTDatatableDistributors = (function() {

	// Private functions
	var _init = function() {
		var datatable = $('#kt_datatableBusinessOpportunity').KTDatatable({
			data: {
				type: 'remote',
				source: {
					read: {
						url: HOST_URL + '/' + docLang + '/businessOppotunities/datatable' + '?_t=' + Date.now(),
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
					field: 'ID',
					title: 'id',
					sortable: 'asc',
					type: 'number',
					selector: false,
					textAlign: 'left',
					autoHide: false,
					template: function(row) {
						return row.ID;
					}
				},
				{
					field: 'ManufacturerName',
					title: 'Manufacturer Name',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.ManufacturerName;
					}
				},
				{
					field: 'DistributorName',
					title: 'Distributor Name',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.DistributorName
					}
				},
				{
					field: 'CountryName',
					title: 'Country',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.CountryName
					}
				},
				{
					field: 'BussinessUserPersonName',
					title: 'Person Name',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.BussinessUserPersonName
					}
				},
				{
					field: 'BussinessUserJobTitle',
					title: 'Job Title',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.BussinessUserJobTitle;
					}
				},
				{
					field: 'BussinessUserEmail',
					title: 'Email',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.BussinessUserEmail;
					}
				},
				{
					field: 'sendDateTime',
					title: 'Sent on',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.sendDateTime;
					}
				},
				{
					field: 'Days remaining',
					title: 'Days remaining',
					sortable: true,
					autoHide: false,
					template: function(row) {
						let payload = null;
						if(row.payload!=null){
							payload = JSON.parse(row.payload);
							return payload.metadata.lastLoginAt.split("T")[0];
						}else{
							return '';
						}
					}
				},
				{
					field: 'reminderCount',
					title: 'Follow up emails sent',
					sortable: false,
					autoHide: false,
					template: function(row) {
						return row.reminderCount;
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
							'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit" onclick="KTDatatableDistributors.edit('+ row.ID +')">Edit</a>' +
							'<a href="javascript:;" class="btn btn-outline-primary" title="View" onclick="KTDatatableDistributors.view('+ row.ID +')">View</a>'
						);
					}
				}
			]
		}).sort('ID','asc');
		$('#submitButton').click(function(event){
			// console.log('click');
			var Name = $('#filterForm').find('input[name="ManufacturerName"]').val();
			var DistributorName = $('#filterForm').find('input[name="DistributorName"]').val();
			var BussinessUserJobTitle = $('#filterForm').find('input[name="BussinessUserJobTitle"]').val();
			var CountryID = $('#filterForm').find('input[name="CountryID"]').val();
			var BussinessUserPersonName = $('#filterForm').find('input[name="BussinessUserPersonName"]').val();
			var BussinessUserEmail = $('#filterForm').find('input[name="BussinessUserEmail"]').val();
			var sendDateTime = $('#filterForm').find('input[name="sendDateTime"]').val();
			var SpecialityID = $('#filterForm').find('input[name="SpecialityID"]').val();
			var MedicallineID = $('#filterForm').find('input[name="MedicallineID"]').val();
			var statusId = $('#filterForm').find('input[name="statusId"]').val();
			var reminderCount = $('#filterForm').find('input[name="reminderCount"]').val();
			datatable.setDataSourceParam('ManufacturerName', Name);
			datatable.setDataSourceParam('BussinessUserJobTitle', BussinessUserJobTitle);
			datatable.setDataSourceParam('DistributorName', DistributorName);
			datatable.setDataSourceParam('CountryID', CountryID);
			datatable.setDataSourceParam('BussinessUserPersonName', BussinessUserPersonName);
			datatable.setDataSourceParam('BussinessUserEmail', BussinessUserEmail);
			datatable.setDataSourceParam('sendDateTime', sendDateTime);
			datatable.setDataSourceParam('SpecialityID', SpecialityID);
			datatable.setDataSourceParam('MedicallineID', MedicallineID);
			datatable.setDataSourceParam('reminderCount', reminderCount);
			datatable.setDataSourceParam('connectionStatusId', statusId);
			// console.log(datatable);
			WebApp.block();
			datatable.reload();


		});
		$('#kt_datatableDistributors').on('datatable-on-ajax-done',function(){
			WebApp.unblock();
		});
		$('#kt_datatableDistributors').on('datatable-on-init',function(event){
			// WebApp.block();
			event.preventDefault();
			datatable.setDataSourceParam('ManufacturerName', '');
			datatable.setDataSourceParam('BussinessUserJobTitle', '');
			datatable.setDataSourceParam('DistributorName', '');
			datatable.setDataSourceParam('CountryID', '');
			datatable.setDataSourceParam('BussinessUserPersonName', '');
			datatable.setDataSourceParam('BussinessUserEmail', '');
			datatable.setDataSourceParam('sendDateTime', '');
			datatable.setDataSourceParam('SpecialityID', '');
			datatable.setDataSourceParam('MedicallineID', '');
			datatable.setDataSourceParam('reminderCount', '');
			datatable.setDataSourceParam('connectionStatusId', '');
			// datatable.sort('ID', 'asc');
			datatable.reload();
		});
		$('#kt_datatableDistributors').on('datatable-on-ajax-fail',function(){
			WebApp.unblock();
		});

	};


	return {
		// Public functions
		init: function() {
			_init();
		},
		edit: function(_id) {
			WebApp.loadPage('distributors/' + _id + '/edit' );
		},
		view: function(_id) {
			WebApp.loadPage('distributors/' + _id );
		},
		resetDataTable: function(_id) {
			$('#filterForm').trigger("reset");
			$('#country_id').val('0');
			$('#CountryID').val('0');
			$('#country_id').trigger('change.select2');
			$('#Speciality_ID').val('0');
			$('#SpecialityID').val('0');
			$('#Speciality_ID').trigger('change.select2');
			$('#Medicalline_ID').val('0');
			$('#MedicallineID').val('0');
			$('#Medicalline_ID').trigger('change.select2');
			$('#status_Id').val('0');
			$('#statusId').val('0');
			$('#status_Id').trigger('change.select2');
			WebApp.block();
			$('#submitButton').trigger('click');
		},

	};

})();
// function distributorFormSubmit(){
// 	$('#pages').val(datatable.API.params.pagination.pages);
// 	$('#page').val(datatable.API.params.pagination.page);
// 	$('#perpage').val(datatable.API.params.pagination.perpage);
// 	$('#total').val(datatable.API.params.pagination.total);
// 	$('#sort_by').val(datatable.API.params.sort.field);
// 	$('#sort_order').val(datatable.API.params.sort.sort);
//
// 	var data =JSON.parse(JSON.stringify($('#filterForm').serializeArray()));
//
// 	console.log(data);
// 	WebApp.post('distributors/datatable',data,function(response){
// 		console.log(response)
// 		datatable.destroy();
// 		datatable.reload();
// 	});
// }
KTDatatableDistributors.init();