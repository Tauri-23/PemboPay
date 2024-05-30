// Btns
const addSalGradeBtn = $('#add-sal-grade-btn');

// Rows
const salGradeRows = $('.salary-grade-row');

// Modals
const addSalGradeModal = $('#add-sal-grade-modal');
const editSalGradeModal = $('#edit-sal-grade-modal');

const warningYNModal = $('.warning-yn-modal');
const successModal = $('#success-modal');
const errorModal = $('#error-modal');





/*
|----------------------------------------
| Salary Grade
|----------------------------------------
*/
// inputs
const AddSalGradeGradeIn = addSalGradeModal.find('#grade-in');
const AddSalGradeValueIn = addSalGradeModal.find('#value-in');

const EditSalGradeGradeIn = editSalGradeModal.find('#grade-in');
const EditSalGradeValueIn = editSalGradeModal.find('#value-in');

let filteredSalGrades = [];

// Add
addSalGradeBtn.click(() => {
    showModal(addSalGradeModal);
    closeModal(addSalGradeModal, false);
});
addSalGradeModal.find('#add-sal-grade').click(() => {
    if(isEmptyOrSpaces(AddSalGradeGradeIn.val()) || isEmptyOrSpaces(AddSalGradeValueIn.val())) {
        return;
    }
    let formData = new FormData();
    formData.append('grade', AddSalGradeGradeIn.val());
    formData.append('value', AddSalGradeValueIn.val());
    ajaxDb('/adminAddSalGrade', formData);
});

// Edit
salGradeRows.find('.edit-btn').click(function() {
    filteredSalGrades = salGrades.filter(col => col.id == $(this).data('id'));
    EditSalGradeGradeIn.val(filteredSalGrades[0].grade);
    EditSalGradeValueIn.val(filteredSalGrades[0].value);

    showModal(editSalGradeModal);
    closeModal(editSalGradeModal, false);
});
editSalGradeModal.find('#edit-sal-grade').click(() => {
    if(isEmptyOrSpaces(EditSalGradeGradeIn.val()) || isEmptyOrSpaces(EditSalGradeValueIn.val())) {
        return;
    }

    if(checkTheChanges([EditSalGradeGradeIn, EditSalGradeValueIn], [filteredSalGrades[0].grade, filteredSalGrades[0].value]) > 0) {
        let formData = new FormData();
        formData.append('id', filteredSalGrades[0].id);
        formData.append('grade', EditSalGradeGradeIn.val());
        formData.append('value', EditSalGradeValueIn.val());
        ajaxDb('/adminEditSalGrade', formData);
    }
});

// Delete
salGradeRows.find('.del-btn').click(function() {
    filteredSalGrades = salGrades.filter(col => col.id == $(this).data('id'));

    warningYNModal.eq(0).find('.modal1-txt').html(`Do you want to delete ${filteredSalGrades[0].grade}?`);
    showModal(warningYNModal.eq(0));
    closeModal(warningYNModal.eq(0), false);
});
warningYNModal.eq(0).find('.yes-btn').click(() => {
    let formData = new FormData();
    formData.append('id', filteredSalGrades[0].id);
    ajaxDb('/adminDelSalGrade', formData);
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
                $('#success-modal').find('.modal-text').html(response.message);
                showModal($('#success-modal'));
                closeModal($('#success-modal'), true);
            } else {
                $('#error-modal').find('.modal-text').html(response.message);
                showModal($('#error-modal'));
                closeModal($('#error-modal'), false);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
}