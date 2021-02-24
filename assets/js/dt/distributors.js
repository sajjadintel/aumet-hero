'use strict';
// $('#kt_datepicker_2').daterangepicker({
// 	autoUpdateInput: false
// });
$('#kt_datepicker_2').daterangepicker({
}, function(start, end, label) {
	console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
});
$('#country_id').select2().on('select2:selecting', function (e) {
	console.log(e.params.args.data.id);
	$('#CountryID').val(e.params.args.data.id);
});
$('#Speciality_ID').select2().on('select2:selecting', function (e) {
	console.log('SpecialityID '+e.params.args.data.id);
	$('#SpecialityID').val(e.params.args.data.id);
});
$('#Medicalline_ID').select2().on('select2:selecting', function (e) {
	console.log('MedicallineID '+e.params.args.data.id);
	$('#MedicallineID').val(e.params.args.data.id);
});
$('#status_Id').select2().on('select2:selecting', function (e) {
	console.log('statusId '+e.params.args.data.id);
	$('#statusId').val(e.params.args.data.id);
});
$('#filterForm').trigger("reset");



var KTDatatableDistributors = (function() {

	// Private functions
	var _init = function() {
		var datatable = $('#kt_datatableDistributors').KTDatatable({
			data: {
				type: 'remote',
				source: {
					read: {
						url: HOST_URL + '/' + docLang + '/distributors/datatable' + '?_t=' + Date.now(),
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
					field: 'Name',
					title: 'Name',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.Name;
					}
				},
				{
					field: 'PersonName',
					title: 'Person Name',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.PersonName
					}
				},
				{
					field: 'position',
					title: 'Job Title',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.position
					}
				},
				{
					field: 'email',
					title: 'Email',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.email
					}
				},
				{
					field: 'CountryName',
					title: 'Country',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.CountryName;
					}
				},
				{
					field: 'inquirySend',
					title: 'inquiries sent',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.inquirySend;
					}
				},
				{
					field: 'RegistrationDate',
					title: 'Registered Date',
					sortable: false,
					autoHide: false,
					template: function(row) {
						return row.RegistrationDate;
					}
				},
				{
					field: 'Registered',
					title: 'Registered',
					sortable: true,
					autoHide: false,
					template: function(row) {
						if(row.RegistrationDate){
							return 'Yes'
						}else{
							return 'No'
						}
					}
				},
				{
					field: 'Payload',
					title: 'last Login',
					sortable: true,
					autoHide: false,
					template: function(row) {
						let payload = null;
						if(row.payload!=null){
							payload = JSON.parse(row.payload);
							return payload.metadata.lastLoginAt;
						}else{
							return '';
						}
					}
				},
				{
					field: 'Accssed new website',
					title: 'Accssed new website',
					sortable: false,
					autoHide: false,
					template: function(row) {
						let payload = null;
						if(row.payload!=null){
							payload = JSON.parse(row.payload);
							let releaseDate = new Date('2021-1-31');
							let lastLogin = new Date(payload.metadata.lastLoginAt);
							let lastLoginDate = new Date(moment(lastLogin).format('YYYY-MM-DD'));
							if (lastLoginDate >= releaseDate) {
								return 'Yes';
							}else{
								return 'No';
							}
						}else{
							return 'No';
						}
					}
				},{
					field: 'Activated',
					title: 'Status',
					sortable: false,
					autoHide: false,
					template: function(row) {
						if(row.msgCount>0){
							return '<span class="label font-weight-bold label-lg  label-light-success label-inline">Activated</span>';
						}
						return '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Registered</span>';
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
		});
		$('#submitButton').click(function(event){
			console.log('click');
			var Name = $('#filterForm').find('input[name="Name"]').val();
			var CountryID = $('#filterForm').find('input[name="CountryID"]').val();
			var PersonName = $('#filterForm').find('input[name="PersonName"]').val();
			var email = $('#filterForm').find('input[name="email"]').val();
			var RegistrationDate = $('#filterForm').find('input[name="RegistrationDate"]').val();
			var SpecialityID = $('#filterForm').find('input[name="SpecialityID"]').val();
			var MedicallineID = $('#filterForm').find('input[name="MedicallineID"]').val();
			var statusId = $('#filterForm').find('input[name="statusId"]').val();
			var Registered = $("input[name='Registered']:checked").val();;
			var inquirySend = $("input[name='inquirySend']:checked").val();
			datatable.setDataSourceParam('Name', Name);
			datatable.setDataSourceParam('CountryID', CountryID);
			datatable.setDataSourceParam('PersonName', PersonName);
			datatable.setDataSourceParam('email', email);
			datatable.setDataSourceParam('RegistrationDate', RegistrationDate);
			datatable.setDataSourceParam('SpecialityID', SpecialityID);
			datatable.setDataSourceParam('MedicallineID', MedicallineID);
			datatable.setDataSourceParam('Registered', Registered);
			datatable.setDataSourceParam('inquirySend', inquirySend);
			datatable.setDataSourceParam('statusId', statusId);
			console.log(datatable);
			WebApp.block();
			datatable.reload();


		});
		$('#kt_datatableDistributors').on('datatable-on-ajax-done',function(){
			WebApp.unblock();
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