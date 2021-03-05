'use strict';
$('#adduser_modal').on('shown.bs.modal', function () {
	$(".modal-backdrop").hide();
});
var KTDatatableManufacturers = (function() {

	// Private functions
	var _init = function() {
		var datatable = $('#kt_datatableManufacturers').KTDatatable({
			data: {
				type: 'remote',
				source: {
					read: {
						url: HOST_URL + '/' + docLang + '/manufacturers/datatable' + '?_t=' + Date.now()
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
						return '<a href="javascript:;" data-toggle="modal" data-target="#adduser_modal"  title="Edit" onclick="KTDatatableManufacturers.addUser('+ row.ID +')">'+ row.Name+'</a>';
					}
				},
				{
					field: 'LoginToken',
					title: 'Token',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.LoginToken;
					}
				},
				{
					field: 'Actions',
					title: 'Actions',
					sortable: false,

					width: 200,
					autoHide: false,
					template: function(row) {
						var tmpHTML= '<a href="javascript:;" class="btn btn-primary mr-3" title="Edit" onclick="KTDatatableManufacturers.edit('+ row.ID +')">Edit</a>' +
							'<a href="javascript:;" class="btn btn-outline-primary mr-3" title="View" onclick="KTDatatableManufacturers.view('+ row.ID +')">View</a>';
						if(row.LoginToken){
							tmpHTML += '<a href="'+rootURL+'/'+docLang+'/auth/signin?token='+row.LoginToken+'" target="_blank" class="btn btn-warning mr-5" title="Edit" >Token</a>';
						}
						return tmpHTML;

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
			WebApp.loadPage('manufacturers/' + _id + '/edit' );
		},
		view: function(_id) {
			WebApp.loadPage('manufacturers/' + _id );
		},addUser: function(_id) {
			adjustPopUp();
			$('#companyId').val(_id);
			console.log(_id);
		}
	};
})();
function adjustPopUp(){

	$('.modal-lg').css('top','15%');

	$('.modal-lg').css('position','absolute');
	$('.modal-lg').css('width','100%');
	$('.modal-lg').css('right','26%');
	$('.modal-lg').css('left','auto');
}
KTDatatableManufacturers.init();