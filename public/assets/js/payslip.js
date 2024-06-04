//columns
const employeeRows = $('.employee-row');

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

    let formData = new FormData();
    formData.append('payPeriod', `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`);
    employeeIds.forEach(id => formData.append('employees[]', id));

    $.ajax({
        url: '/checkPayslipAvailability',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        // dataType: 'json',
        success: function (response) {
            if(response.status == 200) {
                generatePayslip();
            } else {
                errorModal.find('.modal1-txt').html(`There are no payroll records for the month of ${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`);
                showModal(errorModal);
                closeModal(errorModal);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
});


function generatePayslip() {
    let empIdsFinal = JSON.stringify(employeeIds);
    let payrollPeriod = `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`
    window.location.href = `/AccountantGeneratePayslip/${empIdsFinal}/${payrollPeriod}`;
}




//employee colum event
employeeRows.click(function() {
    console.log($(this).attr('id'));
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