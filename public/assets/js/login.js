$(document).ready(function() {
    //inputs
    const uname = $('#username');
    const pass = $('#password');

    //btns
    const loginBtn = $('#login-btn');
    const showPassBtn = $('#show-pass-btn');

    //Modals
    const wrongCredentialModal = $('#credential-no-match');
    const somethingWentWrongModal = $('#something-went-wrong');

    showPassBtn.click(function() {
        let isPass = pass.attr('type') === 'password';
        pass.attr('type', isPass ? 'text' : 'password');
        showPassBtn.attr('class', isPass ? 'fa-solid fa-eye-slash position-absolute right3 cursor-pointer' : 'fa-solid fa-eye position-absolute right3 cursor-pointer');
    });

    loginBtn.click(function(event) {
        event.preventDefault();
        
        // if(uname.val() === 'adiawan' && pass.val() === 'ajdiawan123') {
        //     window.location = '/TreasuryDashboard';
        // }
        // else {
        //     showModal(wrongCredentialModal);
        //     closeModal(wrongCredentialModal, false);
        // }

        let formData = new FormData();
        formData.append("username", uname.val());
        formData.append("password", pass.val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "RequestVerificationToken": $('input:hidden[name="__RequestVerificationToken"]').val()
            }
        });
        

        $.ajax({
            url: '{{ route("auth.login") }}',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if(response) {
                    window.location.href = '/Treasury/Index';
                } else {
                    showModal(wrongCredentialModal);
                    closeModal(wrongCredentialModal, false);
                }
            },
            error: function (response) {
                console.log(response);
                showModal(somethingWentWrongModal);
                closeModal(somethingWentWrongModal, false);
            }
        });
    });
});