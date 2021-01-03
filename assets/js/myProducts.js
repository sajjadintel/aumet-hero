'use strict';
// Class definition

var KTDatatableMyProducts = (function() {

	// Private functions
	var _init = function() {
		var datatable = $('#kt_datatableMyProducts').KTDatatable({
			data: {
				type: 'remote',
				source: {
					read: {
						url: HOST_URL + '/' + docLang + '/myproducts/list' + '?_t=' + Date.now()
					}
				},
				pageSize: 10,
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
					field: 'id',
					title: 'id',
					sortable: 'asc',
					width: 40,
					type: 'number',
					selector: false,
					textAlign: 'left',
					template: function(row) {
						return row.id;
					}
				},
				{
					field: 'image',
					title: 'Image',
					width: 100,
					autoHide: false,
					template: function(row) {

						var product_img = '';
						if (row.image === '' || row.image === null){
							product_img = '/assets/img/company.svg';
						}else{							
							product_img = row.image;
						}

						var backgroundImage = 'background-image:url(' + product_img + ');background-repeat: no-repeat; background-position: center; background-size: cover;';
						var output = '';
						
						output = '<div class="d-flex align-items-center">\
									<div class="symbol symbol-60 flex-shrink-0">\
										<div class="symbol-label" style="' + backgroundImage + '"></div>\
									</div>\
								</div>';		


						return output;
					},
				},
				{
					field: 'title',
					title: 'Product',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.title;
					}
				},
				{
					field: 'specialityName',
					title: 'Speciality',
					sortable: true,
					autoHide: false,
					template: function(row) {

						return row.specialityName;
					}
				},
				{
					field: 'medicalLineName',
					title: 'Medical Line',
					sortable: true,
					autoHide: false,
					template: function(row) {
						return row.medicalLineName;
					}
				},
				/*{
					field: 'visitors',
					title: 'Number of visitors',
					sortable: true,
					type: 'number'
				},
				{
					field: 'inquiries',
					title: 'Received Inquiries'
					// template: function(row) {
					// 	return row.inquiries;
					// }
				},*/
				{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 250,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return (
							'<a href="javascript:;" class="btn btn-primary mr-5" title="Edit Product" onclick="KTDatatableMyProducts.editProduct('+ row.id +')">Edit Product</a>' +
							'<a href="javascript:;" class="btn btn-outline-primary" title="View Product" onclick="KTDatatableMyProducts.viewProduct('+ row.id +')">View Product</a>'
						);
					}
				}
			]
		});

	};


	var _editProduct = function(_id) {
		WebApp.loadPage('myproducts/' + _id + '/edit' );
	}

	var _viewProduct = function(_id) {
		WebApp.loadPage('myproducts/' + _id );
	}

	return {
		// Public functions
		init: function() {
			_init();
		},
		editProduct: function(_id) {
			_editProduct(_id);
		},
		viewProduct: function(_id) {
			_viewProduct(_id);
		},
	};
})();



jQuery(document).ready(function() {
	KTDatatableMyProducts.init();

	$(document).on('click', '#add-product', function(e) {
		e.preventDefault();
		WebApp.loadPage('myproducts/add');
	});

	$(document).on('click', '#save-product', function(e) {
		e.preventDefault();
		WebApp.postForm('#frmProductForm', 'myproducts/add-product', fnCallbackSave);
		addProduct();
	});
});
