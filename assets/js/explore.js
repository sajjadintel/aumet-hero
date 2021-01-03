jQuery(document).ready(function() {

    var fnSectionContainerLoadCallback = function (webResponse){

    }

    $('.sectionContainer').each(function () {
        var sectionId = $(this).data('sectionid');

        WebApp.loadPartialPage('#sectionContainer'+sectionId,'explore/section/speciality/'+sectionId+'/products', fnSectionContainerLoadCallback)
    })
});