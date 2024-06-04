@if($modalType == 'success')
    <div class="modal1 d-none" id="success-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/check.svg"/>
            </div>
            <div class="modal1-txt text-center modal-text">
            </div>
        </div>
    </div>

@elseif($modalType == 'error')
    <div class="modal1 d-none" id="error-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/error.svg"/>
            </div>
            <div class="modal1-txt text-center modal-text">
            </div>
        </div>
    </div>

@elseif($modalType == 'close')
    <div class="modal1 d-none" id="close-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/close.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
        </div>
    </div>





{{-- For Yes No Modals --}}
@elseif($modalType == 'info-yn')
    <div class="modal1 d-none info-yn-modal" id="info-yn-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/information.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
            <div class="d-flex justify-content-center gap1 mar-top-2">
                <a class="primary-btn2-small" id="modal-close-btn">No</a>
                <a class="yes-btn primary-btn3-small">Yes</a>
            </div>
        </div>
    </div>

@elseif($modalType == 'error-yn')
    <div class="modal1 d-none error-yn-modal" id="error-yn-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/error.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
            <div class="d-flex justify-content-center gap1 mar-top-2">
                <a class="primary-btn2-small" id="modal-close-btn">No</a>
                <a class="yes-btn primary-btn3-small">Yes</a>
            </div>
        </div>
    </div>

@elseif($modalType == 'close-yn')
    <div class="modal1 d-none close-yn-modal" id="close-yn-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/close.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
            <div class="d-flex justify-content-center gap1 mar-top-2">
                <a class="primary-btn2-small" id="modal-close-btn">No</a>
                <a class="yes-btn primary-btn3-small">Yes</a>
            </div>
        </div>
    </div>

@elseif($modalType == 'warning-yn')
    <div class="modal1 d-none warning-yn-modal" id="warning-yn-modal">
        <div class="modal1-box-small">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/crisis.svg"/>
            </div>
            <div class="modal1-txt text-center">
            </div>
            <div class="d-flex justify-content-center gap1 mar-top-2">
                <a class="primary-btn2-small" id="modal-close-btn">No</a>
                <a class="yes-btn primary-btn3-small">Yes</a>
            </div>
        </div>
    </div>





{{-- Modals Employees and View Employees --}}
@elseif($modalType == 'emp-mini-profile-1')
    <div class="modal1 d-none" id="emp-mini-profile-1-modal">
        <div class="modal1-box-small modal-text d-flex flex-direction-y gap2">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>

            <div class="d-flex gap2">
                <div class="modal-pfp">
                    <img class="emp-mini-profile-pfp" src="" alt="employee-profile">
                </div>
    
                <div class="mini-profile-infos">
                    <input type="hidden" class="mini-profile-id">
                    <small class="text-l3 mini-profile-name">Name</small><br>
                    <small class="text-m3 mini-profile-dept">Department</small>
                </div>
            </div>

            

            <div class="mini-profile-btns d-flex justify-content-center gap3">
                <button class="primary-btn2-small" id="del-emp-btn"><i class="bi bi-x-circle-fill mar-end-3"></i>Remove</button>
                <button class="primary-btn1-small" id="view-full-profile-btn"><i class="bi bi-arrows-fullscreen mar-end-3"></i> View full Profile</button>
            </div>
            
        </div>
    </div>
@elseif($modalType == 'emp-mini-profile-2')
    <div class="modal1 d-none" id="emp-mini-profile-2-modal">
        <div class="modal1-box-small modal-text d-flex flex-direction-y gap2">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>

            <div class="d-flex gap2">
                <div class="modal-pfp">
                    <img class="emp-mini-profile-pfp" src="" alt="employee-profile">
                </div>
    
                <div class="mini-profile-infos">
                    <input type="hidden" class="mini-profile-id">
                    <small class="text-l3 mini-profile-name">Name</small><br>
                    <small class="text-m3 mini-profile-dept">Department</small>
                </div>
            </div>

            

            <div class="mini-profile-btns d-flex justify-content-end gap3">
                <button class="primary-btn1-small" id="view-full-profile-btn"><i class="bi bi-arrows-fullscreen mar-end-3"></i> View full Profile</button>
            </div>
            
        </div>
    </div>






