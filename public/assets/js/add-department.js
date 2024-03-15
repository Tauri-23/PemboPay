$(document).ready(function() {

    const selectDeptScript = new SelectDept();
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
        //const selectedDeptBgs = ;
        const bgPic = clearSelectionBtn.find('.dept-bg-pic').attr('id');
        const bgPicOverlay = $(this).find('.deptBgOverlay');

        console.log(bgPic);

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