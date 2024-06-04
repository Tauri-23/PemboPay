// Btns
const addTaxExemptBtn = $('#add-tax-exempt-row-btn');

const taxColumnDelBtns = $('.del-btn');
const taxColumnEditBtns = $('.edit-btn');

// Modals
const successModal = $('#success-modal');
const errorModal = $('#error-modal');
const warningYNModal = $('#warning-yn-modal');
const addTaxColumnModal = $('#add-tax-column-modal');
const editTaxColumnModal = $('#edit-tax-column-modal');

// Input
const valPercentIn = $('#val-percent-in');
const valAmountIn = $('#val-amount-in');
const thresholdMinIn = $('#threshold-min-in');
const thresholdMaxIn = $('#threshold-max-in');

const editValPercentIn = editTaxColumnModal.find('#val-percent-in');
const editValAmountIn = editTaxColumnModal.find('#val-amount-in');
const editThresholdMinIn = editTaxColumnModal.find('#threshold-min-in');
const editThresholdMaxIn = editTaxColumnModal.find('#threshold-max-in');



addTaxExemptBtn.click(() => {
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
        url: "/AdminAddTaxExemptRow",
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




// Delete Tax Column
let deleteTaxColId = "";
taxColumnDelBtns.click(function() {
    deleteTaxColId = $(this).attr('id');
    warningYNModal.find('.modal1-txt').html(`Are you sure do you want to delete this column ${deleteTaxColId}?`);
    showModal(warningYNModal);
    closeModal(warningYNModal, false);
});
warningYNModal.find('.yes-btn').click(() => {
    let formData = new FormData();
        formData.append('taxId', taxId);
        formData.append('taxColId', deleteTaxColId);

        $.ajax({
            type: "POST",
            url: "/AdminDelTaxExemptRow",
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




// Edit Tax
let editTaxCol = [];
taxColumnEditBtns.click(function() {
    editTaxCol = taxExemptRows.filter(tax => tax.id == $(this).attr('id'));

    editValPercentIn.val(editTaxCol[0].price_percent);
    editValAmountIn.val(editTaxCol[0].price_amount);
    editThresholdMinIn.val(editTaxCol[0].threshold_min);
    editThresholdMaxIn.val(editTaxCol[0].threshold_max);

    showModal(editTaxColumnModal);
    closeModal(editTaxColumnModal, false);
});

editTaxColumnModal.find('#save-edit-tax').click(function() {
    if(isEmptyOrSpaces(editValPercentIn.val()) || isEmptyOrSpaces(editValAmountIn.val())
        || isEmptyOrSpaces(editThresholdMinIn.val()) || isEmptyOrSpaces(editThresholdMaxIn.val())) {
        return;
    }

    if(checkTheChanges([ editValPercentIn, editValAmountIn, editThresholdMinIn, editThresholdMaxIn], 
        [ editTaxCol[0].price_percent, editTaxCol[0].price_amount, editTaxCol[0].threshold_min, editTaxCol[0].threshold_max]) > 0) {
        
        let formData = new FormData();
        formData.append('taxId', taxId);
        formData.append('taxColId', editTaxCol[0].id);
        formData.append('valuePercent', editValPercentIn.val());
        formData.append('valueAmt', editValAmountIn.val());
        formData.append('thresholdMin', editThresholdMinIn.val());
        formData.append('thresholdMax', editThresholdMaxIn.val());

        $.ajax({
            type: "POST",
            url: "/AdminEditTaxExemptRow",
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
    }
});