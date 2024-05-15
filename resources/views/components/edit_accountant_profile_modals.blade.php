@if($modalType == 'acc-edit-info-personal')
    <div class="modal1 d-none" id="acc-edit-personal-modal">
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
                    </div>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 d-flex justify-content-center" id="save-btn">Save</div>
        </div>
    </div>

@elseif($modalType == 'acc-edit-password')
    <div class="modal1 d-none" id="acc-edit-password-modal">
        <div class="modal1-box-small">
            <i id="modal-close-btn" class="modal1-x-icon fa-solid fa-xmark"></i>
            <div class="modal1-txt-title fw-bold text-l3" id="modal-1-title">
                Edit Password
                    <div class="d-flex flex-direction-y gap3 mar-top-2">

                        <div class="flex-grow-1">
                            <label for="new-pass-in" class="text-m2 mar-bottom-3">New Password</label>
                            <div class="d-flex position-relative align-items-center">
                                <input id="new-pass-in" class="edit-text-1 w-100" type="password" />
                                <i class="fa-solid fa-eye position-absolute right3 cursor-pointer" id="show-pass-btn"></i>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <label for="con-pass-in" class="text-m2 mar-bottom-3">Confirm Password</label>
                            <div class="d-flex position-relative align-items-center">
                                <input id="con-pass-in" class="edit-text-1 w-100" type="password" />
                                <i class="fa-solid fa-eye position-absolute right3 cursor-pointer" id="show-pass-btn"></i>
                            </div>
                        </div>

                        <div class="flex-grow-1">
                            <label for="old-pass-in" class="text-m2 mar-bottom-3">Old Password</label>
                            <div class="d-flex position-relative align-items-center">
                                <input id="old-pass-in" class="edit-text-1 w-100" type="password" />
                                <i class="fa-solid fa-eye position-absolute right3 cursor-pointer" id="show-pass-btn"></i>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="primary-btn1-small w-100 mar-top-1 d-flex justify-content-center" id="save-btn">Save</div>
        </div>
    </div>
@endif