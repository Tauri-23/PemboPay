$(document).ready(function() {
    //buttons
    const editDeptBtn = $('#edit-dept-btn');
    const delDeptBtn = $('#del-dept-btn');

    //modals
    const successModal = $('#success-modal');
    const errorModal = $('#error-modal');
    const exitModal = $('#close-modal');

    const closeYNModal = $('#close-yn-modal');



    delDeptBtn.click(function(event) {
        event.preventDefault();

        if(employees.length > 0) {
            errorModal.find('.modal-text').html('Department with employees cannot be deleted.');
            showModal(errorModal);
            closeModal(errorModal, false);
            return;
        }

        closeYNModal.find('.modal1-txt').html('Do you want to delete this department?');
        showModal(closeYNModal);
        closeModal(closeYNModal, false);

        let yesBtn = closeYNModal.find('.yes-btn');

        yesBtn.click(() => {
            closeModalNoEvent(closeYNModal);
            deleteDept();
        });

        
    });

    function deleteDept() {
        let formData = new FormData();
        formData.append("id", deptId);

        $.ajax({
            type: "POST",
            url: "/TreasuryDeleteDepartment",
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if(response.status == 200) {
                    successModal.find('.modal-text').html('Department successfully deleted.');
                    showModal(successModal);
                    closeModalRedirect(successModal, '/TreasuryDepartments');
                } else {
                    errorModal.find('.modal-text').html('Failed deleting department please try again later.');
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