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





//generate Payslip event
generatePayslipBtn.click(function() {
    let formData = new FormData();
    formData.append('payPeriod', `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`);

    $.ajax({
        url: '/EmployeecheckPayslipAvailability',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        // dataType: 'json',
        success: function (response) {
            if(response.status == 200) {
                generatePayslip();
            } else {
                errorModal.find('.modal1-txt').html(response.message);
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
    let payrollPeriod = `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`
    window.location.href = `/EmployeeGeneratePayslip/${payrollPeriod}`;
}