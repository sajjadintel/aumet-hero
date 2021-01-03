'use strict';

var KTDatatableMyInterests = function() {
    // Private functions
    var _init = function() {
        var datatable = $('#kt_datatable').KTDatatable({
            processing: true,
            "language": {
                "processing": "Please wait for the response..."
            },
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/'+docLang +'/myinterests/data',
                        // sample custom headers
                        // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        map: function(raw) {
                            // sample data mapping
                            var dataSet = raw;

                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    },
                },
                serverPaging: false,
                serverFiltering: true,
                serverSorting: false,
                pageSize: 10,
                saveState: false
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                // height: 450, // datatable's body's fixed height
                footer: false, // display/hide footer
            },

            // column sorting
            sortable: true,
            pagination: true,
            search: {},
            // columns definition
            columns: [
                {
                    field: 'scientificName',
                    title: 'Interested In',
                    sortable: false,
                    autoHide: false,
                    template: function(row) {
                        if(row.scientificNameImage) {
                            return '<div class="d-flex align-items-center"><div class="symbol symbol-50 symbol-light mr-4">' +
                                '<span class="symbol-label"><img src="'+row.scientificNameImage+'" class="h-75 align-self-end"></span></div>' +
                                '<div><a href="javascript:;" class="text-dark font-weight-bolder text-hover-primary font-size-lg">'+row.scientificName+'</a></div></div>';

                        }
                        else {
                            return '<div class="d-flex align-items-center"><div class="symbol symbol-50 symbol-light mr-4">' +
                                '<span class="symbol-label"><img src="'+row.specialityImage+'" class="h-75 align-self-end"></span></div>' +
                                '<div><a href="javascript:;" class="text-dark font-weight-bolder text-hover-primary font-size-lg">All Products</a></div></div>';
                        }
                    }
            },
                {
                field: 'specialityName',
                autoHide: false,
                title: 'Specialty'
            }, {
                field: 'medicalLineName',
                title: 'Medical Line',
                autoHide: false
            }, {
                field: 'addedOn',
                title: 'Added On',
                autoHide: false,
                template: function(row) {
                    return moment(row.addedOn).format('d/mm/yyyy')
                }
            }, {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 250,

                autoHide: false,
                template: function(row) {
                    return '<a href="javascript:;" class="btn btn-sm btn-icon btn-icon-primary" title="Remove"><i id="'+row.id+'" class="flaticon-cancel remove-item"></i></a>\
                    <a href="javascript:;" class="btn btn-sm btn-icon btn-icon-primary" title="Edit" onclick="WebApp.loadPage(\'myinterests/edit-list/'+row.id+'\')"><i class="flaticon2-pen"></i></a>\
							<a href="javascript:;" class="btn btn-sm btn-primary" title="View" onclick="WebApp.loadPage(\'myinterests/edit-list/'+row.id+'\')">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                            <rect x="0" y="0" width="24" height="24"/>\
                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>\
                                            <path d="M10.5,10.5 L10.5,9.5 C10.5,9.22385763 10.7238576,9 11,9 C11.2761424,9 11.5,9.22385763 11.5,9.5 L11.5,10.5 L12.5,10.5 C12.7761424,10.5 13,10.7238576 13,11 C13,11.2761424 12.7761424,11.5 12.5,11.5 L11.5,11.5 L11.5,12.5 C11.5,12.7761424 11.2761424,13 11,13 C10.7238576,13 10.5,12.7761424 10.5,12.5 L10.5,11.5 L9.5,11.5 C9.22385763,11.5 9,11.2761424 9,11 C9,10.7238576 9.22385763,10.5 9.5,10.5 L10.5,10.5 Z" fill="#000000" opacity="0.3"/>\
                                        </g>\
                                    </svg>\
	                            </span>\
							View Products</a>\
						';
                },
            }],
        });

        $('#kt_search').on('click', function(e) {
			e.preventDefault();
			var params = {};
			$('.datatable-input').each(function() {
				var i = $(this).data('col-index');
				if (params[i]) {
					params[$(this).attr('id').split('_').reverse()[0]] += '|' + $(this).val();
				}
				else {
					params[$(this).attr('id').split('_').reverse()[0]] = $(this).val();
				}
            });            
            datatable.search(params,'filter');
            $('#kt_reset').show();
        });
        $('#kt_reset').on('click', function(e) {
			e.preventDefault();
            var params = {};
            datatable.search(params,'filter');       
            $('#kt_reset').hide();
		});
        $('#kt_datatable_search_addedOn, #kt_daterangepicker_1_modal').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',
            locale: {
                format: 'Y-M-D'
            }
        });

        $(document).on('click', '.remove-item', function(e) {
            //e.preventDefault();
            var ID = $(this).attr('id');
            Swal.fire({
                title: "Are you sure?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              }).then(function(isConfirm) {
                if (isConfirm) {
                    WebApp.get('myinterests/deattach-product/'+ID, function getResponse(res) {
                            if(res.errorCode==0) {
                                WebApp.alertSuccess(res.message);
                                datatable.reload();
                            }
                    });
                }
              });
		});
    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            _init();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableMyInterests.init();
    $('#kt_reset').hide();
    $('#kt_datatable_search_medicalLine').select2();
    $('#kt_datatable_specialityId').select2();
});