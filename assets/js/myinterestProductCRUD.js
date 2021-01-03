'use strict';

var medicalEquipmentItemDom = null;
var spcialitiesSectionDom = null;
var clonedListItem = null;
var selectedProducts = [];
var breadCrumbs = [];
var editCall = false;
var distID = null;
var medicalLines = [];

function loadMedicalLineItems(data) {
    $('.medical-lines-section').empty();
    $('.spcialities-section').empty();
    $('.products-section').empty();
    data.forEach((element) => {
        var myClone = $('.cloned-dom .list-item').clone();
        myClone.find('.title-name').text(element.Name);
        myClone.find('.image-section').css('background-image', 'url(' + element.ImagePath.replace(/ /g, '%20') + ')');
        myClone.find('.product-total').text(element.totalProducts+" Products");
        myClone.find('.get-speciality').attr('id',element.Name+"_"+element.ID);
        $('.medical-lines-section').append(myClone);
    });
}

function getMedicalLines() {
    WebApp.get('medicalLine/getAll', function getResponse(res){  
        if(res.data && res.data.length>0) {            
            medicalLines = res.data;
            loadMedicalLineItems(res.data);
        }
    });
}

function getSpecialityByMedicalLineId(medicalLineId) {    
    WebApp.get('getSpecialitiesByMedicalId/'+medicalLineId, function getResponse(res){  
        if(res.data && res.data.length>0) {
            medicalEquipmentItemDom = $('.medical-lines-section').clone();
            $('.spcialities-section').empty();
            res.data.forEach((element) => {
                let myClone = $('.cloned-dom .list-item').first().clone();
                myClone.find('.title-name').text(element.Name);
                myClone.find('.image-section').css('background-image', 'url(' + element.ImagePath.replace(/ /g, '%20') + ')');
                myClone.find('.product-total').text(element.totalProducts+" Products");
                myClone.find('.get-speciality').attr('id',element.Name+"_"+element.ID);
                myClone.find('.get-speciality').removeClass('get-speciality').addClass('get-scientific-name');
                $('.spcialities-section').append(myClone);
            });
        }
    });
}

function getScientificNameBySpecialityId(specialityId) {    
    WebApp.get('getScientificNameBySpecialityId/'+specialityId, function getResponse(res){        
        if(res.data && res.data.length>0) {  
            $('.back-btn').show();    
            if($('.products-section').find('input[type="checkbox"]').length==0) {      
                spcialitiesSectionDom = $('.spcialities-section').clone();
                $('.spcialities-section').removeClass('spcialities-section').addClass('products-section');
                $('.medical-lines-section').removeClass('medical-lines-section').addClass('spcialities-section');
                $('.spcialities-section').replaceWith(spcialitiesSectionDom);
            }
            $('.products-section').empty();
            res.data.forEach((element) => {                
                let myClone = $('.spcialities-section .list-item').first().clone();
                myClone.find('.title-name').text(element.Name);
                myClone.find('.get-speciality').removeClass('get-speciality').addClass('get-scientific-name');
                myClone.find('.image-section').css('background-image', 'url(' + element.ImagePath + ')');
                myClone.find('.get-scientific-name').replaceWith('<label class="checkbox"><input type="checkbox" class="product_ids" id="'+element.ScientificNameID+'" name="products" value="'+element.Name+'"/><span></span></label>');
                $('.products-section').append(myClone);
            });
            if($('.products-section').find('input[type="checkbox"]').length>0 && !editCall) {   
                const pickedSpeciality = breadCrumbs.filter((el) => el.type === 'Speciality' && el.id === specialityId);
                if(pickedSpeciality && pickedSpeciality.length>0) {
                    let firstItemClone = $('.spcialities-section').find('#'+pickedSpeciality[0].title+'_'+pickedSpeciality[0].id+'').closest('.list-item').clone();
                    firstItemClone.find('.title-name').text("Select All");
                    firstItemClone.find('.get-scientific-name').replaceWith('<label class="checkbox"><input type="checkbox" class="select-all-products" name="all-products" /><span></span></label>');
                    $('.products-section').prepend(firstItemClone);
                } 
                if(!$('.select-all-products').length) {
                    //in case if jquery dont get first item
                    let backUpfirstItemClone = $('.spcialities-section .list-item').first().clone();
                    backUpfirstItemClone.find('.title-name').text("Select All");
                    backUpfirstItemClone.find('.get-scientific-name').replaceWith('<label class="checkbox"><input type="checkbox" class="select-all-products" name="all-products" /><span></span></label>');
                    $('.products-section').prepend(backUpfirstItemClone);
                }
                
            }
            $('.products-section').find('.product-total').remove();
        }
    });
}

function removeSeletedProducts(id) {
    selectedProducts = selectedProducts.filter((el) => el.ScientificNameID != id ); 
    loadSelectedProducts(selectedProducts);
    $('.products-section #'+id).prop('checked', false);
}

function addNewProduct(obj) {
    if(!editCall) {
        if(!selectedProducts.find((el) => el.ScientificNameID === obj.ScientificNameID && obj.Name === el.Name)) {              
            selectedProducts.unshift(obj);            
            loadSelectedProducts(selectedProducts);
        }
    } else {
        if(selectedProducts.length==0) {
            selectedProducts.unshift(obj);
            loadSelectedProducts(selectedProducts);
        }
    }
}

