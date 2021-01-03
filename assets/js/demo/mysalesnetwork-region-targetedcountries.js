'use strict';
// Class definition

var KTDatatableMySalesNetworkRegion = function() {
    // Private functions

    // demo initializer
    var demo = function() {

        let dataJSONArray = [
            {id: 1, country: "Germany", pDistributors: 5, inquiries: 0, visitors: 0, flag: "/theme/assets/media/svg/flags/017-germany.svg"},

        ];
        var datatable = $('#kt_datatable').KTDatatable({
            // datasource definition
            data: {
                type: 'local',
                source: dataJSONArray,
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
                field: 'id',
                title: '#',
                sortable: false,
                width: 20,
                type: 'number',
                textAlign: 'center',
            }, {
                field: 'country',
                title: 'Country',
                template: function(row) {
                    return '<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">' +
                    '<div class="symbol symbol-25 mr-3">' +
                        '<img alt="Pic" src="'+row.flag+'">' +
                        '</div>'+ row.country +'</a>';
                },
            }, {
                field: 'pDistributors',
                title: 'Existing Distributors',
                type: 'number'
            }, {
                field: 'inquiries',
                title: 'Received Inquiries',
                type: 'number'
            }, {
                field: 'visitors',
                title: 'Number of Visitors',
                type: 'number'
            }, {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                overflow: 'visible',
                autoHide: false,
                template: function(row) {
                    return '<a href="javascript:;" class="btn btn-sm btn-primary" title="View" onclick="WebApp.loadPage(\'mysalesnetwork/region/'+_regionId+'/country/'+row.id+'\')">\
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
							View</a>\
						';
                },
            }],
        });
    };

    var demo_suggestedCountries = function() {

        let dataJSONArray = [
            {id: 1, country: "Germany", pDistributors: 5, inquiries: 0, visitors: 0, flag: "/theme/assets/media/svg/flags/017-germany.svg"},

        ];
        var datatable = $('#kt_datatable_suggested').KTDatatable({
            // datasource definition
            data: {
                type: 'local',
                source: dataJSONArray,
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
                field: 'id',
                title: '#',
                sortable: false,
                width: 20,
                type: 'number',
                textAlign: 'center',
            }, {
                field: 'country',
                title: 'Country',
                template: function(row) {
                    return '<a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3 mb-5">' +
                        '<div class="symbol symbol-25 mr-3">' +
                        '<img alt="Pic" src="'+row.flag+'">' +
                        '</div>'+ row.country +'</a>';
                },
            }, {
                field: 'pDistributors',
                title: 'Existing Distributors',
                type: 'number'
            }, {
                field: 'inquiries',
                title: 'Received Inquiries',
                type: 'number'
            }, {
                field: 'visitors',
                title: 'Number of Visitors',
                type: 'number'
            }, {
                field: 'Actions',
                title: 'Actions',
                sortable: false,
                width: 125,
                overflow: 'visible',
                autoHide: false,
                template: function(row) {
                    return '<a href="javascript:;" class="btn btn-sm btn-primary" title="Add" onclick="">\
	                            <span class="svg-icon svg-icon-md">\
	                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
        <polygon points="0 0 24 0 24 24 0 24"/>\
        <path d="M8.2928955,3.20710089 C7.90237121,2.8165766 7.90237121,2.18341162 8.2928955,1.79288733 C8.6834198,1.40236304 9.31658478,1.40236304 9.70710907,1.79288733 L15.7071091,7.79288733 C16.085688,8.17146626 16.0989336,8.7810527 15.7371564,9.17571874 L10.2371564,15.1757187 C9.86396402,15.5828377 9.23139665,15.6103407 8.82427766,15.2371482 C8.41715867,14.8639558 8.38965574,14.2313885 8.76284815,13.8242695 L13.6158645,8.53006986 L8.2928955,3.20710089 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000003, 8.499997) scale(-1, -1) rotate(-90.000000) translate(-12.000003, -8.499997) "/>\
        <path d="M6.70710678,19.2071045 C6.31658249,19.5976288 5.68341751,19.5976288 5.29289322,19.2071045 C4.90236893,18.8165802 4.90236893,18.1834152 5.29289322,17.7928909 L11.2928932,11.7928909 C11.6714722,11.414312 12.2810586,11.4010664 12.6757246,11.7628436 L18.6757246,17.2628436 C19.0828436,17.636036 19.1103465,18.2686034 18.7371541,18.6757223 C18.3639617,19.0828413 17.7313944,19.1103443 17.3242754,18.7371519 L12.0300757,13.8841355 L6.70710678,19.2071045 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(12.000003, 15.499997) scale(-1, -1) rotate(-360.000000) translate(-12.000003, -15.499997) "/>\
    </g>\
</svg>\
	                            </span>\
							Add Country</a>\
						';
                },
            }],
        });
    };

    return {
        // Public functions
        init: function() {
            // init dmeo
            demo();
            demo_suggestedCountries();
        },
    };
}();

jQuery(document).ready(function() {
    KTDatatableMySalesNetworkRegion.init();
});