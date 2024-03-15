$(document).ready(function() {
    const addressScript = new AddressHandler(brgys);
    const payInfoScript = new PayInfoHandler();
    const formValidatorScript = new FormValidator(payInfoScript);
});





/*
|----------------------------------------
|Main Class
|----------------------------------------
*/
class Main {
    constructor() {
        //Inputs
        this.fnameIn = $('#fname-in');
        this.mnameIn = $('#mname-in');
        this.lnameIn = $('#lname-in');

        this.bdateIn = $('#bday-in');
        this.phoneIn = $('#phone-in');
        this.emailIn = $('#email-in');
        this.genderIn = $('#gender-in');

        this.stAddressIn = $('#st-address-in');
        this.cityIn = $('#city-in');
        this.brgyIn = $('#brgy-in');
        this.postalIn = $('#postal-in');

        this.deptIn = $('#department-in');

        this.hourlyIn = $('#hourly-rate');
        this.salaryIn = $('#salary-rate');

        //Buttons
        this.addEmpBtn = $('#add-emp-btn');

        //Messages (For empty fields)
        this.fnameMsg = $('#fname-required');
        this.lnameMsg = $('#lname-required');

        this.bdateMsg = $('#bday-required');
        this.phoneMsg = $('#phone-required');
        this.emailMsg = $('#email-required');

        this.streetAddMsg = $('#street-address-required');
        this.cityMsg = $('#city-required');
        this.brgyMsg = $('#brgy-required');

        this.deptMsg = $('#department-required');

        this.hrlyRateMsg = $('#hrly-rate-required');
        this.salRateMsg = $('#sal-rate-required');

        this.selectedPayMode = 'hourly';

    }
}





/*
|----------------------------------------
|Address Class
|----------------------------------------
*/
class AddressHandler extends Main {
    constructor(brgys) {
        super();
        
        this.brgys = brgys;

        this.cityIn.change(this.cityHandler.bind(this));
        this.brgyIn.change(this.brgyHandler.bind(this));
    }

    cityHandler() {
        const selectedCity = this.cityIn.val()

        if(selectedCity === 'invalid') {
            this.brgyIn.attr("disabled", true);
            this.brgyIn.val('invalid').change();
            return;
        }

        // Filter barangays based on the selected city
        const filteredBrgys = this.brgys.filter(brgy => brgy.city == selectedCity);

        // Populate barangay dropdown with filtered barangays
        this.brgyIn.empty().append('<option value="invalid">Select Barangay</option>');

        filteredBrgys.forEach(brgy => {
            this.brgyIn.append(`<option value="${brgy.id}">${brgy.barangay}</option>`);
        });

        // Enable barangay dropdown
        this.brgyIn.removeAttr('disabled');

    }


    brgyHandler() {
        const selectedBrgy = this.brgys.filter(brgy => brgy.id == this.brgyIn.val());

        if (selectedBrgy.length < 1) {
            this.postalIn.val('');
            return;
        }

        this.postalIn.val(selectedBrgy[0].postal_code);
    }
}




/*
|----------------------------------------
|PayInfo Class
|----------------------------------------
*/
class PayInfoHandler extends Main {

    constructor() {
        super();

        //buttons
        this.hourlyBtn = $('#hourly');        
        this.salaryBtn = $('#salary');

        //containers
        this.hourlyInputCont = $('#hourly-pay-inputs');
        this.salaryInputCont = $('#salary-pay-inputs');

        //set event 
        this.hourlyBtn.click(this.hourlyHandler.bind(this));
        this.salaryBtn.click(this.salaryHandler.bind(this));
    }

    hourlyHandler() {
        this.selectedPayMode = 'hourly';
        this.setActivePayInfoBtn(1);
        this.hourlyInputCont.removeClass('d-none');
        this.salaryInputCont.addClass('d-none');
    }

    salaryHandler() {
        this.selectedPayMode = 'salary';
        this.setActivePayInfoBtn(2);
        this.hourlyInputCont.addClass('d-none');
        this.salaryInputCont.removeClass('d-none');
    }

    setActivePayInfoBtn(btnActive) {
        this.hourlyBtn.removeClass('active');
        this.salaryBtn.removeClass('active');

        this.hourlyBtn.addClass(btnActive === 1 ? 'active' : '');
        this.salaryBtn.addClass(btnActive === 2 ? 'active' : '');
    }
}





/*
|----------------------------------------
|Form Validator
|----------------------------------------
*/
class FormValidator extends Main{
    constructor(payInfoHandler) {
        super();
        this.addEmpBtn.click(this.submitSetup.bind(this));
        this.payInfoHandler = payInfoHandler;
    }

    submitSetup() {
        this.emptyMessagesValidator();

        if(!this.ifReadyToSumbit()) {
            return;
        }

        alert('ready for sumbit');
    }

    emptyMessagesValidator() {
        this.fnameMsg.toggleClass('d-none', !isEmptyOrSpaces(this.fnameIn.val()));
        this.lnameMsg.toggleClass('d-none', !isEmptyOrSpaces(this.lnameIn.val()));

        this.bdateMsg.toggleClass('d-none', !isEmptyOrSpaces(this.bdateIn.val()));
        this.phoneMsg.toggleClass('d-none', !isEmptyOrSpaces(this.phoneIn.val()));
        this.emailMsg.toggleClass('d-none', !isEmptyOrSpaces(this.emailIn.val()));

        this.streetAddMsg.toggleClass('d-none', !isEmptyOrSpaces(this.stAddressIn.val()));
        this.cityMsg.toggleClass('d-none', this.cityIn.val() != 'invalid');
        this.brgyMsg.toggleClass('d-none', this.brgyIn.val() != 'invalid');
        
        this.deptMsg.toggleClass('d-none', this.deptIn.val() != 'invalid');

        this.hrlyRateMsg.toggleClass('d-none', !isEmptyOrSpaces(this.hourlyIn.val()));
        this.salRateMsg.toggleClass('d-none', !isEmptyOrSpaces(this.salaryIn.val()));
    }

    ifReadyToSumbit() {
        let selectedPayModeInput = this.payInfoHandler.selectedPayMode == 'hourly' ? this.hourlyIn.val() : this.salaryIn.val();

        return !isEmptyOrSpaces(this.fnameIn.val()) && !isEmptyOrSpaces(this.lnameIn.val()) && !isEmptyOrSpaces(this.bdateIn.val()) &&
        !isEmptyOrSpaces(this.phoneIn.val()) && !isEmptyOrSpaces(this.emailIn.val()) && !isEmptyOrSpaces(this.stAddressIn.val()) &&
        (this.cityIn.val() != 'invalid') && (this.brgyIn.val() != 'invalid') && (this.deptIn.val() != 'invalid') &&
        !isEmptyOrSpaces(selectedPayModeInput)
    }

    


}