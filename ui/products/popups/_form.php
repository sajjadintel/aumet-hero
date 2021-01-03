<!--begin::Row-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">Add a Product</h3>
                </div>
            </div>
            <!--begin::Form-->
            <!-- <form method="POST" id="frmProductForm"> -->
            <form method="POST" enctype="multipart/form-data" class="dropzone" style="border:0" action="myproducts/add-product" id="postaddproduct">

                <div class="card-body">
                    <div class="form-group">
                        <div class="dropzone dropzone-multi">
                            <label>Upload Image:</label>
                            <div class="form-group row p-5">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card card-custom gutter-b card-stretch">
                                        <div class="container" style="display: flex;">
                                            <div style="float:left; padding-top:3px; padding-left:5px; margin:8px;">
                                                <label class="mt-radio">Main image</label>
                                            </div>                                           
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="image-input image-input-outline">
                                                    <input type="file" id="image_part1" name="main_image" style="position: absolute; z-index:-1;" class="image_upload" accept=".jpg, .jpeg, .png">
                                                    <label for="image_part1" class='image-input-wrapper' style="background-image:url(/assets/img/products/unnamed.jpg)"></label>
                                                </div>
                                                <span class="text-dark-75 font-weight-bold mt-15 font-size-lg text-center"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end:: Card-->
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card card-custom gutter-b card-stretch">
                                        <div class="container" style="display: flex;">
                                            <div style="float:left; padding-top:3px; padding-left:5px; margin:8px;">
                                                <label class="mt-radio">Image 2</label>
                                            </div>                                           
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="image-input image-input-outline">
                                                    <input type="file" id="image_part2" name="image_2" style="position: absolute; z-index:-1;" class="image_upload" accept=".jpg, .jpeg, .png">
                                                    <label for="image_part2" class='image-input-wrapper' style="background-image:url(/assets/img/products/unnamed.jpg)"></label>
                                                </div>
                                                <span class="text-dark-75 font-weight-bold mt-15 font-size-lg text-center"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end:: Card-->
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card card-custom gutter-b card-stretch">
                                        <div class="container" style="display: flex;">
                                            <div style="float:left; padding-top:3px; padding-left:5px; margin:8px;">
                                                <label class="mt-radio">Image 3</label>
                                            </div>                                           
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="image-input image-input-outline">
                                                    <input type="file" id="image_part3" name="image_3" style="position: absolute; z-index:-1;" class="image_upload" accept=".jpg, .jpeg, .png">
                                                    <label for="image_part3" class='image-input-wrapper' style="background-image:url(/assets/img/products/unnamed.jpg)"></label>
                                                </div>
                                                <span class="text-dark-75 font-weight-bold mt-15 font-size-lg text-center"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end:: Card-->
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card card-custom gutter-b card-stretch">
                                        <div class="container" style="display: flex;">
                                            <div style="float:left; padding-top:3px; padding-left:5px; margin:8px;">
                                                <label class="mt-radio">Image 4</label>
                                            </div>                                           
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="image-input image-input-outline">
                                                    <input type="file" id="image_part4" name="image_4" style="position: absolute; z-index:-1;" class="image_upload" accept=".jpg, .jpeg, .png">
                                                    <label for="image_part4" class='image-input-wrapper' style="background-image:url(/assets/img/products/unnamed.jpg)"></label>
                                                </div>
                                                <span class="text-dark-75 font-weight-bold mt-15 font-size-lg text-center"></span>

                                            </div>
                                        </div>
                                    </div>
                                    <!--end:: Card-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-solid my-5"></div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Product name:</label>
                                <input type="text" class="form-control" placeholder="Enter name" name="name" />
                                <span class="form-text text-muted">Please enter product's name</span>
                            </div>
                            <div class="form-group">
                                <label>Subtitle:</label>
                                <input type="text" class="form-control" placeholder="Enter subtitle" name="subtitle" />
                                <span class="form-text text-muted">Please enter product's subtitle</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" rows="7" placeholder="Please product's description" type="text" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-solid my-5"></div>
                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Scientific name:</label>
                                <input type="text" class="form-control" placeholder="Enter scientific name" name="scientific_name" />
                                <span class="form-text text-muted">Please enter product's scientific name</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Product specialty</label>
                                <select id="product-specialty" class="form-control select2" name="specialty">
                                    <?php foreach ($arrSpecialty as $key => $specialty) : ?>
                                        <option value='<?= $key ?>'><?= $specialty ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Medical Line</label>
                                <select id="product-medical-line" class="form-control select2" name="medical_line">
                                    <?php foreach ($arrMedicalLine as $key => $medicalLine) : ?>
                                        <option value='<?= $key ?>'><?= $medicalLine ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-solid my-5"></div>
                    <div class="form-group">
                        <div class="dropzone dropzone-multi">
                            <label>Upload Catalog:</label>
                            <div class="dropzone-panel mb-lg-0 mb-2">
                                <div id='catalog_container'>
                                    <input type="file" id="catalog_uploads" name="catalog[]" class='catalog-input' style="position: absolute; z-index:-1;" accept=".pdf, .doc, .docx" multiple>
                                </div>
                                <label id="upload_catalog_button" class="btn btn-primary">
                                    <span>Upload Catalog</span>
                                </label>
                                <div class="dropzone-items" id="catalog_uploads_display">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-lg btn-outline-primary mr-10" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-lg btn-primary">
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