{{-- Modals for Department Settings --}}
@elseif($modalType == 'add-dept-position')
    <div class="modal1 d-none" id="add-dept-position-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Department Position
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div>
                            <label for="position-in" class="text-m2 mar-bottom-3">Position</label>
                            <input type="text" class="edit-text-1 w-100" name="" id="position-in">
                        </div>

                        <div>
                            <label for="sal-grade-in" class="text-m2 mar-bottom-3">Salary Grade</label>
                            <select class="edit-text-1 w-100" name="" id="sal-grade-in">

                            </select>
                        </div>

                    </div>
                </form>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 text-center" id="add-dept-position">Add</div>
        </div>
    </div>

@elseif($modalType == 'edit-dept-position')
    <div class="modal1 d-none" id="edit-dept-position-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Department Position
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div>
                            <label for="position-in" class="text-m2 mar-bottom-3">Position</label>
                            <input type="text" class="edit-text-1 w-100" name="" id="position-in">
                        </div>

                        <div>
                            <label for="sal-grade-in" class="text-m2 mar-bottom-3">Salary Grade</label>
                            <select class="edit-text-1 w-100" name="" id="sal-grade-in">

                            </select>
                        </div>

                    </div>
                </form>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 text-center" id="edit-dept-position">Save</div>
        </div>
    </div>

@elseif($modalType == 'edit-dept-name')
    <div class="modal1 d-none" id="edit-dept-name-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Department Name
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div>
                            <label for="name-in" class="text-m2 mar-bottom-3">Name</label>
                            <input type="text" class="edit-text-1 w-100" name="" id="name-in">
                        </div>
                    </div>
                </form>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 text-center" id="edit-dept-name">Save</div>
        </div>
    </div>





{{-- Modals for Payroll Settings --}}
@elseif($modalType == 'add-sal-grade')
    <div class="modal1 d-none" id="add-sal-grade-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Salary Grade
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="grade-in" class="text-m2 mar-bottom-3">Grade</label>
                            <input type="text" class="edit-text-1 w-100" name="" id="grade-in">
                        </div>

                        <div class="flex-grow-1">
                            <label for="value-in" class="text-m2 mar-bottom-3">Value</label>
                            <div class="d-flex align-items-center gap3">
                                <div>₱</div>
                                <input class="edit-text-1 w-100" id="value-in" min="0" max="1000000" type="number" step="any"/>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 text-center" id="add-sal-grade">Add</div>
        </div>
    </div>
@elseif($modalType == 'edit-sal-grade')
    <div class="modal1 d-none" id="edit-sal-grade-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Salary Grade
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="grade-in" class="text-m2 mar-bottom-3">Grade</label>
                            <input type="text" class="edit-text-1 w-100" name="" id="grade-in">
                        </div>

                        <div class="flex-grow-1">
                            <label for="value-in" class="text-m2 mar-bottom-3">Value</label>
                            <div class="d-flex align-items-center gap3">
                                <div>₱</div>
                                <input class="edit-text-1 w-100" id="value-in" min="0" max="1000000" type="number" step="any"/>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 text-center" id="edit-sal-grade">Save</div>
        </div>
    </div>


@elseif($modalType == 'add-tax-exempt')
    <div class="modal1 d-none" id="add-tax-exempt-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Contribution
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="tax-name-in" class="text-m2 mar-bottom-3">Name</label>
                            <input class="edit-text-1 w-100" id="tax-name-in" type="text" placeholder="Tax Name" />
                        </div>

                        <div class="d-flex flex-direction-y gap3 mar-top-3">
                            <label for="tax-period-in" class="text-m2">Period</label>
                            <select id="tax-period-in" class="edit-text-1 w-100">
                                <option value="Every 15">Every 15</option>
                                <option value="Every End of the Month">Every End of the Month</option>
                            </select>
                        </div>


                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="add-tax">Add</button>
        </div>
    </div>




