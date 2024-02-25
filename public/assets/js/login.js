$(document).ready(function() {
    //inputs
    const uname = $('#username');
    const pass = $('#password');

    //btns
    const loginBtn = $('#login-btn');
    const showPassBtn = $('#show-pass-btn');

    //Modals
    const wrongCredentialModal = $('#credential-no-match');

    showPassBtn.click(function() {
        let isPass = pass.attr('type') === 'password';
        pass.attr('type', isPass ? 'text' : 'password');
        showPassBtn.attr('class', isPass ? 'fa-solid fa-eye-slash position-absolute right3 cursor-pointer' : 'fa-solid fa-eye position-absolute right3 cursor-pointer');
    });

    loginBtn.click(function() {
        window.location = '/TreasuryDashboard';
        // showModal(wrongCredentialModal);
        // closeModal(wrongCredentialModal, false);
    });
});