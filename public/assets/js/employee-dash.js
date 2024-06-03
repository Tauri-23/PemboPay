//Btns
const timeInBtn = $('#time-in-btn');
const timeOutBtn = $('#time-out-btn');
const timeInExpressBtn = $('#time-in-express-btn');

// Inputs
const empIdIn = $('#emp-id-in');

//modals
const successModal = $('#success-modal');
const errorModal = $('#error-modal');




timeInExpressBtn.click(() => {
    let timeInOut = formatDate(new Date());

    if(isEmptyOrSpaces(empIdIn.val())) {
        errorModal.find('.modal1-txt').html('Please fill up the fields.');
        showModal(errorModal);
        closeModal(errorModal, false);
        return;
    }

    let formData = new FormData;
    formData.append('empId', empIdIn.val());
    formData.append('timeInOut', timeInOut);

    //alert(timedIn);

    $.ajax({
        type: "POST",
        url: "/timeInExpressPost",
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            if(response.status == 200) {
                successModal.find('.modal1-txt').html(response.message);
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal1-txt').html(response.message);
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





timeInBtn.click(() => {
    let timedIn = formatDate(new Date());

    let formData = new FormData;
    formData.append('empId', $('#emp-id').val());
    formData.append('timein', timedIn);

    //alert(timedIn);

    $.ajax({
        type: "POST",
        url: "/timeIn",
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            if(response.status == 200) {
                successModal.find('.modal1-txt').html('success');
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal1-txt').html('Error try again later.');
                showModal(errorModal);
                closeModal(errorModal, true);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });

});

timeOutBtn.click(() => {
    let timedOut = formatDate(new Date());

    let formData = new FormData();
    formData.append('attendanceId', $('#attendance-id').val());
    formData.append('timeout', timedOut);

    $.ajax({
        type: "POST",
        url: "/timeOut",
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
            if(response.status == 200) {
                successModal.find('.modal1-txt').html('success');
                showModal(successModal);
                closeModal(successModal, true);
            } else {
                errorModal.find('.modal1-txt').html('Error try again later.');
                showModal(errorModal);
                closeModal(errorModal, true);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('error');
        }
    });
});



setInterval(() => $("#dateTime").text(new Date().toLocaleString()), 1000);
