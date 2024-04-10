//modals
const editPersonalModal = $('#emp-edit-personal-modal');
const editAddressModal = $('#emp-edit-address-modal');

//btns
const editPersonalBtn = $('#edit-personal');
const editAddressBtn = $('#edit-address');

const personalPageLink = $('#personal-page');
const timesheetPageLink = $('#timesheet-page');

//containers
const personalContent = $('#personal-profile-content');
const timesheetContent = $('#timesheet-cont');

editPersonalBtn.click(function() {
    const saveBtn = $(this).find('#save-btn');

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