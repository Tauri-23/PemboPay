//columns
const employeeColumns = $('.employee-column');

//btns
const generatePayslipBtn = $('#generate-pay-slip');

//modals
const successModal = $('#success-modal');
const errorModal= $('#error-modal');

//inputs
const monthIn = $('#month');
const periodIn = $('#period');
const yearIn = $('#year')

//Lists
let employeeIds = [];





//generate Payslip event
generatePayslipBtn.click(function() {
    if(employeeIds.length < 1) {
        errorModal.find('.modal1-txt').html('Please select an employee to generate payslip.');
        showModal(errorModal);
        closeModal(errorModal);
        return;
    }
    let empIdsFinal = JSON.stringify(employeeIds);
    let payrollPeriod = `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`
    window.location.href = `/AccountantGeneratePayslip/${empIdsFinal}/${payrollPeriod}`;
});





//employee colum event
employeeColumns.click(function() {
    let id = $(this).attr('id');

    //console.log(id);
    if(employeeIds.indexOf(id) < 0) {
        addEmployeeId(id);
        $(this).addClass('active');
        return;
    }
    $(this).removeClass('active');
    removeEmployeeId(id);
});

function addEmployeeId(item) {
    employeeIds.push(item);
}

function removeEmployeeId(item) {
    const index = employeeIds.indexOf(item);
    if (index > -1) {
        employeeIds.splice(index, 1);
    }
}