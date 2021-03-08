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
					title: 'Distributor Country',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.CountryName
					}
				},
				{
					field: 'BussinessUserPersonName',
					title: 'Distributor Person name',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.BussinessUserPersonName
					}
				},
				{
					field: 'BussinessUserJobTitle',
					title: 'Distributor Job Title',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.BussinessUserJobTitle;
					}
				},
				{
					field: 'BussinessUserEmail',
					title: 'Distributor Email',
					sortable: true,
					autoHide: true,
					template: function(row) {
						return row.BussinessUserEmail;
					}
				},
				{
					field: 'introSendDateTime',
					title: 'Sent on',
					sortable: true,
					autoHide: true,
					template: function(row) {
						return row.introSendDateTime.split(" ")[0];
					}
				},
				{
					field: 'connectionStatusId',
					title: 'Status',
					sortable: true,
					autoHide: true,
					template: function(row) {
						if(row.connectionStatusId==1){
							return '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Pending</span>';
						}
						else if(row.connectionStatusId==2){
							return '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Mail Opened</span>';
						}
						else if(row.connectionStatusId==3){
							return '<span class="label font-weight-bold label-lg  label-light-success label-inline">Viewed</span>';
						}
						else if(row.connectionStatusId==4){
							return '<span class="label font-weight-bold label-lg  label-light-success label-inline">Inquiry Sent</span>';
						}
						else if(row.connectionStatusId==5){
							return '<span class="label font-weight-bold label-lg  label-light-success label-inline">Call Scheduled</span>';
						}
					}
				},
				{
					field: 'Days remaining',
					title: 'Days remaining',
					sortable: true,
					autoHide: true,
					template: function(row) {
						if(row.endDate) {
							var date2 = new Date(row.endDate);
							var date1 = new Date();
							if(date2<date1){
								return 'Expired';
							}
							let days = 'Days';
							var Difference_In_Time = date2.getTime() - date1.getTime();
							var Difference_In_Days = Math.floor(Difference_In_Time / (1000 * 3600 * 24));
							if (Difference_In_Days < 1) {
								days = 'Hours';
								Difference_In_Days = Math.floor(Difference_In_Time / (1000 * 3600));
							}
							return Difference_In_Days + ' ' + days;
						}else{
							return '';
						}
					}
				},
				{
					field: 'reminderCount',
					title: 'Follow up emails sent',
					sortable: false,
					autoHide: true,
					template: function(row) {
						return row.reminderCount;
					},
				}
				// {
				// 	field: 'Actions',
				// 	title: 'Actions',
				// 	sortable: false,
				//
				// 	width: 200,
				// 	autoHide: true,
				// 	template: function(row) {
				// 		return (
				// 			'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit" onclick="KTDatatableDistributors.edit('+ row.ID +')">Edit</a>' +
				// 			'<a href="javascript:;" class="btn btn-outline-primary" title="View" onclick="KTDatatableDistributors.view('+ row.ID +')">View</a>'
				// 		);
				// 	}
				// }
			]
		}).sort('introSendDateTime','desc');
		$('#submitButton').click(function(event){
			// console.log('click');
			var Name = $('#filterForm').find('input[name="ManufacturerName"]').val();
			var DistributorName = $('#filterForm').find('input[name="DistributorName"]').val();
			var BussinessUserJobTitle = $('#filterForm').find('input[name="BussinessUserJobTitle"]').val();
			var CountryID = $('#filterForm').find('input[name="CountryID"]').val();
			var BussinessUserPersonName = $('#filterForm').find('input[name="BussinessUserPersonName"]').val();
			var BussinessUserEmail = $('#filterForm').find('input[name="BussinessUserEmail"]').val();
			var sendDateTime = $('#filterForm').find('input[name="sendDateTime"]').val();
			var email = $('#filterForm').find('input[name="email"]').val();
			var SpecialityID = $('#filterForm').find('input[name="SpecialityID"]').val();
			var MedicallineID = $('#filterForm').find('input[name="MedicallineID"]').val();
			var statusId = $('#filterForm').find('input[name="statusId"]').val();
			var reminderCount = $('#filterForm').find('input[name="reminderCount"]').val();
			var accessedNewWeb = $("input[name='accessedNewWeb']:checked").val();;
			datatable.setDataSourceParam('ManufacturerName', Name);
			datatable.setDataSourceParam('BussinessUserJobTitle', BussinessUserJobTitle);
			datatable.setDataSourceParam('DistributorName', DistributorName);
			datatable.setDataSourceParam('CountryID', CountryID);
			datatable.setDataSourceParam('BussinessUserPersonName', BussinessUserPersonName);
			datatable.setDataSourceParam('BussinessUserEmail', BussinessUserEmail);
			datatable.setDataSourceParam('sendDateTime', sendDateTime);
			datatable.setDataSourceParam('SpecialityID', SpecialityID);
			datatable.setDataSourceParam('MedicallineID', MedicallineID);
			datatable.setDataSourceParam('accessedNewWeb', accessedNewWeb);
			datatable.setDataSourceParam('reminderCount', reminderCount);
			datatable.setDataSourceParam('connectionStatusId', statusId);
			datatable.setDataSourceParam('BussinessUserEmail', email);
			// console.log(datatable);
			WebApp.block();
			datatable.reload();


		});
		$('#kt_datatableBusinessOpportunity').on('datatable-on-ajax-done',function(){
			WebApp.unblock();
		});
		$('#kt_datatableBusinessOpportunity').on('datatable-on-init',function(event){
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
			datatable.setDataSourceParam('accessedNewWeb', '');
			datatable.setDataSourceParam('reminderCount', '');
			datatable.setDataSourceParam('connectionStatusId', '');
			// datatable.sort('ID', 'asc');
			datatable.reload();
		});
		$('#kt_datatableBusinessOpportunity').on('datatable-on-ajax-fail',function(){
			WebApp.unblock();
		});

		$('#kt_datatableBusinessOpportunity .datatable-table tbody').on('click', 'tr', function () {
			var data = datatable.row( this ).data();
			console.log( data);
		} );

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
KTDatatableDistributors.init();