@elseif($modalType == 'add-taxes')
    <div class="modal1 d-none" id="add-taxes-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Tax
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="tax-name-in" class="text-m2 mar-bottom-3">Tax name</label>
                            <input name="tax-name-in" class="edit-text-1 w-100" id="tax-name-in" type="text" placeholder="Tax Name" />
                            <div class="color-AppRed d-none" id="taxname-required">Please enter Tax name</div>
                        </div>

                        <div class="d-flex flex-direction-y gap3 mar-top-3">
                            <label for="tax-period-in" class="text-m2">Period</label>
                            <select id="tax-period-in" class="edit-text-1 w-100">
                                <option value="Quarterly">Quarterly</option>
                                <option value="Monthly">Montly</option>
                            </select>
                        </div>


                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="add-tax">Add</button>
        </div>
    </div>


@elseif($modalType == 'add-tax-column')
    <div class="modal1 d-none" id="add-tax-column-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Tax Row
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="val-percent-in" class="text-m2 mar-bottom-3">Value in Percent</label>
                            <div class="d-flex align-items-center gap3">
                                <input class="edit-text-1 w-100" id="val-percent-in" min="0" type="number" step="any"/>
                                <div>%</div>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <label for="val-amount-in" class="text-m2 mar-bottom-3">Value in Amount</label>
                            <div class="d-flex align-items-center gap3">
                                <div>₱</div>
                                <input class="edit-text-1 w-100" id="val-amount-in" min="0" type="number" step="any"/>
                            </div>
                        </div>

                        <div class="flex-grow-1 d-flex gap1">
                            <div>
                                <label for="threshold-min-in" class="text-m2 mar-bottom-3">Threshold min</label>
                                <div class="d-flex align-items-center gap3">
                                    <div>₱</div>
                                    <input class="edit-text-1 w-100" id="threshold-min-in" min="0" type="number" step="any"/>
                                </div>
                            </div>

                            <div>
                                <label for="threshold-max-in" class="text-m2 mar-bottom-3">Threshold max</label>
                                <div class="d-flex align-items-center gap3">
                                    <div>₱</div>
                                    <input class="edit-text-1 w-100" id="threshold-max-in" min="0" type="number" step="any"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="add-tax">Add</button>
        </div>
    </div>

@elseif($modalType == 'edit-tax-column')
    <div class="modal1 d-none" id="edit-tax-column-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Tax Row
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="val-percent-in" class="text-m2 mar-bottom-3">Value in Percent</label>
                            <div class="d-flex align-items-center gap3">
                                <input class="edit-text-1 w-100" id="val-percent-in" min="0" type="number" step="any"/>
                                <div>%</div>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <label for="val-amount-in" class="text-m2 mar-bottom-3">Value in Amount</label>
                            <div class="d-flex align-items-center gap3">
                                <div>₱</div>
                                <input class="edit-text-1 w-100" id="val-amount-in" min="0" type="number" step="any"/>
                            </div>
                        </div>

                        <div class="flex-grow-1 d-flex gap1">
                            <div>
                                <label for="threshold-min-in" class="text-m2 mar-bottom-3">Threshold min</label>
                                <div class="d-flex align-items-center gap3">
                                    <div>₱</div>
                                    <input class="edit-text-1 w-100" id="threshold-min-in" min="0" type="number" step="any"/>
                                </div>
                            </div>

                            <div>
                                <label for="threshold-max-in" class="text-m2 mar-bottom-3">Threshold max</label>
                                <div class="d-flex align-items-center gap3">
                                    <div>₱</div>
                                    <input class="edit-text-1 w-100" id="threshold-max-in" min="0" type="number" step="any"/>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="save-edit-tax">Save</button>
        </div>
    </div>



