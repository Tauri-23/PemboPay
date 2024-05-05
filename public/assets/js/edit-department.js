//inputs
const deptNameIn = $('#dept-name-in');
const deptBgIn = $('#dept-bg-in');

//modals
const successModal = $('#success-modal');
const errorModal = $('#error-modal');

//inputs
const deptBgs = $('.dept-bg-select-cont');

//btns
const saveBtn = $('#save-department');

deptBgIn.val(oldDeptPic);

deptBgs.click(function() {
    const bgPic = $(this).find('.dept-bg-pic').attr('id');
    const bgPicOverlay = $(this).find('.deptBgOverlay');
    deptBgIn.val($(this).find('.dept-bg-pic').attr('id'));
    changeActiveDeptBg($(this));
});

function changeActiveDeptBg($toActive) {
    deptBgs.removeClass('active');
    deptBgs.find('.deptBgOverlay').addClass('d-none');

    $toActive.addClass('active');
    $toActive.find('.deptBgOverlay').removeClass('d-none');
}

saveBtn.click(function() {
    if(isEmptyOrSpaces(deptNameIn.val())) {
        return;
    }

    if(checkTheChanges([deptBgIn, deptNameIn], [oldDeptPic, oldDeptName]) > 0) {
        let formData = new FormData();
        formData.append('oldDeptName', oldDeptName);
        formData.append('deptId', deptId);
        formData.append('deptName', deptNameIn.val());
        formData.append('deptBg', deptBgIn.val());

        $.ajax({
            type: "POST",
            url: "/AccountantEditDeptPost",
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if(response.status == 200) {
                    successModal.find('.modal-text').html('Changes Saved.');
                    showModal(successModal);
                    closeModalRedirect(successModal, `/ViewDept/${deptId}`);
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