</div>
<!--end::Row-->

<script>
    var HOST_URL = "/";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="/theme/assets/plugins/global/plugins.bundle.js"></script>
<script src="/theme/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="/theme/assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="/theme/assets/js/pages/crud/file-upload/dropzonejs.js"></script>
<script src="/theme/assets/plugins/global/plugins.bundle.js"></script>
<!--end::Page Scripts-->

<script>
    $(document).ready(function() {

       
        let catalogSelector = document.getElementsByClassName('catalog-input');
        let catalogFiles = FileList;

        $('#catalog_container').on('change', 'input', function(event) {
            $('#catalog_container').append('<input type="file" name="catalog[]" class="catalog-input" style="position: absolute; z-index:-1;" accept=".pdf, .doc, .docx" multiple>')
        });
        $('#upload_catalog_button').on('click', function() {
            $('#catalog_container input:last-child').trigger('click');
        })

        $('#catalog_container').on('change', '.catalog-input', function() {
            const fileList = this.files;
            for (const file of fileList) {
                // Not supported in Safari for iOS.
                const name = file.name ? file.name : 'NOT SUPPORTED';
                // Not supported in Firefox for Android or Opera for Android.
                const type = file.type ? file.type : 'NOT SUPPORTED';
                // Unknown cross-browser support.
                const size = file.size ? file.size : 'NOT SUPPORTED';
                let file_length = catalogFiles.length;
                catalogFiles[file_length] = file;
                catalogFiles.length += 1;
            }
            addDropzoneItem(fileList, $('#catalog_uploads_display'));
        })

        function addDropzoneItem(files, element) { // Hookup the start button
            for (const idx of files) {
                var iFlaticon2Cross = $('<i>', {
                    class: 'flaticon2-cross'
                });

                var spanDropzoneDelete = $('<div>', {
                    class: 'dropzone-delete'
                });
                spanDropzoneDelete.append(iFlaticon2Cross);

                var dropzoneToolbar = $('<div>', {
                    class: 'dropzone-toolbar'
                });
                dropzoneToolbar.append(spanDropzoneDelete);

                var spanStrongSize = $('<span>', {
                    text: '(' + Math.round(idx.size / 1000) + ' кB) '
                });

                var strongSize = $('<strong>', {})
                strongSize.append(spanStrongSize);

                var spanFileName = $('<span>', {
                    text: idx.name
                });

                var dropzoneFile = $('<div>', {
                    class: 'dropzone-file',
                    title: idx.name
                });
                dropzoneFile.append(spanFileName);

                dropzoneToolbar.append(strongSize);

                var dropzoneItem = $('<div>', {
                    class: 'dropzone-item'
                });
                dropzoneItem.append(dropzoneFile);
                dropzoneItem.append(dropzoneToolbar);

                var dropzoneItems = element.append(dropzoneItem);
            }

        }

        function fnCallback(webResponse) {
            if (webResponse.errorCode == 0) {}
        }

        const form = document.getElementById('postaddproduct');
        form.addEventListener('submit', function(e) {

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(input).next().css('background-image', 'url(' + e.target.result + ')');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#postaddproduct').on('change','.image_upload', function() {
            readURL(this);
            let filename = this.files[0]['name'];
            $(this).parent().next('span').text(filename);
        })

    });
</script>
