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

const personalPageLink = $('#personal-page');
const timesheetPageLink = $('#timesheet-page');

const editPfpBtn = $('#change-pfp-btn');

//containers
const personalContent = $('#personal-profile-content');
const timesheetContent = $('#timesheet-cont');

editPfp();

editPersonalBtn.click(function() {
    const saveBtn = editPersonalModal.find('#save-btn');

    //input
    const fnameIn = editPersonalModal.find('#fname-in');
    const mnameIn = editPersonalModal.find('#mname-in');
    const lnameIn = editPersonalModal.find('#lname-in');
    const phoneIn = editPersonalModal.find('#phone-in');
    const genderIn = editPersonalModal.find('#gender-in');


    fnameIn.val(oldFname);
    mnameIn.val(oldMname);
    lnameIn.val(oldLname);
    phoneIn.val(oldPhone);
    genderIn.val(oldGender);
    
    
    showModal(editPersonalModal);
    closeModal(editPersonalModal, false);

    saveBtn.click(function() {
        if(isEmptyOrSpaces(fnameIn.val()) || isEmptyOrSpaces(lnameIn.val()) || isEmptyOrSpaces(phoneIn.val()) || isEmptyOrSpaces(genderIn.val())) {
            return;
        }
        
        if (checkTheChanges(
            [fnameIn, mnameIn, lnameIn, phoneIn, genderIn],
            [oldFname, oldMname == null ? "" : oldMname, oldLname, oldPhone, oldGender]) > 0) {


            let formData = new FormData;
            formData.append('emp_id', empId);
            formData.append('old_fullname', `${oldFname} ${oldMname == null ? "" : oldMname} ${oldLname}`);
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

editAddressBtn.click(function() {
    const saveBtn = editAddressModal.find('#save-btn');

    //input
    const stAddressIn = editAddressModal.find('#st-address-in');
    const cityIn = editAddressModal.find('#city-in');
    const brgyIn = editAddressModal.find('#brgy-in');


    stAddressIn.val(oldStreetAddress);
    cityIn.val(oldCity).change();
    brgyIn.val(oldBrgy).change();

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
            [oldStreetAddress, oldCity, oldBrgy]) > 0) {
            
            let formData = new FormData;
            formData.append('emp_id', empId);
            formData.append('old_fullname', `${oldFname} ${oldMname == null ? "" : oldMname} ${oldLname}`);
            formData.append('street_address', stAddressIn.val());
            formData.append('city', cityIn.val());
            formData.append('brgy', brgyIn.val());
            formData.append('editType', 'Address Information');
            
            EditEmpProfileAjax(formData);
        }
    });
});


editCompensationBtn.click(function() {
    const saveBtn = editPayInformationModal.find('#save-btn');

    let newCompensationType = oldCompensationType;

    // inputs
    const hourlyBtn = editPayInformationModal.find('#hourly');
    const salaryBtn = editPayInformationModal.find('#salary');
    const hourlyInCont = editPayInformationModal.find('#hourly-pay-inputs');
    const salaryInCont = editPayInformationModal.find('#salary-pay-inputs');

    const hourlyIn = editPayInformationModal.find('#hourly-rate');
    const salaryIn = editPayInformationModal.find('#salary-rate');

    if(oldCompensationType == "salary") {
        changeSalaryForm(salaryBtn, salaryInCont);
        salaryIn.val(oldCompensationPrice);
    } else {
        changeSalaryForm(hourlyBtn, hourlyInCont);

        hourlyIn.val(oldCompensationPrice);
    }
    
    hourlyBtn.click(() => {
        newCompensationType = "hourly";
        changeSalaryForm(hourlyBtn, hourlyInCont);
    })
    salaryBtn.click(() => {
        newCompensationType = "salary";
        changeSalaryForm(salaryBtn, salaryInCont);
    });


    showModal(editPayInformationModal);
    closeModal(editPayInformationModal, false);


    saveBtn.click(function() {
        if(newCompensationType == "salary") {
            if(isEmptyOrSpaces(newCompensationType) || isEmptyOrSpaces(salaryIn.val())) {
                return;
            }

            if(checkTheChanges(
                [salaryIn],
                [oldCompensationPrice]) > 0) {

                let formData = new FormData;
                formData.append('emp_id', empId);
                formData.append('compensation_id', compensationId);
                formData.append('old_fullname', `${oldFname} ${oldMname == null ? "" : oldMname} ${oldLname}`);
                formData.append('compensation_type', newCompensationType);
                formData.append('price', salaryIn.val());
                formData.append('editType', 'Pay Information');
                
                EditEmpProfileAjax(formData);
            }
        } 
        else {
            if(isEmptyOrSpaces(newCompensationType) || isEmptyOrSpaces(hourlyIn.val())) {
                return;
            }
            if(checkTheChanges(
                [hourlyIn],
                [oldCompensationPrice]) > 0) {

                let formData = new FormData;
                formData.append('emp_id', empId);
                formData.append('compensation_id', compensationId);
                formData.append('old_fullname', `${oldFname} ${oldMname == null ? "" : oldMname} ${oldLname}`);
                formData.append('compensation_type', newCompensationType);
                formData.append('price', hourlyIn.val());
                formData.append('editType', 'Pay Information');
                
                EditEmpProfileAjax(formData);
            }
        }
    });

    function changeSalaryForm(link, input) {
        salaryBtn.removeClass('active');
        hourlyBtn.removeClass('active');
        hourlyInCont.addClass('d-none');
        salaryInCont.addClass('d-none');
    
        link.addClass('active');
        input.removeClass('d-none');
    }
});


function EditEmpProfileAjax(formData) {
    $.ajax({
        type: "POST",
        url: "/AccountantEditEmpInfo",
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


function editPfp() {
    editPfpBtn.on("click", function (e) {
        var fileDialog = $('<input type="file" accept="image/*">');
        fileDialog.click();
        fileDialog.on("change", onFileSelected);
        return false;
    });

    var onFileSelected = function (e) {
        var selectedFiles = $(this)[0].files;
        var fileName = $(this)[0].files[0].name;

        console.log(selectedFiles);
        
        if (selectedFiles.length > 0) {
            var formData = new FormData();
            formData.append("file", selectedFiles[0]);
    
            $.ajax({
                url: '/UploadEmpPfp',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    console.log(response.filename);

                    let formData = new FormData();
                    formData.append("id", empId);
                    formData.append("pfp", response.filename);

                    uploadPfpToDb(formData);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('error');
                }
            });
    
            
            
        } else {
            console.log("No file selected.");
        }
    };
}


function uploadPfpToDb(formData) {
    $.ajax({
        url: '/UploadEmpPfpToDb',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
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
        error: function (response) {
            alert(response);
        }
    });
}







// Nav links
personalPageLink.click(function() {
    removeActiveLinks();

    $(this).addClass('active');
    personalContent.removeClass('d-none');
    timesheetContent.addClass('d-none');
});

timesheetPageLink.click(function() {
    removeActiveLinks();

    $(this).addClass('active');
    personalContent.addClass('d-none');
    timesheetContent.removeClass('d-none');
});


function removeActiveLinks() {
    personalPageLink.removeClass('active');
    timesheetPageLink.removeClass('active');
}