<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/tables.css">
        <link rel="stylesheet" href="/assets/css/forms.css">

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        
        {{-- MOdal --}}
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        <x-modals modalType="info-yn"/>

        {{-- Sidenav --}}
        <x-sidenav activeLink="6"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Add Employee" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1">

            {{-- Personal Information --}}
            @csrf
            <form class="d-flex flex-direction-y gap2 position-relative mar-bottom-1" method="post">
                <div class="long-cont d-flex flex-wrap gap3">
                    <div class="w-100 text-m1 bold">Personal Information</div>
                    <div class="d-flex flex-direction-y gap3 w-100">
                        <div class="text-m2 w-100 mar-top-2">
                            Employee Name
                        </div>

                        {{-- full name --}}
                        <div class="w-100 d-flex flex-wrap gap3">
                            <div class="flex-grow-1">
                                <input name="First Name" class="edit-text-1 w-100" id="fname-in" type="text" placeholder="First Name" />
                                <div class="color-AppRed d-none" id="fname-required">Please enter Firstname</div>
                            </div>
                            
                            <div class="flex-grow-1">
                                <input name="Middle Name" class="edit-text-1 w-100" id="mname-in" type="text" placeholder="Middle Name"/>
                            </div>

                            <div class="flex-grow-1">
                                <input name="Last Name" class="edit-text-1 w-100" id="lname-in" type="text" placeholder="Last Name" />
                                <div class="color-AppRed d-none" id="lname-required">Please enter Lastname</div>
                            </div>
                        </div>
                    </div>

                    {{-- birthdate --}}
                    <div class="d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="bday-in" class="text-m2 mar-bottom-3">Birth Date</label>
                        <input name="Birth Date" class="edit-text-1 w-100" id="bday-in" type="date" required />
                        <div class="color-AppRed d-none" id="bday-required">Please enter Birth date</div>
                    </div>
            
                    {{-- phone num --}}
                    <div class="d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="phone-in" class="text-m2 mar-bottom-3">Phone Number</label>
                        <div class="d-flex align-items-center position-relative">
                            <div class="position-absolute text-m2 mar-start-3">+63 |</div>
                            <input name="Phone Number" class="edit-text-1 specialInput w-100" id="phone-in" type="text" maxlength="10" placeholder="Phone Number" required />
                        </div>
                        <div class="color-AppRed d-none" id="phone-required">Please enter Phone number</div>
                    </div>
            
                    {{-- Email --}}
                    <div class="d-flex flex-wrap flex-direction-y flex-grow-1 mar-top-3">
                        <label for="email-in" class="text-m2 mar-bottom-3">Email</label>
                        <input name="Email" class="edit-text-1 w-100" id="email-in" type="text" placeholder="Email" required />
                        <div class="color-AppRed d-none" id="email-required">Please enter Email</div>
                    </div>
            
                    
            
                    {{-- Gender --}}
                    <div class="w-100 flex flex-wrap flex-direction-d flex-grow-1 mar-top-3">
                        <label for="gender-in" class="text-m2 mar-bottom-3">Gender</label>

                        <select class="select-long2 w-100" id="gender-in">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
            
                </div>


                {{-- Address --}}
                <div class="long-cont d-flex flex-wrap gap3">
                    <div class="w-100 text-m1 bold">Address</div>

                    {{-- Street Address --}}
                    <div class="w-100 d-flex flex-direction-y flex-grow-1 mar-top-2">
                        <label for="st-address-in" class="text-m2 mar-bottom-3">Street Address</label>
                        <input name="Street Address" class="edit-text-1 flex-grow-1" id="st-address-in" type="text" placeholder="Block - Lot - Street" required />
                        <div class="color-AppRed d-none" id="street-address-required">Please enter Street address</div>
                    </div>

                    {{-- City --}}
                    <div class="w-100 d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="city-in" class="text-m2 mar-bottom-3">City</label>

                        <select class="select-long2 w-100" id="city-in">
                            <option value="invalid">Select City</option>
                            <x-CitiesSelectOption :cities="$cities"/>
                        </select>

                        <div class="color-AppRed d-none" id="city-required">Please select City</div>
                    </div>
            
                    {{-- Barangay --}}
                    <div class="w-100 d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="brgy-in" class="text-m2 mar-bottom-3">Barangay</label>

                        <select class="select-long2 w-100" id="brgy-in" disabled>
                            <option value="invalid">Select Barangay</option>
                            <x-BrgysSelectOption :brgy="$brgy"/>
                        </select>

                        <div class="color-AppRed d-none" id="brgy-required">Please select Barangay</div>
                    </div>
            
                    {{-- Postal Code --}}
                    <div class="w-100 d-flex flex-direction-y flex-grow-1 mar-top-3">
                        <label for="postal-in" class="text-m2 mar-bottom-3">Postal Code</label>
                        <input name="Postal Code" class="edit-text-1 flex-grow-1" id="postal-in" type="text" placeholder="Enter Postal Code" required disabled/>
                    </div>
            
                </div>


                {{-- Work Information --}}
                <div class="long-cont d-flex flex-wrap gap3">
                    <div class="w-100 text-m1 bold">Work Information</div>

                    <div class="d-flex flex-direction-y w-100 mar-top-3">
                        <label for="department-in" class="text-m2 mar-bottom-3">
                            Department
                        </label>
                        <select name="Department" class="select-long2 w-100" id="department-in">
                            <option value="" selected>Select Departments</option>
                            {{-- Create loop here to generate available employees --}}
                            <x-department_select_option :departments="$departments"/>
                        </select>
                        <div class="color-AppRed d-none" id="department-required">Please select Department</div>
                    </div>

                </div>


                {{-- Pay Information --}}
                <div class="long-cont d-flex flex-wrap gap3">
                    <div class="w-100 text-m1 bold">Pay Information</div>

                    <div class="d-flex flex-direction-y w-100 mar-top-3">
                        <div class="d-flex gap3">
                            <div class="category-btn-1 active" id="hourly">
                                <label for="pay-info-hourly">Hourly</label>
                            </div>
    
                            <div class="category-btn-1" id="salary">
                                <label for="pay-info-salary">Salary</label>
                            </div>
                        </div>

                        <div class="d-flex flex-direction-y w-100 mar-top-3" id="hourly-pay-inputs">
                            <label for="hourly-rate" class="text-m2 mar-bottom-3 mar-top-1">Hourly Rate</label>
                            <input name="hrly-rate" class="edit-text-1 flex-grow-1" id="hourly-rate" type="number" step="any" min="1" placeholder="Enter Hourly Rate" required />
                            <div class="color-AppRed d-none" id="hrly-rate-required">Please enter Hourly rate</div>
                        </div>

                        <div class="d-flex flex-direction-y w-100 mar-top-3  d-none" id="salary-pay-inputs">
                            <label for="salary-rate" class="text-m2 mar-bottom-3 mar-top-1">Salary</label>
                            <input name="hrly-rate" class="edit-text-1 flex-grow-1" id="salary-rate" type="number" step="any" min="1" placeholder="Enter Hourly Rate" required />
                            <div class="color-AppRed d-none" id="sal-rate-required">Please enter Salary</div>
                        </div>


                    </div>
                    
                </div>

                {{-- Add Emp Button --}}
                <div class="d-flex justify-content-end w-100">
                    <a id="add-emp-btn" class="primary-btn3-long mar-bottom-1 text-center-self">Add Employee</a>
                </div>

            </form>
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        // Define a JavaScript variable and initialize it with PHP data
        const brgys = {!! json_encode($brgy) !!};
        formatPhoneNumIn($('#phone-in'));
    </script>

    <script src="/assets/js/add-employee.js"></script>
</html>
