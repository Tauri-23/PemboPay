//Modals
const infoYNModal = $('#info-yn-modal');
const successModal = $('#success-modal');

//Btns
const runPayrollBtn = $('#run-payroll-btn');
const approvePayrollBtn = $('#approve-payroll-btn');
const cancelPayrollBtn = $('#cancel-payroll-btn');

//Containers
const runPayrollContainer = $('#run-payroll');
const payrollPreviewContainer = $('#payroll-preview');

//inputs
const yearIn =$('#select-year');
const monthIn = $('#select-month');
const periodIn = $('#select-period');


runPayrollBtn.click(() => {
    infoYNModal.find('.modal1-txt').html(`Do you want to compute the payrol of ${monthIn.val()} ${periodIn.val()} , ${yearIn.val()}`);
    showModal(infoYNModal);
    closeModal(infoYNModal, false);

    //Run Payroll
    infoYNModal.find('.yes-btn').click(() => {
        closeModalNoEvent(infoYNModal);
        computePayroll();
        removeAllContainer();
        payrollPreviewContainer.removeClass('d-none');

        formData = new FormData();
        formData.append('month', monthIn.val());
        formData.append('period', periodIn.val());
        formData.append('year', yearIn.val());

        $.ajax({
            type: "POST",
            url: "/AccountantProcessPayroll",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                // if(response.status == 200) {
                //     $('#success-modal').find('.modal-text').html('Employee added successfully.');
                //     showModal($('#success-modal'));
                //     closeModalRedirect($('#success-modal'), '/TreasuryEmployees');
                // } else {
                //     $('#error-modal').find('.modal-text').html('Failed adding employee please try again later.');
                //     showModal($('#error-modal'));
                //     closeModalRedirect($('#error-modal'), '/TreasuryEmployees');
                // }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('error');
            }
        });
    });
    
});

cancelPayrollBtn.click(() => {
    removeAllContainer();
    runPayrollContainer.removeClass('d-none');
});

approvePayrollBtn.click(()=> {
    infoYNModal.find('.modal1-txt').html('Do you want to approve this payroll?');
    showModal(infoYNModal);
    closeModal(infoYNModal, false);

    infoYNModal.find('.yes-btn').click(() => {
        closeModalNoEvent(infoYNModal);
        successModal.find('.modal1-txt').html('Payroll Successfully Approved');
        showModal(successModal);
        closeModal(successModal, true);
    });
});





function removeAllContainer() {
    runPayrollContainer.addClass('d-none');
    payrollPreviewContainer.addClass('d-none');
}

function computePayroll() {
    //TODO:: redirect to controller using ajax and compute using services.
}

function savePayrollToDB() {
    //TODO:: ajax save payroll to db.
}