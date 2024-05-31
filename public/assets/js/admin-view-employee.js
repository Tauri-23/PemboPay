//modals
const editPersonalModal = $('#emp-edit-personal-modal');
const editAddressModal = $('#emp-edit-address-modal');
const editPayInformationModal = $('#emp-edit-info-compensation-modal');

const successModal = $('#success-modal');
const errorModal = $('#error-modal');

//btns
const editPersonalBtn = $('#edit-personal');
const editAddressBtn = $('#edit-address');
const editCompensationBtn = $('#edit-compensation-btn');

const editPfpBtn = $('#change-pfp-btn');

//containers
const personalContent = $('#personal-profile-content');
const timesheetContent = $('#timesheet-cont');

editPfp();





/*
|----------------------------------------
| Edit Profile
|----------------------------------------
*/
// EDIT PERSONAL INFO
editPersonalBtn.click(function() {
    const saveBtn = editPersonalModal.find('#save-btn');

    //input
    const fnameIn = editPersonalModal.find('#fname-in');
    const mnameIn = editPersonalModal.find('#mname-in');
    const lnameIn = editPersonalModal.find('#lname-in');
    const phoneIn = editPersonalModal.find('#phone-in');
    const genderIn = editPersonalModal.find('#gender-in');


    fnameIn.val(employee.firstname);
    mnameIn.val(employee.middlename);
    lnameIn.val(employee.lastname);
    phoneIn.val(employee.phone);
    genderIn.val(employee.gender);
    
    
    showModal(editPersonalModal);
    closeModal(editPersonalModal, false);

    saveBtn.click(function() {
        if(isEmptyOrSpaces(fnameIn.val()) || isEmptyOrSpaces(lnameIn.val()) || isEmptyOrSpaces(phoneIn.val()) || isEmptyOrSpaces(genderIn.val())) {
            return;
        }
        
        if (checkTheChanges(
            [fnameIn, mnameIn, lnameIn, phoneIn, genderIn],
            [employee.firstname, employee.middlename == null ? "" : employee.middlename, employee.lastname, employee.phone, employee.gender]) > 0) {


            let formData = new FormData;
            formData.append('emp_id', employee.id);
            formData.append('fname', fnameIn.val());
            formData.append('mname', mnameIn.val());
            formData.append('lname', lnameIn.val());
            formData.append('phone', phoneIn.val());
            formData.append('gender', genderIn.val());
            formData.append('editType', 'Personal Information');
            
            EditEmpProfileAjax(formData);                                                                                                  
        }
    });

});

// EDIT ADDRESS
editAddressBtn.click(function() {
    const saveBtn = editAddressModal.find('#save-btn');

    //input
    const stAddressIn = editAddressModal.find('#st-address-in');
    const cityIn = editAddressModal.find('#city-in');
    const brgyIn = editAddressModal.find('#brgy-in');


    stAddressIn.val(employee.street_address);
    cityIn.val(employee.city).change();
    brgyIn.val(employee.barangay).change();

    cityIn.change(function() {
        const selectedCity = $(this).val();
        brgyIn.html('');

        const filteredBrgys = brgys.filter(brgy => brgy.city == selectedCity);

        filteredBrgys.forEach(brgy => {
            brgyIn.append(`<option value="${brgy.id}">${brgy.barangay}</option>`);
        });
    });
    

    showModal(editAddressModal);
    closeModal(editAddressModal, false);

    saveBtn.click(function() {
        if(isEmptyOrSpaces(stAddressIn.val()) || isEmptyOrSpaces(cityIn.val())
             || isEmptyOrSpaces(brgyIn.val())) {
            return;
        }
        if (checkTheChanges(
            [stAddressIn, cityIn, brgyIn],
            [employee.street_address, employee.city, employee.barangay]) > 0) {
            
            let formData = new FormData;
            formData.append('emp_id', employee.id);
            formData.append('street_address', stAddressIn.val());
            formData.append('city', cityIn.val());
            formData.append('brgy', brgyIn.val());
            formData.append('editType', 'Address Information');
            
            EditEmpProfileAjax(formData);
        }
    });
});

// EDIT PFP
function editPfp() {
    editPfpBtn.on("click", function (e) {
        var fileDialog = $('<input type="file" accept="image/*">');
        fileDialog.click();
        fileDialog.on("change", onFileSelected);
        return false;
    });

    var onFileSelected = function (e) {
        var selectedFiles = $(this)[0].files;
        
        if (selectedFiles.length > 0) {
            var formData = new FormData();
            formData.append('emp_id', employee.id);
            formData.append("file", selectedFiles[0]);
            formData.append('editType', 'PFP');
    
            EditEmpProfileAjax(formData);   
            
            
        } else {
            console.log("No file selected.");
        }
    };
}





/*
|----------------------------------------
| AJAX
|----------------------------------------
*/
function EditEmpProfileAjax(formData) {
    $.ajax({
        type: "POST",
        url: "/AdminEditEmpInfo",
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if(response.status == 200) {
                successModal.find('.modal-text').html('Changes Saved.');
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal-text').html('Failed saving changes please try again later.');
                showModal(errorModal);
                closeModal(errorModal, false);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });   
}