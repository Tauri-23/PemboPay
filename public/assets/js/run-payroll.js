//Modals
const infoYNModals = $('.info-yn-modal');
const successModal = $('#success-modal');
const errorModal = $('#error-modal');

//Btns
const runPayrollBtn = $('#run-payroll-btn');
const approvePayrollBtn = $('#approve-payroll-btn');
const cancelPayrollBtn = $('#cancel-payroll-btn');

//Containers
const runPayrollContainer = $('#run-payroll');
const payrollPreviewContainer = $('#payroll-preview');
const payrollPreviewColumns = $('#payroll-preview-columns');

//inputs
const yearIn =$('#select-year');
const monthIn = $('#select-month');
const periodIn = $('#select-period');

//texts
const payrollPreviewTitle = $('#payroll-preview-title');


runPayrollBtn.click(() => {
    infoYNModals.eq(0).find('.modal1-txt').html(`Do you want to compute the payrol of ${monthIn.val()} ${periodIn.val()} , ${yearIn.val()}`);
    showModal(infoYNModals.eq(0));
    closeModal(infoYNModals.eq(0), false);

    //Run Payroll
    infoYNModals.eq(0).find('.yes-btn').click(() => {
        closeModalNoEvent(infoYNModals.eq(0));
        

        data = new FormData();
        data.append('month', monthIn.val());
        data.append('period', periodIn.val());
        data.append('year', yearIn.val());
        
        computePayroll(data, function(response) {

            if(response.status == 200) {
                removeAllContainer();
                payrollPreviewContainer.removeClass('d-none');
                payrollPreviewColumns.html();
                payrollPreviewTitle.html(`Payroll Preview (${response.period})`);
                console.log(response);
                response.temp_payroll_records.forEach(element => {

                    payrollPreviewColumns.append(`<div  class="table1-data employee-column">
                        <small class="form-data-col emp-id">${element.employee}</small>
                        <small class="form-data-col emp-dept">${element.department}</small>
                        <small class="form-data-col">${element.compensation_type}</small>
                        <small class="form-data-col">${element.gross_pay}</small>
                        <small class="form-data-col">${element.net_pay}</small>
                    </div>`);
                });
                approvePayroll(response);
            }
            else {
                errorModal.find('.modal1-txt').html('There is existing payroll for this period');
                showModal(errorModal);
                closeModal(errorModal, true);
            }
        });

        
    });
    
});

cancelPayrollBtn.click(() => {
    removeAllContainer();
    runPayrollContainer.removeClass('d-none');
});







function removeAllContainer() {
    runPayrollContainer.addClass('d-none');
    payrollPreviewContainer.addClass('d-none');
    payrollPreviewColumns.html();
}

function computePayroll(formData, callback) {
    $.ajax({
        type: "POST",
        url: "/AccountantProcessPayroll",
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            callback(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
}

function approvePayroll(response) { 

    approvePayrollBtn.click(()=> {
        infoYNModals.eq(1).find('.modal1-txt').html('Do you want to approve this payroll?');
        showModal(infoYNModals.eq(1));
        closeModal(infoYNModals.eq(1), false);
    
        infoYNModals.eq(1).find('.yes-btn').click(() => {

            closeModalNoEvent(infoYNModals.eq(1));

            formData = new FormData();
            formData.append('temp_payroll_records', JSON.stringify(response.temp_payroll_records));
            formData.append('temp_payroll_record_summaries', JSON.stringify(response.temp_payroll_record_summaries));
            formData.append('temp_allowance_records', JSON.stringify(response.temp_allowance_records));
            formData.append('temp_allowance_records_employees', JSON.stringify(response.temp_allowance_records_employees));
            formData.append('temp_deduction_records', JSON.stringify(response.temp_deduction_records));
            formData.append('temp_deduction_records_employees', JSON.stringify(response.temp_deduction_records_employees));
            formData.append('temp_taxes_records', JSON.stringify(response.temp_taxes_records));
            

            savePayrollToDB(formData, function(response) {
                if(response.status == 200) {
                    successModal.find('.modal1-txt').html('Payroll Successfully Approved');
                    showModal(successModal);
                    closeModal(successModal, true);
                }
                
            });
            
        });
    });
}

function savePayrollToDB(formData, callback) {
    $.ajax({
        type: "POST",
        url: "/AccountantSaveDbPayroll",
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            callback(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
}