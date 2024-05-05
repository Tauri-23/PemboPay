//modals
const editPersonalModal = $('#emp-edit-personal-modal');
const editAddressModal = $('#emp-edit-address-modal');

const successModal = $('#success-modal');
const errorModal = $('#error-modal');

//btns
const editPersonalBtn = $('#edit-personal');
const editAddressBtn = $('#edit-address');

const personalPageLink = $('#personal-page');
const timesheetPageLink = $('#timesheet-page');

//containers
const personalContent = $('#personal-profile-content');
const timesheetContent = $('#timesheet-cont');

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
            
            $.ajax({
                type: "POST",
                url: "/AccountantEditEmpPersonalInfo",
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
    });

});

editAddressBtn.click(function() {
    //input
    const stAddressIn = editAddressModal.find('#st-address-in');


    stAddressIn.val(oldStreetAddress);


    showModal(editAddressModal);
    closeModal(editAddressModal, false);
});

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

function checkTheChanges(inputs, toCompare) {
    let count = 0;
    inputs.forEach(function (element, index) {
        if ($(element).val() !== toCompare[index]) {
            count++;
        }
    });
    return count;
}