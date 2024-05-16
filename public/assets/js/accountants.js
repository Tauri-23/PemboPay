// Modals
const successModal = $('#success-modal');
const errorModal = $('#error-modal');
const infoYNModal = $('#info-yn');
const warningYNModal = $('#warning-yn-modal');
const addAccountantModal = $('#add-accountant-modal');

// Btns
const addAccountantBtn = $('#add-accountant-btn');
const deleteAccountantBtns = $('.delete-acc-btn');

// Inputs
const fnameIn = $('#fname-in');
const mnameIn = $('#mname-in');
const lnameIn = $('#lname-in');
const unameIn = $('#uname-in');
const genderIn = $('#gender-in');
const emailIn = $('#email-in');
const phoneIn = $('#phone-in');


formatPhoneNumIn(phoneIn);


addAccountantBtn.click(() => {
    showModal(addAccountantModal);
    closeModal(addAccountantModal, false);
});

addAccountantModal.find('#add-accountant').click(() => {
    if(isEmptyOrSpaces(fnameIn.val()) || isEmptyOrSpaces(lnameIn.val()) 
        || isEmptyOrSpaces(unameIn.val()) || isEmptyOrSpaces(emailIn.val()) || isEmptyOrSpaces(phoneIn.val())) {
        return;
    }

    let formData = new FormData();
    formData.append('fname', fnameIn.val());
    formData.append('mname', mnameIn.val());
    formData.append('lname', lnameIn.val());
    formData.append('uname', unameIn.val());
    formData.append('gender', genderIn.val());
    formData.append('email', emailIn.val());
    formData.append('phone', phoneIn.val());

    $.ajax({
        type: "POST",
        url: "/AdminAddAccountant",
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if(response.status == 200) {
                successModal.find('.modal-text').html('Accountant successfully added.');
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal-text').html('Failed adding accountant please try again later.');
                showModal(errorModal);
                closeModal(errorModal, false);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
});

let accId = "";

deleteAccountantBtns.click(function() {
    accId = $(this).attr('id');

    warningYNModal.find('.modal1-txt').html(`Do you want to delete Accountant (${accId}) ?`);
    showModal(warningYNModal);
    closeModal(warningYNModal, false);
});

warningYNModal.find('.yes-btn').click(() => {
    let formData = new FormData();
    formData.append('accId', accId);

    $.ajax({
        type: "POST",
        url: "/AdminDelAccountant",
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if(response.status == 200) {
                successModal.find('.modal-text').html('Accountant successfully deleted.');
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal-text').html('Failed deleting accountant please try again later.');
                showModal(errorModal);
                closeModal(errorModal, false);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
});