@elseif($modalType == 'add-allowance')
    <div class="modal1 d-none" id="add-allowance-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Allowance
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="allowance-name-in" class="text-m2 mar-bottom-3">Allowance name</label>
                            <input name="allowance-name-in" class="edit-text-1 w-100" id="allowance-name-in" type="text" placeholder="Allowance Name" />
                            <div class="color-AppRed d-none" id="taxname-required">Please enter Allowance name</div>
                        </div>

                        <div class="d-flex align-items-center position-relative gap3">
                            <select id="allowance-type-in" class="edit-text-1">
                                <option value="Percent">%</option>
                                <option value="Amount">₱</option>
                            </select>
                            <input type="number" id="allowance-price-in" step="any" class="edit-text-1 w-100" placeholder="Allowance Value" />
                        </div>

                        <div class="d-flex flex-direction-y gap3 mar-top-3">
                            <label for="allowance-period-in" class="text-m2 mar-bottom-3">Period</label>
                            <select id="allowance-period-in" class="edit-text-1 w-100">
                                <option value="Quarterly">Quarterly</option>
                                <option value="Monthly">Montly</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="add-allowance">Add</button>
        </div>
    </div>




@elseif($modalType == 'add-deduction')
    <div class="modal1 d-none" id="add-deduction-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Deduction
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="flex-grow-1">
                            <label for="deduction-name-in" class="text-m2 mar-bottom-3">Deduction name</label>
                            <input name="deduction-name-in" class="edit-text-1 w-100" id="deduction-name-in" type="text" placeholder="Deduction Name" />
                            <div class="color-AppRed d-none" id="taxname-required">Please enter Deduction name</div>
                        </div>

                        <div class="d-flex align-items-center position-relative gap3">
                            <select id="deduction-type-in" class="edit-text-1">
                                <option value="Percent">%</option>
                                <option value="Amount">₱</option>
                            </select>
                            <input type="number" id="deduction-price-in" step="any" class="edit-text-1 w-100" placeholder="Deduction Value" />
                        </div>

                        <div class="d-flex flex-direction-y gap3 mar-top-3">
                            <label for="deduction-period-in" class="text-m2 mar-bottom-3">Period</label>
                            <select id="deduction-period-in" class="edit-text-1 w-100">
                                <option value="Quarterly">Quarterly</option>
                                <option value="Monthly">Montly</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="add-deduction">Add</button>
        </div>
    </div>











    {{-- Add Accountant Admin --}}
@elseif($modalType == 'add-accountant')
    <div class="modal1 d-none" id="add-accountant-modal">
        <div class="modal1-box-flexible">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Add Accountant
                <form method="post">
                    <div class="d-flex flex-direction-y gap3 mar-top-2">
                        <div class="d-flex gap3">
                            <div class="w-100">
                                <label for="fname-in" class="text-m2 mar-bottom-3">Firstname</label>
                                <input class="edit-text-1 w-100" id="fname-in" type="text"/>
                            </div>
                            <div class="w-100">
                                <label for="mname-in" class="text-m2 mar-bottom-3">Middlename <span class="text-m3">optional</span></label>
                                <input class="edit-text-1 w-100" id="mname-in" type="text"/>
                            </div>
                            <div class="w-100">
                                <label for="lname-in" class="text-m2 mar-bottom-3">Lastname</label>
                                <input class="edit-text-1 w-100" id="lname-in" type="text"/>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <label for="gender-in" class="text-m2 mar-bottom-3">Gender</label>
                            <select class="edit-text-1 w-100" id="gender-in">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="flex-grow-1">
                            <label for="uname-in" class="text-m2 mar-bottom-3">Username</label>
                            <input class="edit-text-1 w-100" id="uname-in" type="text"/>
                        </div>

                        <div class="flex-grow-1">
                            <label for="email-in" class="text-m2 mar-bottom-3">Email</label>
                            <input class="edit-text-1 w-100" id="email-in" type="text"/>
                        </div>

                        <div class="flex-grow-1">
                            <label for="phone-in" class="text-m2 mar-bottom-3">Phone</label>
                            <input class="edit-text-1 w-100" maxlength="10" id="phone-in" type="text"/>
                        </div>

                        <div class="flex flex-direction-d mar-top-2">
                            <small class="text-m2">Note: </small>
                            <small class="text-m3">The password is auto generated and will be sent to the email you provided.</small>
                        </div>
                        
                    </div>
                </form>
            </div>
            <button class="primary-btn1-small w-100 mar-top-1" id="add-accountant">Add Accountant</button>
        </div>
    </div>



@endif