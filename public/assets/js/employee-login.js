$(document).ready(function() {
    //inputs
    const userIdIn = $('#userid');

    //btns
    const loginBtn = $('#login-btn');

    //modals
    const wrongCredentialModal = $('#credential-no-match');
    const somethingWentWrongModal = $('#something-went-wrong');




    loginBtn.click(function(event) {
        event.preventDefault();

        let formData = new FormData();
        formData.append("userid", userIdIn.val());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "RequestVerificationToken": $('input:hidden[name="__RequestVerificationToken"]').val()
            }
        });
        

        $.ajax({
            url: '/EmployeeLogin',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            // dataType: 'json',
            success: function (response) {
                console.log(response);
                if(response.status == 200) {
                    window.location.href = '/EmployeeDash';
                } else {
                    showModal(wrongCredentialModal);
                    closeModal(wrongCredentialModal, false);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('error');
            }
        });
    });
});