//btns
const taxesBtn = $('#taxes-btn');
const allowanceBtn = $('#allowance-btn');
const deductionsBtn = $('#deductions-btn');
const payPeriodBtn = $('#payperiod-btn');

const addTaxesBtn = $('#add-tax-btn');
const addAllowanceBtn = $('#add-allowance-btn');
const addDeductionsBtn = $('#add-deduction-btn');

const deleteTaxes = $('.del-btn-Taxes')
const deleteAllowances = $('.del-btn-Allowances');
const deleteDeductions = $('.del-btn-Deductions');


//containers
const taxTable = $('#tax-table');
const allowanceTable = $('#allowances-table');
const deductionsTable = $('#deductions-table');


//modals
const addTaxModal = $('#add-taxes-modal');
const addAllowanceModal = $('#add-allowance-modal');
const addDeductionModal = $('#add-deduction-modal');

//inputs
//addTax
const taxNameIn = $('#tax-name-in');
const taxTypeIn = $('#tax-type-in');
const taxPriceIn = $('#tax-price-in');
const taxPeriodIn = $('#tax-period-in');
//add allowance
const allowanceNameIn = $('#allowance-name-in');
const allowanceTypeIn = $('#allowance-type-in');
const allowancePriceIn = $('#allowance-price-in');
const allowancePeriodIn = $('#allowance-period-in');
//add deduction
const deductionNameIn = $('#deduction-name-in');
const deductionTypeIn = $('#deduction-type-in');
const deductionPriceIn = $('#deduction-price-in');
const deductionPeriodIn = $('#deduction-period-in');


taxesBtn.click(()=>{
    removeContainers();
    removeActiveBtns();
    taxesBtn.addClass('active');
    taxTable.removeClass('d-none');
});
allowanceBtn.click(()=>{
    removeContainers();
    removeActiveBtns();
    allowanceBtn.addClass('active');
    allowanceTable.removeClass('d-none');
});
deductionsBtn.click(()=>{
    removeContainers();
    removeActiveBtns();
    deductionsBtn.addClass('active');
    deductionsTable.removeClass('d-none');
});


//reset layout and colors
function removeContainers() {
    taxTable.addClass('d-none');
    allowanceTable.addClass('d-none');
    deductionsTable.addClass('d-none');
}
function removeActiveBtns() {
    taxesBtn.removeClass('active');
    allowanceBtn.removeClass('active');
    deductionsBtn.removeClass('active');
    payPeriodBtn.removeClass('active');
}


//Add Buttons Click
addTaxesBtn.click(() => {
    showModal(addTaxModal);
    closeModal(addTaxModal, false);
});
addAllowanceBtn.click(() => {
    showModal(addAllowanceModal);
    closeModal(addAllowanceModal, false);
});
addDeductionsBtn.click(() => {
    showModal(addDeductionModal);
    closeModal(addDeductionModal, false);
})





//function for add form processing
addTaxModal.find('#add-tax').click(() => {
    if(isEmptyOrSpaces(taxNameIn.val()) || isEmptyOrSpaces(taxPriceIn.val())) {
        return;
    }
    formData = new FormData();
    formData.append('name', taxNameIn.val());
    formData.append('type', taxTypeIn.val());
    formData.append('price', taxPriceIn.val());
    formData.append('period', taxPeriodIn.val());

    DbAjax(formData, "/AddTaxPost", function(response) {
        if(response.status == 200) {
            $('#success-modal').find('.modal-text').html('Tax added successfully.');
            showModal($('#success-modal'));
            closeModal($('#success-modal'), true);
        } else {
            $('#error-modal').find('.modal-text').html('Failed adding Tax please try again later.');
            showModal($('#error-modal'));
            closeModal($('#error-modal'), true);
        }
    });
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

    DbAjax(formData, "/AddAllowancePost", function(response) {
        if(response.status == 200) {
            $('#success-modal').find('.modal-text').html('Allowance added successfully.');
            showModal($('#success-modal'));
            closeModal($('#success-modal'), true);
        } else {
            $('#error-modal').find('.modal-text').html('Failed adding Allowance please try again later.');
            showModal($('#error-modal'));
            closeModal($('#error-modal'), true);
        }
    });
});

addDeductionModal.find('#add-deduction').click(() => {
    if(isEmptyOrSpaces(deductionNameIn.val()) || isEmptyOrSpaces(deductionPriceIn.val())) {
        return;
    }
    formData = new FormData();
    formData.append('name', deductionNameIn.val());
    formData.append('type', deductionTypeIn.val());
    formData.append('price', deductionPriceIn.val());
    formData.append('period', deductionPeriodIn.val());

    DbAjax(formData, "/AddDeductionPost", function(response) {
        if(response.status == 200) {
            $('#success-modal').find('.modal-text').html('Deduction added successfully.');
            showModal($('#success-modal'));
            closeModal($('#success-modal'), true);
        } else {
            $('#error-modal').find('.modal-text').html('Failed adding Deduction please try again later.');
            showModal($('#error-modal'));
            closeModal($('#error-modal'), true);
        }
    });
});





//Delete event
deleteDeductions.click(function() {
    formData = new FormData();
    formData.append('id', $(this).attr('id'));

    DbAjax(formData, "/DelDeductionPost", function(response) {
        if(response.status == 200) {
            $('#success-modal').find('.modal-text').html('Deduction deleted successfully.');
            showModal($('#success-modal'));
            closeModal($('#success-modal'), true);
        } else {
            $('#error-modal').find('.modal-text').html('Failed deleting Deduction please try again later.');
            showModal($('#error-modal'));
            closeModal($('#error-modal'), true);
        }
    });
});

deleteAllowances.click(function() {
    formData = new FormData();
    formData.append('id', $(this).attr('id'));

    DbAjax(formData, "/DelAllowancenPost", function(response) {
        if(response.status == 200) {
            $('#success-modal').find('.modal-text').html('Deduction deleted successfully.');
            showModal($('#success-modal'));
            closeModal($('#success-modal'), true);
        } else {
            $('#error-modal').find('.modal-text').html('Failed deleting Deduction please try again later.');
            showModal($('#error-modal'));
            closeModal($('#error-modal'), true);
        }
    });
});

deleteTaxes.click(function() {
    formData = new FormData();
    formData.append('id', $(this).attr('id'));

    DbAjax(formData, "/DelTaxPost", function(response) {
        if(response.status == 200) {
            $('#success-modal').find('.modal-text').html('Deduction deleted successfully.');
            showModal($('#success-modal'));
            closeModal($('#success-modal'), true);
        } else {
            $('#error-modal').find('.modal-text').html('Failed deleting Deduction please try again later.');
            showModal($('#error-modal'));
            closeModal($('#error-modal'), true);
        }
    });
});





//
function DbAjax(formData, url, callback) {
    $.ajax({
        type: "POST",
        url: url,
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            callback(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
}

