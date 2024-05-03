//Btns
const generateReportBtn = $('#generate-report-btn');

//inputs
const monthIn = $('#month-in');
const periodIn = $('#period-in');
const yearIn = $('#year-in');

//Modal
const successModal = $('#success-modal');
const errorModal= $('#error-modal');




generateReportBtn.click(()=> {
    let formData = new FormData();
    formData.append('payPeriod', `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`);

    $.ajax({
        url: '/checkPayslipAvailability',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        // dataType: 'json',
        success: function (response) {
            if(response.status == 200) {
                generateReport();
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




function generateReport() {
    let payrollPeriod = `${periodIn.val()} ${monthIn.val()} ${yearIn.val()}`
    window.location.href = `/AccountantGenerateReport/${payrollPeriod}`;
}