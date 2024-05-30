// Btns
const addPositionBtn = $('#add-position');

// Modals
const addDeptPositionModal = $('#add-dept-position-modal');
const editDeptPositionModal = $('#edit-dept-position-modal');

const warningYNModal = $('.warning-yn-modal');
const successModal = $('#success-modal');
const errorModal = $('#error-modal');

// Rows
const positionRows = $('.position-row');




/*
|----------------------------------------
| Admin
|----------------------------------------
*/
// Inputs
const addPositionPositionIn = addDeptPositionModal.find('#position-in');
const addPositionSalGradeIn = addDeptPositionModal.find('#sal-grade-in');

const editPositionPositionIn = editDeptPositionModal.find('#position-in');
const editPositionSalGradeIn = editDeptPositionModal.find('#sal-grade-in');

let filteredPositions = [];

// ADD
addPositionBtn.click(() => {
    showModal(addDeptPositionModal);
    closeModal(addDeptPositionModal, false);

    salGrades.forEach(element => {
        addPositionSalGradeIn.append(`<option value="${element.id}">${element.grade}</option>`);
    });
});
addDeptPositionModal.find('#add-dept-position').click(() => {
    if(isEmptyOrSpaces(addPositionPositionIn.val()) || isEmptyOrSpaces(addPositionSalGradeIn.val())) {
        return;
    }

    let formData = new FormData();
    formData.append('dept', deptId);
    formData.append('position', addPositionPositionIn.val());
    formData.append('salGrade', addPositionSalGradeIn.val());

    ajaxDb('/adminAddDeptPos', formData);
});

// EDIT
positionRows.find('.edit-btn').click(function() {
    filteredPositions = positions.filter(col => col.id == $(this).data('id'));

    salGrades.forEach(element => {
        editPositionSalGradeIn.append(`<option value="${element.id}">${element.grade}</option>`);
    });

    editPositionPositionIn.val(filteredPositions[0].position);
    editPositionSalGradeIn.val(filteredPositions[0].salary_grade);

    showModal(editDeptPositionModal);
    closeModal(editDeptPositionModal, false);
});
editDeptPositionModal.find('#edit-dept-position').click(() => {
    if(isEmptyOrSpaces(editPositionPositionIn.val()) || isEmptyOrSpaces(editPositionSalGradeIn.val())) {
        return;
    }
    
    if(checkTheChanges([editPositionPositionIn, editPositionSalGradeIn], [filteredPositions[0].position ,filteredPositions[0].salary_grade]) > 0) {
        let formData = new FormData();
        formData.append('id', filteredPositions[0].id);
        formData.append('dept', deptId);
        formData.append('position', editPositionPositionIn.val());
        formData.append('salGrade', editPositionSalGradeIn.val());

        ajaxDb('/adminEditDeptPos', formData);
    }
});

// DELETE
positionRows.find('.del-btn').click(function() {
    filteredPositions = positions.filter(col => col.id == $(this).data('id'));

    warningYNModal.eq(0).find('.modal1-txt').html(`Do you want to delete ${filteredPositions[0].position}?`);
    showModal(warningYNModal.eq(0));
    closeModal(warningYNModal.eq(0), false);
});
warningYNModal.eq(0).find('.yes-btn').click(() => {
    let formData = new FormData();
    formData.append('id', filteredPositions[0].id);
    ajaxDb('/adminDelDeptPos', formData);
});






/*
|----------------------------------------
| Ajax
|----------------------------------------
*/
function ajaxDb(link, formData) {
    $.ajax({
        type: "POST",
        url: link,
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            if(response.status == 200) {
                successModal.find('.modal-text').html(response.message);
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal-text').html(response.message);
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