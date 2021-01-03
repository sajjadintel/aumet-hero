'use strict';
// Class definition

var KTDatatableChildRemoteDataDemo = function() {
    // Private functions

    // demo initializer
    var demo = function() {

        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: HOST_URL + '/api/datatables/demos/customers.php',
                    },
                },
                pageSize: 10, // display 20 records per page
                serverPaging: true,
                serverFiltering: false,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false,
                footer: false,
            },

            // column sorting
            sortable: true,

            pagination: true,

            detail: {
                title: 'Load sub table',
                content: subTableInit,
            },

            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },

            // columns definition
            columns: [
                {
                    field: 'RecordID',
                    title: '',
                    sortable: false,
                    width: 30,
                    textAlign: 'center',
                }, {
                    field: 'checkbox',
                    title: '',
                    template: '{{RecordID}}',
                    sortable: false,
                    width: 20,
                    textAlign: 'center',
                    selector: {class: 'kt-checkbox--solid'},
                }, {
                    field: 'FirstName',
                    title: 'First Name',
                    sortable: 'asc',
                }, {
                    field: 'LastName',
                    title: 'Last Name',
                }, {
                    field: 'Company',
                    title: 'Company',
                }, {
                    field: 'Email',
                    title: 'Email',
                }, {
                    field: 'Address',
                    title: 'Address',
                }, {
                    field: 'Status',
                    title: 'Status',
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {'title': 'Pending', 'class': 'label-light-primary'},
                            2: {'title': 'Delivered', 'class': ' label-light-danger'},
                            3: {'title': 'Canceled', 'class': ' label-light-primary'},
                            4: {'title': 'Success', 'class': ' label-light-success'},
                            5: {'title': 'Info', 'class': ' label-light-info'},
                            6: {'title': 'Danger', 'class': ' label-light-danger'},
                            7: {'title': 'Warning', 'class': ' label-light-warning'},
                        };
                        return '<span class="label ' + status[row.Status].class + ' label-inline font-weight-bold label-lg">' + status[row.Status].title + '</span>';
                    },
                }, {
                    field: 'Type',
                    title: 'Type',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {'title': 'Online', 'state': 'danger'},
                            2: {'title': 'Retail', 'state': 'primary'},
                            3: {'title': 'Direct', 'state': 'success'},
                        };
                        return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.Type].state +
                            '">' +
                            status[row.Type].title + '</span>';
                    },
                }, {
                    field: 'Actions',
                    width: 125,
                    title: 'Actions',
                    sortable: false,
                    overflow: 'visible',
                    autoHide: false,
                    template: function() {
                        return '\
	                        <div class="dropdown dropdown-inline">\
	                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">\
	                                <span class="svg-icon svg-icon-md">\
	                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                            <rect x="0" y="0" width="24" height="24"/>\
	                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>\
	                                        </g>\
	                                    </svg>\
	                                </span>\
	                            </a>\
	                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
	                                <ul class="navi flex-column navi-hover py-2">\
	                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">\
	                                        Choose an action:\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-print"></i></span>\
	                                            <span class="navi-text">Print</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-copy"></i></span>\
	                                            <span class="navi-text">Copy</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-excel-o"></i></span>\
	                                            <span class="navi-text">Excel</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-text-o"></i></span>\
	                                            <span class="navi-text">CSV</span>\
	                                        </a>\
	                                    </li>\
	                                    <li class="navi-item">\
	                                        <a href="#" class="navi-link">\
	                                            <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>\
	                                            <span class="navi-text">PDF</span>\
	                                        </a>\
	                                    </li>\
	                                </ul>\
	                            </div>\
	                        </div>\
	                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                        <rect x="0" y="0" width="24" height="24"/>\
	                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
	                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
	                                    </g>\
	                                </svg>\
	                            </span>\
	                        </a>\
	                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
	                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
	                                        <rect x="0" y="0" width="24" height="24"/>\
	                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
	                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
	                                    </g>\
	                                </svg>\
	                            </span>\
	                        </a>\
	                    ';
                    },
                }],
        });

        $('#kt_datatable_search_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });

        $('#kt_datatable_search_type').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Type');
        });

        $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();


        function subTableInit(e) {
            $('<div/>').attr('id', 'child_data_ajax_' + e.data.RecordID).appendTo(e.detailCell).KTDatatable({
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: HOST_URL + '/api/datatables/demos/orders.php',
                            params: {
                                // custom query params
                                query: {
                                    generalSearch: '',
                                    CustomerID: e.data.RecordID,
                                },
                            },
                        },
                    },
                    pageSize: 5,
                    serverPaging: true,
                    serverFiltering: false,
                    serverSorting: true,
                },

                // layout definition
                layout: {
                    scroll: false,
                    footer: false,

                    // enable/disable datatable spinner.
                    spinner: {
                        type: 1,
                        theme: 'default',
                    },
                },

                sortable: true,

                // columns definition
                columns: [
                    {
                        field: 'RecordID',
                        title: '#',
                        sortable: false,
                        width: 30,
                    }, {
                        field: 'OrderID',
                        title: 'Order ID',
                        template: function(row) {
                            return '<span>' + row.OrderID + ' - ' + row.ShipCountry + '</span>';
                        },
                    }, {
                        field: 'ShipCountry',
                        title: 'Country',
                        width: 100
                    }, {
                        field: 'ShipAddress',
                        title: 'Ship Address',
                    }, {
                        field: 'ShipName',
                        title: 'Ship Name',
                    }, {
                        field: 'TotalPayment',
                        title: 'Payment',
                        type: 'number',
                    }, {
                        field: 'Status',
                        title: 'Status',
                        // callback function support for column rendering
                        template: function(row) {
                            var status = {
                                1: {'title': 'Pending', 'class': 'label-light-primary'},
                                2: {'title': 'Delivered', 'class': ' label-light-danger'},
                                3: {'title': 'Canceled', 'class': ' label-light-primary'},
                                4: {'title': 'Success', 'class': ' label-light-success'},
                                5: {'title': 'Info', 'class': ' label-light-info'},
                                6: {'title': 'Danger', 'class': ' label-light-danger'},
                                7: {'title': 'Warning', 'class': ' label-light-warning'},
                            };
                            return '<span class="label ' + status[row.Status].class + ' label-inline label-bold">' + status[row.Status].title + '</span>';
                        },
                    }, {
                        field: 'Type',
                        title: 'Type',
                        autoHide: false,
                        // callback function support for column rendering
                        template: function(row) {
                            var status = {
                                1: {'title': 'Online', 'state': 'danger'},
                                2: {'title': 'Retail', 'state': 'primary'},
                                3: {'title': 'Direct', 'state': 'success'},
                            };
                            return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' +
                                status[row.Type].state + '">' +
                                status[row.Type].title + '</span>';
                        },
                    }],
            });
        }
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
    //KTDatatableChildRemoteDataDemo.init();
});

var KTDatatableMySalesNetwork = function() {
    // Private functions
    var _init = function() {
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: '/en/potentialdistributors/targetedcountries',
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
                serverFiltering: false,
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
            // columns definition
            columns: [{
                field: 'RegionName',
                autoHide: false,
                title: 'Region'
            }, {
                field: 'CountryName',
                title: 'Country',
                autoHide: false,
                type: 'number'
            }, {
                field: 'DistributorsCount',
                title: 'Potential Distributors',
                autoHide: false,
                type: 'number'
            }, {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 250,

                autoHide: false,
                template: function(row) {
                    return '<a href="javascript:;" class="btn btn-sm btn-outline-primary " title="Remove" onclick="WebApp.loadPage(\'potentialdistributors/country/'+row.CountryId+'\')">Remove</a>\
							<a href="javascript:;" class="btn btn-sm btn-primary" title="View" onclick="WebApp.loadPage(\'potentialdistributors/country/'+row.CountryId+'\')">\
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
							View Distributors</a>\
						';
                },
            }],
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
    KTDatatableMySalesNetwork.init();
});