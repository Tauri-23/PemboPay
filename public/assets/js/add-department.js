$(document).ready(function() {

    const selectDeptScript = new SelectDept();
    const addDeptScript = new FormValidator();
});





/*
|----------------------------------------
|Main Class
|----------------------------------------
*/
class Main {
    constructor() {
        //inputs
        this.deptnameIn = $('#dept-name-in');
        this.deptBgIn = $('#dept-bg-in');

        //department bg choices
        this.deptBgs = $('.dept-bg-select-cont');
        this.overLayAll = $('.deptBgOverlay');

        //Messages (For empty fields)
        this.deptMsg = $('#dept-name-required');

        //Btns
        this.clearSelectionBtn = $('#clear-selection');
        this.addDepartmentBtn = $('#add-department');
    }
}





/*
|----------------------------------------
|Select Dept Class
|----------------------------------------
*/
class SelectDept extends Main {
    constructor() {
        super();
        this.deptBgs.click((event) => this.deptBgHandler(event));
        this.clearSelectionBtn.click(this.removeActiveSelect.bind(this));
    }

    //select department bg event
    deptBgHandler(event) {
        const selectedDeptBgs = $(event.currentTarget);
        const bgPic = selectedDeptBgs.find('.dept-bg-pic').attr('id');
        const bgPicOverlay = selectedDeptBgs.find('.deptBgOverlay');

        this.removeActiveSelect();

        $(this).addClass('active');
        bgPicOverlay.removeClass('d-none');
        this.clearSelectionBtn.removeClass('d-none');
        this.deptBgIn.attr('value', bgPic);
    }

    removeActiveSelect() {
        this.deptBgs.removeClass('active');
        this.overLayAll.addClass('d-none');
        this.clearSelectionBtn.addClass('d-none');
        this.deptBgIn.attr('value', '');
    }
}





/*
|----------------------------------------
|Select Dept Class
|----------------------------------------
*/
class FormValidator extends Main {
    constructor() {
        super();
        this.addDepartmentBtn.click((event) => this.submitSetup(event));

    }

    submitSetup(event) {
        event.preventDefault();

        this.emptyMessagesValidator();
        if(!this.ifReadyToSubmit()) {
            return;
        }

        let formData = new FormData();
        formData.append("dept_name", this.deptnameIn.val());
        formData.append("dept_pfp", this.deptBgIn.val());

        $.ajax({
            type: "POST",
            url: "/TreasuryAddDepartmentPost",
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if(response.status == 200) {
                    $('#success-modal').find('.modal-text').html('Department added successfully.');
                    showModal($('#success-modal'));
                    closeModalRedirect($('#success-modal'), '/TreasuryDepartments');
                } else {
                    $('#error-modal').find('.modal-text').html('Failed adding department please try again later.');
                    showModal($('#error-modal'));
                    closeModalRedirect($('#error-modal'), '/TreasuryDepartments');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('error');
            }
        });

    }

    emptyMessagesValidator() {
        this.deptMsg.toggleClass('d-none', !isEmptyOrSpaces(this.deptnameIn.val()));
    }

    ifReadyToSubmit() {
        return !isEmptyOrSpaces(this.deptnameIn.val());
    }
}