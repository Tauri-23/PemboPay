@if($modalType == 'emp-edit-info-personal')
    <div class="modal1 d-none" id="emp-edit-personal-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Personal Information
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="fname-in" class="text-m2 mar-bottom-3">First name</label>
                            <input name="First Name" class="edit-text-1 w-100" id="fname-in" type="text" placeholder="First Name" />
                            <div class="color-AppRed d-none" id="fname-required">Please enter Firstname</div>
                        </div>
                        <div class="flex-grow-1">
                            <label for="mname-in" class="text-m2 mar-bottom-3">Middle name</label>
                            <input name="Middle Name" class="edit-text-1 w-100" id="mname-in" type="text" placeholder="Middle Name" />
                        </div>
                        <div class="flex-grow-1">
                            <label for="lname-in" class="text-m2 mar-bottom-3">Last name</label>
                            <input name="Last Name" class="edit-text-1 w-100" id="lname-in" type="text" placeholder="Last Name" />
                            <div class="color-AppRed d-none" id="fname-required">Please enter Lastname</div>
                        </div>
    
                        <div class="flex-grow-1">
                            <label for="phone-in" class="text-m2 mar-bottom-3">Phone</label>
                            <div class="d-flex align-items-center position-relative">
                                <div class="position-absolute text-m2 mar-start-3">+63 |</div>
                                <input name="Phone Number" class="edit-text-1 specialInput w-100" id="phone-in" type="text" maxlength="10" placeholder="Phone Number" required />
                            </div>
                            <div class="color-AppRed d-none" id="fname-required">Please enter Phone number</div>
                        </div>
    
                        <div class="flex-grow-1">
                            <label for="gender-in" class="text-m2 mar-bottom-3">Gender</label>
    
                            <select class="select-long2 w-100 text-m2" id="gender-in">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 d-flex justify-content-center" id="save-btn">Save</div>
        </div>
    </div>


@elseif($modalType == 'emp-edit-info-address')
    <div class="modal1 d-none" id="emp-edit-address-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Address
                <div class="d-flex flex-direction-y gap3 mar-top-2">

                    <div class="flex-grow-1">
                        <label for="st-address-in" class="text-m2 mar-bottom-3">Street Address</label>
                        <input name="Street Address" class="edit-text-1 w-100" id="st-address-in" type="text" placeholder="Block - Lot - Street" required />
                        <div class="color-AppRed d-none" id="street-address-required">Please enter Street address</div>
                    </div>
                    {{-- City --}}
                    <div class="w-100 d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="city-in" class="text-m2 mar-bottom-3">City</label>

                        <select class="select-long2 w-100 text-m2" id="city-in">
                            <x-CitiesSelectOption :cities="$cities"/>
                        </select>

                        <div class="color-AppRed d-none" id="city-required">Please select City</div>
                    </div>
            
                    {{-- Barangay --}}
                    <div class="w-100 d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="brgy-in" class="text-m2 mar-bottom-3">Barangay</label>

                        <select class="select-long2 w-100 text-m2" id="brgy-in">
                            <x-BrgysSelectOption :brgy="$brgys"/>
                        </select>

                        <div class="color-AppRed d-none" id="brgy-required">Please select Barangay</div>
                    </div>

                </div>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 d-flex justify-content-center" id="save-btn">Save</div>
        </div>
    </div>


@elseif($modalType == 'emp-edit-info-compensation')
    <div class="modal1 d-none" id="emp-edit-info-compensation-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Pay Information

                <div class="d-flex flex-direction-y w-100 mar-top-1">
                    <div class="w-100 text-m1 mar-bottom-3">Compensation Type</div>
                    <div class="d-flex gap3">
                        <div class="category-btn-1" id="hourly">
                            <div class="text-m2" for="pay-info-hourly">Hourly</div>
                        </div>
    
                        <div class="category-btn-1" id="salary">
                            <div class="text-m2" for="pay-info-salary">Salary</div>
                        </div>
                    </div>

                    <div class="d-flex flex-direction-y w-100 mar-top-3" id="hourly-pay-inputs">
                        <label for="hourly-rate" class="text-m2 mar-bottom-3 mar-top-1">Hourly Rate</label>
                        <input name="hrly-rate" class="edit-text-1 flex-grow-1" id="hourly-rate" type="number" step="any" min="1" placeholder="Enter Hourly Rate" required />
                        <div class="color-AppRed d-none" id="hrly-rate-required">Please enter Hourly rate</div>
                    </div>

                    <div class="d-flex flex-direction-y w-100 mar-top-3" id="salary-pay-inputs">
                        <label for="salary-rate" class="text-m2 mar-bottom-3 mar-top-1">Salary</label>
                        <input name="hrly-rate" class="edit-text-1 flex-grow-1" id="salary-rate" type="number" step="any" min="1" placeholder="Enter Hourly Rate" required />
                        <div class="color-AppRed d-none" id="sal-rate-required">Please enter Salary</div>
                    </div>


                </div>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 d-flex justify-content-center" id="save-btn">Save</div>
        </div>
    </div>

@endif