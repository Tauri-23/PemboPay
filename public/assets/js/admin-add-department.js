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
        this.deptTagIn = $('#dept-tag-in');
        this.deptBgIn = $('#dept-bg-in');

        //department bg choices
        this.deptBgs = $('.dept-bg-select-cont');
        this.overLayAll = $('.deptBgOverlay');

        //Messages (For empty fields)
        this.deptMsg = $('#dept-name-required');
        this.deptTagMsg = $('#dept-tag-required');
        this.deptPicMsg = $('#dept-pic-required');

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
|Form validator and add department Class
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

        $('#info-yn-modal').find('.modal1-txt').html('Do you want to add this department?');
        showModal($('#info-yn-modal'));
        closeModal($('#info-yn-modal'), false);

        const yesBtn = $('.yes-btn');

        yesBtn.click(()=> {
            closeModalNoEvent($('#info-yn-modal'));
            this.addDeptDb();
        });
    }

    addDeptDb() {
        let formData = new FormData();
        formData.append('name', this.deptnameIn.val());
        formData.append('tag', this.deptTagIn.val().toUpperCase());
        formData.append('pfp', this.deptBgIn.val());

        $.ajax({
            type: "POST",
            url: "/AdminAddDepartmentPost",
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                if(response.status == 200) {
                    $('#success-modal').find('.modal-text').html(response.message);
                    showModal($('#success-modal'));
                    closeModalRedirect($('#success-modal'), '/AdminDepartments');
                } else {
                    $('#error-modal').find('.modal-text').html(response.message);
                    showModal($('#error-modal'));
                    closeModal($('#error-modal'), false);
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
        this.deptTagMsg.toggleClass('d-none', !isEmptyOrSpaces(this.deptTagIn.val()));
        this.deptPicMsg.toggleClass('d-none', !isEmptyOrSpaces(this.deptBgIn.val()));
    }

    ifReadyToSubmit() {
        return !isEmptyOrSpaces(this.deptnameIn.val()) && !isEmptyOrSpaces(this.deptTagIn.val())
                && !isEmptyOrSpaces(this.deptBgIn.val());
    }
}