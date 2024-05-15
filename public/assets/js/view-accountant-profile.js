//modals
const editPersonalModal = $('#acc-edit-personal-modal');
const editPasswordModal = $('#acc-edit-password-modal');

const successModal = $('#success-modal');
const errorModal = $('#error-modal');

//btns
const editPersonalBtn = $('#edit-personal');
const editPasswordBtn = $('#edit-credential');

//input
const fnameIn = editPersonalModal.find('#fname-in');
const mnameIn = editPersonalModal.find('#mname-in');
const lnameIn = editPersonalModal.find('#lname-in');

const newPassIn = $('#new-pass-in');
const conPassIn = $('#con-pass-in');
const oldPassIn = $('#old-pass-in');


editPersonalBtn.click(() => {
    fnameIn.val(oldFname);
    mnameIn.val(oldMname);
    lnameIn.val(oldLname);

    showModal(editPersonalModal);
    closeModal(editPersonalModal, false);
});

editPersonalModal.find('#save-btn').click(() => {
    if(isEmptyOrSpaces(fnameIn.val()) || isEmptyOrSpaces(lnameIn.val())) {
        return;
    }

    if(checkTheChanges([fnameIn, mnameIn, lnameIn], [oldFname, oldMname == null ? "" : oldMname, oldLname]) > 0) {
        let formData = new FormData;
        formData.append('accId', AccId);
        formData.append('fname', fnameIn.val());
        formData.append('mname', mnameIn.val());
        formData.append('lname', lnameIn.val());
        formData.append('editType', 'Personal Information');

        EditEmpProfileAjax(formData)
    }
});


editPasswordBtn.click(() => {
    newPassIn.val('');
    conPassIn.val('');
    oldPassIn.val('');
    showModal(editPasswordModal);
    closeModal(editPasswordModal, false);
});

editPasswordModal.find('#save-btn').click(() => {
    if(isEmptyOrSpaces(newPassIn.val()) || isEmptyOrSpaces(conPassIn.val()) || isEmptyOrSpaces(oldPassIn.val())) {
        return;
    }

    if(newPassIn.val() != conPassIn.val()) {
        errorModal.find('.modal-text').html(`Confirm password doesn't match.`);
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    if(oldPassIn.val() != oldPassword) {
        errorModal.find('.modal-text').html(`Old password incorrect.`);
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    if(newPassIn.val() == oldPassword) {
        errorModal.find('.modal-text').html(`New password cannot be the old one.`);
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    let formData = new FormData();
    formData.append('accId', AccId);
    formData.append('password', newPassIn.val());
    formData.append('editType', 'Password');

    EditEmpProfileAjax(formData)
});







function EditEmpProfileAjax(formData) {
    $.ajax({
        type: "POST",
        url: "/AccountantEditProfile",
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