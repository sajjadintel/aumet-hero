'use strict';

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
						return row.Name;
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
							'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit" onclick="KTDatatableManufacturers.edit('+ row.ID +')">Edit</a>' +
							'<a href="javascript:;" class="btn btn-outline-primary" title="View" onclick="KTDatatableManufacturers.view('+ row.ID +')">View</a>'
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
			WebApp.loadPage('manufacturers/' + _id + '/edit' );
		},
		view: function(_id) {
			WebApp.loadPage('manufacturers/' + _id );
		},
	};
})();

KTDatatableManufacturers.init();