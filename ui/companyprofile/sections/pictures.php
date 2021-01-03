<div class="card card-custom card-stretch" >
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Pictures</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Manage your company photo gallery</span>
            </div>
            <div class="card-toolbar">
                <button type="button" onclick="WebApp.loadPage('mycompanyprofile')" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Photo Gallery</label>
                        <div class="col-12" id="companyEditorPhotoGalleryContainer">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <label class="col-form-label col-12 font-size-h4 font-weight-bolder mb-6">Upload Photos</label>
                        <div class="col-12">
                            <div class="dropzone dropzone-multi" id="companyEditorPhotoGallery" style="min-height: auto !important">
                                <div class="dropzone-panel mb-lg-0 mb-3">
                                    <a class="dropzone-select btn btn-outline-primary font-weight-bold mr-5">Attach files</a>
                                    <a class="dropzone-upload btn btn-primary font-weight-bold mr-5">Upload All</a>
                                    <a class="dropzone-remove-all btn btn-light font-weight-bold">Remove All</a>
                                </div>
                                <div class="dropzone-items">
                                    <div class="dropzone-item" style="display:none">
                                        <div class="dropzone-file">
                                            <div class="dropzone-filename" title="some_image_file_name.jpg">
                                                <span data-dz-name="">some_image_file_name.jpg</span>
                                                <strong>(
                                                    <span data-dz-size="">340kb</span>)</strong>
                                            </div>
                                            <div class="dropzone-error" data-dz-errormessage=""></div>
                                        </div>
                                        <div class="dropzone-progress">
                                            <div class="progress">
                                                <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                            </div>
                                        </div>
                                        <div class="dropzone-toolbar">
                                                        <span class="dropzone-start">
                                                            <i class="flaticon2-arrow"></i>
                                                        </span>
                                            <span class="dropzone-cancel" data-dz-remove="" style="display: none;">
                                                            <i class="flaticon2-cross"></i>
                                                        </span>
                                            <span class="dropzone-delete" data-dz-remove="">
                                                            <i class="flaticon2-cross"></i>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    if (typeof CompanyPhotoEditor === 'undefined') {

        let companyEditorPhotoGallery = null;

        // Class definition
        let CompanyPhotoEditor = function() {

            var _initPhotoGallery = function () {
                WebApp.loadPartialPage('#companyEditorPhotoGalleryContainer', 'mycompanyprofile/edit/pictures/list' );

                // set the dropzone container id
                var id = '#companyEditorPhotoGallery';

                // set the preview element template
                var previewNode = $(id + " .dropzone-item");
                previewNode.id = "";
                var previewTemplate = previewNode.parent('.dropzone-items').html();
                previewNode.remove();

                companyEditorPhotoGallery = new Dropzone(id, { // Make the whole body a dropzone
                    url: '/en/mycompanyprofile/edit/pictures/upload', // Set the url for your upload script location
                    parallelUploads: 20,
                    previewTemplate: previewTemplate,
                    maxFilesize: 100, // Max filesize in MB
                    autoQueue: true, // Make sure the files aren't queued until manually added
                    autoProcessQueue: true,
                    previewsContainer: id + " .dropzone-items", // Define the container to display the previews
                    clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.

                });

                companyEditorPhotoGallery.on("addedfile", function(file) {
                    // Hookup the start button
                    file.previewElement.querySelector(id + " .dropzone-start").onclick = function() { companyEditorPhotoGallery.enqueueFile(file); };
                    $(document).find( id + ' .dropzone-item').css('display', '');
                });

                // Update the total progress bar
                companyEditorPhotoGallery.on("totaluploadprogress", function(progress) {
                    $(this).find( id + " .progress-bar").css('width', progress + "%");
                });

                companyEditorPhotoGallery.on("sending", function(file) {
                    // Show the total progress bar when upload starts
                    $( id + " .progress-bar").css('opacity', '1');
                    // And disable the start button
                    file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
                });

                // Hide the total progress bar when nothing's uploading anymore
                companyEditorPhotoGallery.on("complete", function(progress) {
                    var thisProgressBar = id + " .dz-complete";
                    setTimeout(function(){
                        $( thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
                    }, 300)

                });

                // Setup the buttons for all transfers
                document.querySelector( id + " .dropzone-upload").onclick = function() {
                    companyEditorPhotoGallery.enqueueFiles(companyEditorPhotoGallery.getFilesWithStatus(Dropzone.ADDED));
                };

                // Setup the button for remove all files
                document.querySelector(id + " .dropzone-remove-all").onclick = function() {
                    $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
                    companyEditorPhotoGallery.removeAllFiles(true);
                };

                // On all files completed upload
                companyEditorPhotoGallery.on("queuecomplete", function(progress){
                    $( id + " .dropzone-upload").css('display', 'none');
                    WebApp.loadPartialPage('#companyEditorPhotoGalleryContainer', 'mycompanyprofile/edit/pictures/list' );
                    companyEditorPhotoGallery.removeAllFiles(true);

                });

                // On all files removed
                companyEditorPhotoGallery.on("removedfile", function(file){
                    if(companyEditorPhotoGallery.files.length < 1){
                        $( id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
                    }
                });

            }


            return {
                // public functions
                init: function() {
                    _initPhotoGallery();
                }
            };
        }();

        CompanyPhotoEditor.init();
    }
    else {

        companyEditorPhotoGallery = null;

        CompanyPhotoEditor.init();
    }
</script>