// Btns
const forgotPassBtn = $('#forgot-pass-btn');
const changePassBtn = $('#change-pass-btn');

// inputs
const forgotEmailIn = $('#forgot-pass-email-in');
const forgotOTPIn = $('#forgot-pass-otp-in');
const newPassIn = $('#new-pass-in');
const conNewPassIn = $('#con-new-pass-in');

// Containers
const loginCont = $('#login-box');
const forgotPasswordEmailCont = $('#forgot-password-email-cont');
const forgotPasswordOtpCont = $('#forgot-password-otp-cont');
const forgotPasswordChangeCont = $('#forgot-password-change-cont');

// Modals
const successModal = $('#success-modal');
const errorModal = $('#error-modal');





// Email Container
forgotPassBtn.click(() => {
    changeActiveCont(forgotPasswordEmailCont);
});

// Open OTP Container
forgotPasswordEmailCont.find('#next-btn').click(() => {
    if(!isEmail(forgotEmailIn.val())) {
        errorModal.find('.modal1-txt').html('Invalid email.');
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    let formData = new FormData();
    formData.append('processType', "sendOTP");
    formData.append('email', forgotEmailIn.val());

    $.ajax({
        url: '/forgotPassword',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if(response.status == 200) {
                successModal.find('.modal1-txt').html(response.message);
                showModal(successModal);
                closeModal(successModal, false);

                changeActiveCont(forgotPasswordOtpCont);
            }else {
                errorModal.find('.modal1-txt').html(response.message);
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

// Change Password Container
forgotPasswordOtpCont.find('#next-btn').click(() => {
    let formData = new FormData();
    formData.append('processType', "verifyOTP");
    formData.append('otp', forgotOTPIn.val());

    $.ajax({
        url: '/forgotPassword',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if(response.status == 200) {
                changeActiveCont(forgotPasswordChangeCont);
            }else {
                errorModal.find('.modal1-txt').html(response.message);
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

// Change password
changePassBtn.click(() => {
    if(isEmptyOrSpaces(newPassIn.val()) || isEmptyOrSpaces(conNewPassIn.val())) {
        errorModal.find('.modal1-txt').html(`Please fill-up the fields.`);
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    if(newPassIn.val() != conNewPassIn.val()) {
        errorModal.find('.modal1-txt').html(`New password and Confirm password doesn't match.`);
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    let formData = new FormData;
    formData.append('processType', "changePassword");
    formData.append('password', newPassIn.val());
    formData.append('email', forgotEmailIn.val());

    $.ajax({
        url: '/forgotPassword',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        // dataType: 'json',
        success: function (response) {
            if(response.status == 200) {
                successModal.find('.modal1-txt').html(response.message);
                showModal(successModal);
                closeModal(successModal, true);
            }else {
                errorModal.find('.modal1-txt').html(response.message);
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






function changeActiveCont(activeCont) {
    loginCont.addClass('d-none');
    forgotPasswordEmailCont.addClass('d-none');
    forgotPasswordOtpCont.addClass('d-none');
    forgotPasswordChangeCont.addClass('d-none');

    activeCont.removeClass('d-none');
}
