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
        <div class="modal1-box-small modal-text">
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
        <div class="modal1-box-small modal-text">
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
    <div class="modal1 d-none" id="error-yn-modal">
        <div class="modal1-box-small modal-text">
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
    <div class="modal1 d-none" id="close-yn-modal">
        <div class="modal1-box-small modal-text">
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
    <div class="modal1 d-none" id="warning-yn-modal">
        <div class="modal1-box-small modal-text">
            <div class="modal1-icon">
                <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
                <img src="/assets/media/icons/crisis.svg"/>
            </div>
            <div class="modal1-txt text-center">
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
                    <small class="text-l3 mini-profile-name">Name</small><br>
                    <small class="text-m3 mini-profile-dept">Department</small>
                </div>
            </div>

            

            <div class="mini-profile-btns d-flex justify-content-center gap3">
                <button class="primary-btn2-small"><i class="bi bi-x-circle-fill mar-end-3"></i>Remove</button>
                <button class="primary-btn1-small" id="view-full-profile-btn"><i class="bi bi-arrows-fullscreen mar-end-3"></i> View full Profile</button>
            </div>
            
        </div>
    </div>





{{-- Modals for Payroll Settings --}}
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
                            <div class="color-AppRed d-none" id="taxname-required">Please enter Taxt name</div>
                        </div>

                        <div class="d-flex align-items-center position-relative gap3">
                            <select id="tax-type-in" class="edit-text-1">
                                <option value="Percent">%</option>
                                <option value="Amount">₱</option>
                            </select>
                            <input type="number" id="tax-price-in" step="any" class="edit-text-1 w-100" placeholder="Tax Value" />
                        </div>

                        <div class="d-flex flex-direction-y gap3 mar-top-3">
                            <label for="tax-period-in" class="text-m2 mar-bottom-3">Period</label>
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



@endif