function loadSelectedProducts(data) {
    $('.selected-products').empty();
        data.forEach(element => {
            var productItem = '<span class="mr-3 rounded product-item btn-primary p-2"><span class="product-name">'+element.Name+'</span><i class="ki flaticon-cancel icon-md remove-product" id="'+element.ScientificNameID+'"></i></span>';
            $('.selected-products').append(productItem);
        });
}

function loadBreadCrumbs(data) {
    $('.breadcrumbs-section').empty();
        data.forEach((element,index) => {
            var item = '';
            let className = '';
            if(index>0) {
                item+='/  ';
                className = 'product-name';
            } else {
                className = 'product-name text-primary';
            }
            item += '<span class="mr-3 rounded p-2"><span class="'+className+'">'+element.title+'</span></span>';
            $('.breadcrumbs-section').append(item);
        });
}

function addToBreadCrumbs(obj) {
    breadCrumbs = breadCrumbs.filter((el) => el.type !== obj.type );
    breadCrumbs.push(obj);
    loadBreadCrumbs(breadCrumbs);
}

function attachNewItems() {
    if(selectedProducts.length>0) {
        var data = {
            'selectedProducts' : selectedProducts, 
            'breadCrumbs' : breadCrumbs
        };
        if(editCall) {
            data.editID = distID; 
        }
        WebApp.post('myinterests/attach-new-products',data, function getResponse(res) {
            if(res.errorCode==0) {
                WebApp.alertSuccess(res.message);
                resetAll();
            }
        });
    } else {        
        WebApp.alertError("Please Select Any Item First.");
    }
}

function resetAll() {
    selectedProducts = breadCrumbs = [];
    $('.spcialities-section').empty();
    $('.products-section').empty();
}

function loadSelectedScientificNames(id) {
    distID = id;
    WebApp.get('myinterests/load-selected-scientific-names/'+id, function getResponse(res) {
        if(res.data) {
            selectedProducts = res.data;
            loadSelectedProducts(res.data);
        }
    });
}

//back to initial level
function backFunctionality() {    
    var specialitiesDom = $('.spcialities-section').clone();
    $('.spcialities-section').removeClass('spcialities-section').addClass('medical-lines-section');
    $('.products-section').removeClass('products-section').addClass('spcialities-section');
    loadMedicalLineItems(medicalLines);
    $('.spcialities-section').html(specialitiesDom.html());
    breadCrumbs.splice(breadCrumbs.findIndex((el) => el.type == 'Speciality' ), 1); 
    loadBreadCrumbs(breadCrumbs);
    $('.back-btn').hide();
}

function selectAllCheckbox(checked) {
    $('.products-section .product_ids').each(function() {
        $(this).prop('checked', checked);
        if(checked) {
            addNewProduct({
                ScientificNameID: $(this).attr('id'), 
                Name: $(this).attr('value')
            });
        } else {
            removeSeletedProducts($(this).attr('id'));
        }
    });
}

function removeSpecialCharacters(str) {
    return str.replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
}

function filterByName(array, string) {
    return array.filter(o => o.Name.toLowerCase().includes(string.toLowerCase()));
}

jQuery(document).ready(function() {
    $('.back-btn').hide();
    getMedicalLines();
	$(document).on('click', '.get-speciality', function(e) {
        e.preventDefault();        
        addToBreadCrumbs({
            'type' : 'MedicalLine',
            'id' : $(this).attr('id').split('_').reverse()[0],
            'title' :  removeSpecialCharacters($(this).attr('id').split('_').reverse()[1])
        });
		getSpecialityByMedicalLineId($(this).attr('id').split('_').reverse()[0]);
    });
    $(document).on('click', '.remove-product', function(e) {
        e.preventDefault();
        removeSeletedProducts($(this).attr('id'));
    });
		
    $(document).on('click', '.get-scientific-name', function(e) {
        e.preventDefault();
        addToBreadCrumbs({
            'type' : 'Speciality',
            'id' : $(this).attr('id').split('_').reverse()[0],
            'title' :  removeSpecialCharacters($(this).attr('id').split('_').reverse()[1])
        });
		getScientificNameBySpecialityId($(this).attr('id').split('_').reverse()[0]);
    });
    $(document).on('click', '.product_ids', function(e) {
        if($(this).is(':checked')) {
            let obj = {
                ScientificNameID: $(this).attr('id'), 
                Name: $(this).attr('value')
            };
            addNewProduct(obj);
        } else {
            removeSeletedProducts($(this).attr('id'));
        }
    });
    $(document).on('click', '.back-btn', function(e) { 
        backFunctionality();
    });
    if($('.hidden-value').length) {
        editCall = true;
        loadSelectedScientificNames($('.hidden-value').val());
    }
    $(document).on('click', '.select-all-products', function(e) { 
        selectedProducts = [];
        $('product-item').remove();
        selectAllCheckbox($(this).is(':checked'));
    });

    $('.filter-medical-line').keyup(function(){
        loadMedicalLineItems(filterByName(medicalLines, $(this).val()));
    });
});