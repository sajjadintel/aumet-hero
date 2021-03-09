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
$('#adduser_modal').on('shown.bs.modal', function () {
	$(".modal-backdrop").hide();
});


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
					width: '100',
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
						return '<a href="javascript:;" title="Edit">'+ row.Name+'</a>';
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
					field: 'CompanyRegistrationDate',
					title: 'Registered Date',
					sortable: false,
					autoHide: true,
					template: function(row) {
						return row.CompanyRegistrationDate.split(" ")[0];
					}
				},
				{
					field: 'Registered',
					title: 'Registered',
					sortable: true,
					autoHide: true,
					template: function(row) {
						if(row.CompanyRegistrationDate){
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
					autoHide: true,
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
					field: 'payload',
					title: 'Accssed new website',
					sortable: false,
					autoHide: true,
					template: function(row) {
						let payload = null;
						if(row.payload!=null){
							return 'Yes';
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
					autoHide: true,
					template: function(row) {
						// console.log(row);
						if(row.statusId==1){
							return '<span class="label font-weight-bold label-lg  label-light-danger label-inline">Registered basic</span>';
						}
						else if(row.statusId==2){
							return '<span class="label font-weight-bold label-lg  label-light-warning label-inline">Registered full</span>';
						}
						else if(row.statusId==3 && row.inquirySend<1){
							return '<span class="label font-weight-bold label-lg  label-light-success label-inline">Onboarded</span>';
						}
						else if(row.statusId==3 && row.inquirySend>0){
							return '<span class="label font-weight-bold label-lg  label-light-success label-inline">Activated</span>';
						}
					}
				},
				{
					field: 'LoginToken',
					title: 'Token Exists',
					sortable: true,
					autoHide: true,
					template: function(row) {
						var tokenExists = '';
						if(row.LoginToken){
							tokenExists = 'Yes';
						}
						return tokenExists;
					}
				},
				{
					field: 'Actions',
					title: 'Actions',
					sortable: false,

					width: 200,
					autoHide: true,
					template: function(row) {
						var tmpHTML= '<a href="javascript:;" class="btn btn-primary mr-5" data-toggle="modal" data-target="#adduser_modal"  title="Edit" onclick="KTDatatableDistributors.addUser('+ row.ID +')">Add User</a>' +
							'<a href="javascript:;" class="btn btn-outline-primary mr-5" title="View" onclick="KTDatatableDistributors.view('+ row.ID +')">View</a>'
						if(row.LoginToken){
							tmpHTML += '<a href="javascript:;" class="btn btn-warning" title="View Inquiry" onclick="KTDatatableDistributors.getToken(\''+row.LoginToken+'\','+row.ID+')">Get Token</a>';
						}
						return tmpHTML;
					}
				}
			]
		}).sort('ID', 'DESC');
		$('#submitButton').click(function(event){
			// console.log('click');
			var Name = $('#filterForm').find('input[name="Name"]').val();
			var CountryID = $('#filterForm').find('input[name="CountryID"]').val();
			var PersonName = $('#filterForm').find('input[name="PersonName"]').val();
			var email = $('#filterForm').find('input[name="email"]').val();
			var RegistrationDate = $('#filterForm').find('input[name="RegistrationDate"]').val();
			var SpecialityID = $('#filterForm').find('input[name="SpecialityID"]').val();
			var MedicallineID = $('#filterForm').find('input[name="MedicallineID"]').val();
			var statusId = $('#filterForm').find('input[name="statusId"]').val();
			var Registered = $("input[name='Registered']:checked").val();;
			var accessedNewWeb = $("input[name='accessedNewWeb']:checked").val();;
			var inquirySend = $("input[name='inquirySend']:checked").val();
			datatable.setDataSourceParam('Name', Name);
			datatable.setDataSourceParam('CountryID', CountryID);
			datatable.setDataSourceParam('PersonName', PersonName);
			datatable.setDataSourceParam('email', email);
			datatable.setDataSourceParam('RegistrationDate', RegistrationDate);
			datatable.setDataSourceParam('SpecialityID', SpecialityID);
			datatable.setDataSourceParam('MedicallineID', MedicallineID);
			datatable.setDataSourceParam('Registered', Registered);
			datatable.setDataSourceParam('accessedNewWeb', accessedNewWeb);
			datatable.setDataSourceParam('inquirySend', inquirySend);
			datatable.setDataSourceParam('statusId', statusId);
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
			datatable.setDataSourceParam('Name', '');
			datatable.setDataSourceParam('CountryID', '');
			datatable.setDataSourceParam('PersonName', '');
			datatable.setDataSourceParam('email', '');
			datatable.setDataSourceParam('RegistrationDate', '');
			datatable.setDataSourceParam('SpecialityID', '');
			datatable.setDataSourceParam('MedicallineID', '');
			datatable.setDataSourceParam('Registered', '');
			datatable.setDataSourceParam('accessedNewWeb', '');
			datatable.setDataSourceParam('inquirySend', '');
			datatable.setDataSourceParam('statusId', '');
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
		addUser: function(_id) {
			adjustPopUp();
			$('#companyId').val(_id);
			console.log(_id);
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
		getToken: function (_id,cid){
			$("#genericModal").modal("show");
			WebApp.loadPartialPage("#genericModalContent", "manufacturers/token/"+_id+'/'+cid);
		}
	};

})();
function adjustPopUp(){

	$('.modal-lg').css('top','50%');

	$('.modal-lg').css('position','absolute');
	$('.modal-lg').css('width','100%');
	$('.modal-lg').css('right','26%');
	$('.modal-lg').css('left','auto');
}
KTDatatableDistributors.init();