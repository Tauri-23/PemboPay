// Btns
const addSalGradeBtn = $('#add-sal-grade-btn');
const addTaxExemptBtn = $('#add-tax-exempt-btn');

const salGradeBtn = $('#sal-grade-btn');
const taxExemptBtn = $('#tax-exempt-btn');
const allowanceBtn = $('#allowance-btn');
const deductionsBtn = $('#deductions-btn');
const payperiodBtn = $('#payperiod-btn');

const delTaxExemptBtns = $('.del-tax-exempt-btn');

const addAllowanceBtn = $('#add-allowance-btn');
const addDeductionsBtn = $('#add-deduction-btn');

const deleteAllowances = $('.del-btn-Allowances');
const deleteDeductions = $('.del-btn-Deductions');


// Rows
const salGradeRows = $('.salary-grade-row');


// Modals
const addSalGradeModal = $('#add-sal-grade-modal');
const editSalGradeModal = $('#edit-sal-grade-modal');
const addTaxExemptModal = $('#add-tax-exempt-modal');

const addAllowanceModal = $('#add-allowance-modal');
const addDeductionModal = $('#add-deduction-modal');

const warningYNModal = $('.warning-yn-modal');
const successModal = $('#success-modal');
const errorModal = $('#error-modal');


// Container
const salGradeTable = $('#sal-grade-table');
const taxExemptTable = $('#tax-exempt-table');
const allowancesTable = $('#allowances-table');
const deductionsTable = $('#deductions-table');
const payrollPeriodTable = $('#payroll-period-table');





/*
|----------------------------------------
| Container Events
|----------------------------------------
*/
salGradeBtn.click(() => {
    changeActiveContainer(salGradeBtn, salGradeTable);
});
taxExemptBtn.click(() => {
    changeActiveContainer(taxExemptBtn, taxExemptTable);
});
allowanceBtn.click(() => {
    changeActiveContainer(allowanceBtn, allowancesTable);
});
deductionsBtn.click(() => {
    changeActiveContainer(deductionsBtn, deductionsTable);
});
payperiodBtn.click(() => {
    changeActiveContainer(payperiodBtn, payrollPeriodTable);
});

function changeActiveContainer(activeBtn, activeCont) {
    salGradeBtn.removeClass('active');
    taxExemptBtn.removeClass('active');
    allowanceBtn.removeClass('active');
    deductionsBtn.removeClass('active');
    payperiodBtn.removeClass('active');

    salGradeTable.addClass('d-none');
    taxExemptTable.addClass('d-none');
    allowancesTable.addClass('d-none');
    deductionsTable.addClass('d-none');
    payrollPeriodTable.addClass('d-none');

    activeBtn.addClass('active');
    activeCont.removeClass('d-none');
}






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
| Tax Exempt
|----------------------------------------
*/
// Input
const addTaxExemptNameIn = addTaxExemptModal.find('#tax-name-in');
const addTaxExemptPeriodIn = addTaxExemptModal.find('#tax-period-in');

let filteredTaxExempt = [];

// ADD
addTaxExemptBtn.click(() => {
    showModal(addTaxExemptModal);
    closeModal(addTaxExemptModal, false);
});
addTaxExemptModal.find('#add-tax').click(() => {
    if(isEmptyOrSpaces(addTaxExemptNameIn.val())) {
        return;
    }

    let formData = new FormData();
    formData.append('name', addTaxExemptNameIn.val());
    formData.append('period', addTaxExemptPeriodIn.val());

    ajaxDb('/adminAddTaxExempt', formData);
});

// DELETE
delTaxExemptBtns.click(function() {
    filteredTaxExempt = taxExempts.filter(col => col.id == $(this).data('id'));

    warningYNModal.eq(1).find('.modal1-txt').html(`Do you want to delete Tax-exempt ${filteredTaxExempt[0].name}?`);
    showModal(warningYNModal.eq(1));
    closeModal(warningYNModal.eq(1), false);
});
warningYNModal.eq(1).find('.yes-btn').click(() => {
    let formData = new FormData();
    formData.append('id', filteredTaxExempt[0].id);
    ajaxDb('/adminDelTaxExemptPost', formData);
});





/*
|----------------------------------------
| Allowance
|----------------------------------------
*/
const allowanceNameIn = $('#allowance-name-in');
const allowanceTypeIn = $('#allowance-type-in');
const allowancePriceIn = $('#allowance-price-in');
const allowancePeriodIn = $('#allowance-period-in');

let filteredAllowance = [];
// ADD
addAllowanceBtn.click(() => {
    showModal(addAllowanceModal);
    closeModal(addAllowanceModal, false);
});
addAllowanceModal.find('#add-allowance').click(() => {
    if(isEmptyOrSpaces(allowanceNameIn.val()) || isEmptyOrSpaces(allowancePriceIn.val())) {
        return;
    }
    formData = new FormData();
    formData.append('name', allowanceNameIn.val());
    formData.append('type', allowanceTypeIn.val());
    formData.append('price', allowancePriceIn.val());
    formData.append('period', allowancePeriodIn.val());

    ajaxDb("/AddAllowancePost", formData);
});
deleteAllowances.click(function() {
    filteredAllowance = allowances.filter(col => col.id == $(this).attr('id'));
    warningYNModal.eq(2).find('.modal1-txt').html(`Do you want to delete Allowance ${filteredAllowance[0].name}?`);
    showModal(warningYNModal.eq(2));
    closeModal(warningYNModal.eq(2), false);
});
warningYNModal.eq(2).find('.yes-btn').click(() => {
    formData = new FormData();
    formData.append('id', filteredAllowance[0].id);
    ajaxDb("/DelAllowancenPost", formData);
});





/*
|----------------------------------------
| Deductions
|----------------------------------------
*/
const deductionNameIn = $('#deduction-name-in');
const deductionTypeIn = $('#deduction-type-in');
const deductionPriceIn = $('#deduction-price-in');
const deductionPeriodIn = $('#deduction-period-in');

let filteredDeduction = [];

// ADD
addDeductionsBtn.click(() => {
    showModal(addDeductionModal);
    closeModal(addDeductionModal, false);
})
addDeductionModal.find('#add-deduction').click(() => {
    if(isEmptyOrSpaces(deductionNameIn.val()) || isEmptyOrSpaces(deductionPriceIn.val())) {
        return;
    }
    formData = new FormData();
    formData.append('name', deductionNameIn.val());
    formData.append('type', deductionTypeIn.val());
    formData.append('price', deductionPriceIn.val());
    formData.append('period', deductionPeriodIn.val());

    ajaxDb("/AddDeductionPost", formData);
});

// DELETE
deleteDeductions.click(function() {
    filteredDeduction = deductions.filter(col => col.id == $(this).attr('id'));

    warningYNModal.eq(3).find('.modal1-txt').html(`Do you want to delete Deduction ${filteredDeduction[0].name}?`);
    showModal(warningYNModal.eq(3));
    closeModal(warningYNModal.eq(3), false);

    
});
warningYNModal.eq(3).find('.yes-btn').click(() => {
    formData = new FormData();
    formData.append('id', filteredDeduction[0].id);

    ajaxDb("/DelDeductionPost", formData);
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