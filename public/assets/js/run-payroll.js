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


runPayrollBtn.click(() => {
    computePayroll();
    removeAllContainer();
    payrollPreviewContainer.removeClass('d-none');
});

cancelPayrollBtn.click(() => {
    removeAllContainer();
    runPayrollContainer.removeClass('d-none');
});

approvePayrollBtn.click(()=> {
    infoYNModal.find('.modal1-txt').html('Do you want to approve this payroll?');
    showModal(infoYNModal);
    closeModal(infoYNModal, false);
});

infoYNModal.find('.yes-btn').click(() => {
    closeModalNoEvent(infoYNModal);
    successModal.find('.modal1-txt').html('Payroll Successfully Approved');
    showModal(successModal);
    closeModal(successModal, true);
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