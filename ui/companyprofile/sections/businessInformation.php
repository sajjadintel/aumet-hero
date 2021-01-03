<form class="form" id="frmBusinessInfo">
    <div class="card card-custom card-stretch" >
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Business Information</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Update your business related information</span>
            </div>
            <div class="card-toolbar">
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                    <button type="button" onclick="WebApp.loadPage('mycompanyprofile')" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label font-size-h6">Annual Sales</label>
                <div class="col-lg-6 col-xl-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input class="form-control form-control-lg" type="text" name="AnnualSales" value="<?php echo $objCompany->AnnualSales ?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label font-size-h6">Number of Employees</label>
                <div class="col-lg-6 col-xl-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text decrement">-</span>
                        </div>
                        <input class="form-control form-control-lg" id="noOfEmp" type="text" name="NumberOfEmployees" value="<?php echo $objCompany->NumberOfEmployees ?>">
                        <div class="input-group-prepend">
                            <span class="input-group-text increment">+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label font-size-h6">Establishment Year</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <div class="input-group date" id="kt_datetimepicker_3" data-target-input="nearest">
                            <input type="text" value="<?php echo $objCompany->EstablishmentYear ?>" name="EstablishmentYear" class="form-control datetimepicker-input" placeholder="Select Year" data-target="#kt_datetimepicker_3"/>
                            <div class="input-group-append" data-target="#kt_datetimepicker_3" data-toggle="datetimepicker">
                                <span class="input-group-text">
                                <i class="ki ki-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-group row">
                <label class="offset-3 col col-form-label text-dark font-size-h3">Company Experience</label>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label font-size-h6">Medical Lines</label>
                <div class="col">
                    <select class="form-control datatable-input" id="kt_datatable_search_medicalLine" name="medicallines[]" data-col-index="1" multiple="multiple">
                        <option value="">Select</option>
                            <?php foreach ($arrMedicalLines as $item): ?>
                                <option value="<?php echo $item->id ?>" <?php if(isset($arrSavedMedicalLines) && in_array($item->id,$arrSavedMedicalLines)) { echo "selected"; } ?>><?php echo $item->name ?></option>
                            <?php endforeach; ?>
				    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label font-size-h6">Specialities</label>
                <div class="col">
                <select class="form-control datatable-input" id="kt_datatable_specialityId" name="specialities[]" data-col-index="2" multiple="multiple">
                    <option value="">Select</option>
                        <?php foreach ($arrSpeciality as $special): ?>
                            <option value="<?php echo $special->ID ?>" <?php if(isset($arrSavedSpeciality) && in_array($special->ID,$arrSavedSpeciality)) { echo "selected"; } ?>><?php echo $special->Name ?></option>
                        <?php endforeach; ?>
					</select>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function fnCallbackSaveBusinessInfo(webReponse){
        webReponse.errorCode == 0 ? WebApp.alertSuccess(webReponse.message) : WebApp.alertError(webReponse.message);
    }

    $( '#frmBusinessInfo' ).submit(function ( e ) {
        e.preventDefault();
        WebApp.postFormData('#frmBusinessInfo','mycompanyprofile/edit/businessinformation', (new FormData(this)), fnCallbackSaveBusinessInfo)
    });
    $(document).ready(function() {
        $('#kt_datatable_search_medicalLine').select2();
        $('#kt_datatable_specialityId').select2();

        function is_alphaDash(str)  {
                regexp = /^[a-z0-9_\-]+$/i;
        
                if (regexp.test(str))
                {
                    return true;
                }
                else
                {
                    return false;
                }
        }
        $('#kt_datetimepicker_3').datetimepicker({
            format: "YYYY",
            startView: 'decade',
            minView: 'decade',
            viewSelect: 'decade',
        });
        $('.increment').click(function(){
            var noEmp = $('#noOfEmp').val().replace(/\s/g, '');
            var _val = 0;
            if(noEmp) {
                if(is_alphaDash(noEmp)) {
                    _val = noEmp.split('-').reverse()[0];
                } else {
                    _val = noEmp;
                }
            }
            _val = parseInt(_val)+1;
            $('#noOfEmp').val('0 - '+_val);
        });
        $('.decrement').click(function(){
            var noEmp = $('#noOfEmp').val().replace(/\s/g, '');
            var _val = 0;
            if(noEmp) {
                if(is_alphaDash(noEmp)) {
                    _val = noEmp.split('-').reverse()[0];
                } else {
                    _val = noEmp;
                }
            }
            if(_val>0) {
                _val = parseInt(_val)-1;
            } $('#noOfEmp').val('0 - '+_val);
        });
    });
</script>