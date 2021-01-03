<form class="form" id="frmBusinessInfo">
    <div class="card card-custom card-stretch">
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Documents & Catalogs</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your documents and catalogs</span>
            </div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    <button type="button" onclick="WebApp.loadPage('mycompanyprofile')" class="btn btn-secondary">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">

                <label class="col-3 col-form-label font-size-h6">Company Profile</label>
                <div class="col-9">
                    <div class="dropzone dropzone-multi" id="dropzone_CompanyProfile" style="min-height: auto !important;">
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a class="dropzone-select btn btn-primary font-weight-bold btn-sm">Attach Files</a>
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
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropzone dropzone-multi" style="min-height: auto !important;">
                    <div class="dropzone-items">
                        <?php foreach ($arrCompanyProfiles as $objFile): ?>
                            <div class="dropzone-item" style="">
                                <div class="dropzone-file">
                                    <div class="dropzone-filename" title="<?php echo $objFile->description ?>">
                                        <span data-dz-name=""><a target="_blank" href="<?php echo $objFile->Link ?>"><?php echo $objFile->description == "" ? "Open Document" : $objFile->description ?></a></span>
                                    </div>
                                    <div class="dropzone-error" data-dz-errormessage=""></div>
                                </div>
                                <div class="dropzone-progress">
                                    <div class="progress" style="opacity: 0;">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress="" style="opacity: 0; width: 100%;"></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross removefile" id="<?php echo $objFile->Id; ?>"></i>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-3 col-form-label font-size-h6">Registration Documents</label>
                <div class="col-9">
                    <div class="dropzone dropzone-multi" id="dropzone_RegistrationDocuments" style="min-height: auto !important;">
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a class="dropzone-select btn btn-primary font-weight-bold btn-sm">Attach Files</a>
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
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropzone dropzone-multi" style="min-height: auto !important;">
                        <div class="dropzone-items">
                            <?php foreach ($arrCompanyRegistrationDocuments as $objFile): ?>
                                <div class="dropzone-item" style="">
                                    <div class="dropzone-file">
                                        <div class="dropzone-filename" title="<?php echo $objFile->description ?>">
                                            <span data-dz-name=""><a target="_blank" href="<?php echo $objFile->Link ?>"><?php echo $objFile->description == "" ? "Open Document" : $objFile->description ?></a></span>
                                        </div>
                                        <div class="dropzone-error" data-dz-errormessage=""></div>
                                    </div>
                                    <div class="dropzone-progress">
                                        <div class="progress" style="opacity: 0;">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress="" style="opacity: 0; width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross removefile" id="<?php echo $objFile->Id; ?>"></i>
                                    </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">

                <label class="col-3 col-form-label font-size-h6">Other Documents</label>
                <div class="col-9">
                    <div class="dropzone dropzone-multi" id="dropzone_OtherDocuments" style="min-height: auto !important;">
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a class="dropzone-select btn btn-primary font-weight-bold btn-sm">Attach Files</a>
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
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropzone dropzone-multi" style="min-height: auto !important;">
                        <div class="dropzone-items">
                            <?php foreach ($arrCompanyOtherDocuments as $objFile): ?>
                                <div class="dropzone-item" style="">
                                    <div class="dropzone-file">
                                        <div class="dropzone-filename" title="<?php echo $objFile->description ?>">
                                            <span data-dz-name=""><a target="_blank" href="<?php echo $objFile->Link ?>"><?php echo $objFile->description == "" ? "Open Document" : $objFile->description ?></a></span>
                                        </div>
                                        <div class="dropzone-error" data-dz-errormessage=""></div>
                                    </div>
                                    <div class="dropzone-progress">
                                        <div class="progress" style="opacity: 0;">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress="" style="opacity: 0; width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross removefile" id="<?php echo $objFile->Id; ?>"></i>
                                    </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="offset-3 col col-form-label text-dark font-size-h3">Catalogs</label>
            </div>
            <div class="form-group row">

                <label class="col-3 col-form-label font-size-h6">Catalogs</label>
                <div class="col-9">
                    <div class="dropzone dropzone-multi" id="dropzone_Catalogs" style="min-height: auto !important;">
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a class="dropzone-select btn btn-primary font-weight-bold btn-sm">Attach Files</a>
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
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropzone dropzone-multi" style="min-height: auto !important;">
                    <div class="dropzone-items">
                        <?php foreach ($arrCompanyCatalogs as $objFile): ?>
                            <div class="dropzone-item" style="">
                                <div class="dropzone-file">
                                    <div class="dropzone-filename" title="<?php echo $objFile->description ?>">
                                        <span data-dz-name=""><a target="_blank" href="<?php echo $objFile->Link ?>"><?php echo $objFile->description == "" ? "Open Document" : $objFile->description ?></a></span>
                                    </div>
                                    <div class="dropzone-error" data-dz-errormessage=""></div>
                                </div>
                                <div class="dropzone-progress">
                                    <div class="progress" style="opacity: 0;">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress="" style="opacity: 0; width: 100%;"></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                    <i class="flaticon2-cross removefile" id="<?php echo $objFile->Id; ?>"></i>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-3 col-form-label font-size-h6">Marketing Materials</label>
                <div class="col-9">
                    <div class="dropzone dropzone-multi" id="dropzone_MarketingDocuments" style="min-height: auto !important;">
                        <div class="dropzone-panel mb-lg-0 mb-2">
                            <a class="dropzone-select btn btn-primary font-weight-bold btn-sm">Attach Files</a>
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
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                             aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress=""></div>
                                    </div>
                                </div>
                                <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropzone dropzone-multi" style="min-height: auto !important;">
                        <div class="dropzone-items">
                            <?php foreach ($arrCompanyMaketingMaterials as $objFile): ?>
                                <div class="dropzone-item" style="">
                                    <div class="dropzone-file">
                                        <div class="dropzone-filename" title="<?php echo $objFile->description ?>">
                                            <span data-dz-name=""><a target="_blank" href="<?php echo $objFile->Link ?>"><?php echo $objFile->description == "" ? "Open Document" : $objFile->description ?></a></span>
                                        </div>
                                        <div class="dropzone-error" data-dz-errormessage=""></div>
                                    </div>
                                    <div class="dropzone-progress">
                                        <div class="progress" style="opacity: 0;">
                                            <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress="" style="opacity: 0; width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="dropzone-toolbar">
                                    <span class="dropzone-delete" data-dz-remove="">
                                        <i class="flaticon2-cross removefile" id="<?php echo $objFile->Id; ?>"></i>
                                    </span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    var KTDropzoneCompanyProfile = {
        init: function () {
            var e = "#dropzone_CompanyProfile", o = $(e + " .dropzone-item");
            o.id = "";
            var n = o.parent(".dropzone-items").html();
            o.remove();
            var t = new Dropzone(e, {
                url: "/en/mycompanyprofile/edit/documents/8/upload",
                parallelUploads: 20,
                maxFilesize: 100,
                previewTemplate: n,
                previewsContainer: e + " .dropzone-items",
                clickable: e + " .dropzone-select"
            });

            t.on("addedfile", (function (o) {
                $(document).find(e + " .dropzone-item").css("display", "")
            }));

            t.on("totaluploadprogress", (function (o) {
                $(e + " .progress-bar").css("width", o + "%")
            }));

            t.on("sending", (function (o) {
                $(e + " .progress-bar").css("opacity", "1")
            }));

            t.on("complete", (function (o) {
                var n = e + " .dz-complete";
                setTimeout((function () {
                    $(n + " .progress-bar, " + n + " .progress").css("opacity", "0")
                }), 300)
            }));
        }
    };

    var KTDropzoneCompanyRegDocs = {
        init: function () {
            var e = "#dropzone_RegistrationDocuments", o = $(e + " .dropzone-item");
            o.id = "";
            var n = o.parent(".dropzone-items").html();
            o.remove();
            var t = new Dropzone(e, {
                url: "/en/mycompanyprofile/edit/documents/5/upload",
                parallelUploads: 20,
                maxFilesize: 100,
                previewTemplate: n,
                previewsContainer: e + " .dropzone-items",
                clickable: e + " .dropzone-select"
            });

            t.on("addedfile", (function (o) {
                $(document).find(e + " .dropzone-item").css("display", "")
            }));

            t.on("totaluploadprogress", (function (o) {
                $(e + " .progress-bar").css("width", o + "%")
            }));

            t.on("sending", (function (o) {
                $(e + " .progress-bar").css("opacity", "1")
            }));

            t.on("complete", (function (o) {
                var n = e + " .dz-complete";
                setTimeout((function () {
                    $(n + " .progress-bar, " + n + " .progress").css("opacity", "0")
                }), 300)
            }));
        }
    };

    var KTDropzoneCompanyOtherDocs = {
        init: function () {
            var e = "#dropzone_OtherDocuments", o = $(e + " .dropzone-item");
            o.id = "";
            var n = o.parent(".dropzone-items").html();
            o.remove();
            var t = new Dropzone(e, {
                url: "/en/mycompanyprofile/edit/documents/90/upload",
                parallelUploads: 20,
                maxFilesize: 100,
                previewTemplate: n,
                previewsContainer: e + " .dropzone-items",
                clickable: e + " .dropzone-select"
            });

            t.on("addedfile", (function (o) {
                $(document).find(e + " .dropzone-item").css("display", "")
            }));

            t.on("totaluploadprogress", (function (o) {
                $(e + " .progress-bar").css("width", o + "%")
            }));

            t.on("sending", (function (o) {
                $(e + " .progress-bar").css("opacity", "1")
            }));

            t.on("complete", (function (o) {
                var n = e + " .dz-complete";
                setTimeout((function () {
                    $(n + " .progress-bar, " + n + " .progress").css("opacity", "0")
                }), 300)
            }));
        }
    };

    var KTDropzoneCompanyCatalogs = {
        init: function () {
            var e = "#dropzone_Catalogs", o = $(e + " .dropzone-item");
            o.id = "";
            var n = o.parent(".dropzone-items").html();
            o.remove();
            var t = new Dropzone(e, {
                url: "/en/mycompanyprofile/edit/documents/91/upload",
                parallelUploads: 20,
                maxFilesize: 100,
                previewTemplate: n,
                previewsContainer: e + " .dropzone-items",
                clickable: e + " .dropzone-select"                
            });

            t.on("addedfile", (function (o) {
                $(document).find(e + " .dropzone-item").css("display", "")
            }));

            t.on("totaluploadprogress", (function (o) {
                $(e + " .progress-bar").css("width", o + "%")
            }));

            t.on("sending", (function (o) {
                $(e + " .progress-bar").css("opacity", "1")
            }));

            t.on("complete", (function (o) {
                var n = e + " .dz-complete";
                setTimeout((function () {
                    $(n + " .progress-bar, " + n + " .progress").css("opacity", "0")
                }), 300)
            }));
        }
    };

    var KTDropzoneCompanyMaketingMaterials = {
        init: function () {
            var e = "#dropzone_MarketingDocuments", o = $(e + " .dropzone-item");
            o.id = "";
            var n = o.parent(".dropzone-items").html();
            o.remove();
            var t = new Dropzone(e, {
                url: "/en/mycompanyprofile/edit/documents/92/upload",
                parallelUploads: 20,
                maxFilesize: 100,
                previewTemplate: n,
                previewsContainer: e + " .dropzone-items",
                clickable: e + " .dropzone-select"
            });

            t.on("addedfile", (function (o) {
                $(document).find(e + " .dropzone-item").css("display", "")
            }));

            t.on("totaluploadprogress", (function (o) {
                $(e + " .progress-bar").css("width", o + "%")
            }));

            t.on("sending", (function (o) {
                $(e + " .progress-bar").css("opacity", "1")
            }));

            t.on("complete", (function (o) {
                var n = e + " .dz-complete";
                setTimeout((function () {
                    $(n + " .progress-bar, " + n + " .progress").css("opacity", "0")
                }), 300)
            }));
        }
    };

    KTUtil.ready((function () {
        KTDropzoneCompanyProfile.init();
        KTDropzoneCompanyRegDocs.init();
        KTDropzoneCompanyOtherDocs.init();
        KTDropzoneCompanyCatalogs.init();
        KTDropzoneCompanyMaketingMaterials.init();
        $('body').on('click', '.removefile', function(event) {               
            WebApp.get('mycompanyprofile/edit/documents/'+$(this).attr('id')+'/remove', function getResponse(res) {
                if(res.errorCode==0) {
                    WebApp.loadPartialPage('#profileEditWorkspace', 'mycompanyprofile/edit/documents')
                }
            });                
        }); 
    }));   
</script>