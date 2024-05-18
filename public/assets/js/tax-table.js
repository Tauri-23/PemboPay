// Btns
const addTaxColumnBtn = $('#add-tax-col-btn');

const taxColumnDelBtns = $('.del-btn');

// Modals
const successModal = $('#success-modal');
const errorModal = $('#error-modal');
const addTaxColumnModal = $('#add-tax-column-modal');

// Input
const valPercentIn = $('#val-percent-in');
const valAmountIn = $('#val-amount-in');
const thresholdMinIn = $('#threshold-min-in');
const thresholdMaxIn = $('#threshold-max-in');



addTaxColumnBtn.click(() => {
    showModal(addTaxColumnModal);
    closeModal(addTaxColumnModal, false);
});

addTaxColumnModal.find('#add-tax').click(() => {
    if(isEmptyOrSpaces(thresholdMinIn.val()) 
        || isEmptyOrSpaces(valPercentIn.val()) || isEmptyOrSpaces(valAmountIn.val())
        || isEmptyOrSpaces(thresholdMaxIn.val())) {
        return;
    }

    let formData = new FormData();
    formData.append('taxId', taxId);
    formData.append('valuePercent', valPercentIn.val());
    formData.append('valueAmt', valAmountIn.val());
    formData.append('thresholdMin', thresholdMinIn.val());
    formData.append('thresholdMax', thresholdMaxIn.val());

    $.ajax({
        type: "POST",
        url: "/AccountantAddTaxCol",
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if(response.status == 200) {
                successModal.find('.modal-text').html(response.message);
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal-text').html(response.message);
                showModal(errorModal);
                closeModal(errorModal, false);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
});

let deleteTaxColId = "";
taxColumnDelBtns.click(function() {
    deleteTaxColId = $(this).attr('id');
});