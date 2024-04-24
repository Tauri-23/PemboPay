<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay | Run Payroll</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/forms.css">
        <link rel="stylesheet" href="/assets/css/tables.css">

        {{-- Icon --}}
        <link rel="icon" href="/assets/media/logos/mwp-pembo.png" type="image/x-icon" />

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        {{-- Modal --}}
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        <x-modals modalType="info-yn"/>

        {{-- Sidenav --}}
        <x-sidenav activeLink="2"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Run Payroll" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1">
            <div class="long-cont" id="run-payroll">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <small class="text-m1 bold">Payroll Period</small>
                    <form method="post">
                        <div>
                            <select id="select-year" class="select-long">
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                            </select>
    
                            <select id="select-month" class="select-long">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="11">December</option>
                            </select>
    
                            <select id="select-period" class="select-long">
                                <option value="1-15">1-15</option>
                                <option value="16-30">16-30</option>
                            </select>
                            <a class="primary-btn1-small h-100" id="run-payroll-btn">Run Payroll</a>
                        </div>
                    </form>
                </div>
        
            </div>

            <div class="d-flex d-none gap2 flex-direction-y" id="payroll-preview">
                <div class="long-cont">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <small class="text-m1 bold">Payroll Preview (1-15 Jan 2024)</small>
                    </div>
                </div>
    
                <div class="table1">
                    <div class="table1-header">
                        <small class="text-m2 form-data-col">Employee ID</small>
                        <small class="text-m2 form-data-col">Compensation Type</small>
                        <small class="text-m2 form-data-col">Department</small>
                        <small class="text-m2 form-data-col">Gross Pay</small>
                        <small class="text-m2 form-data-col">Net Pay</small>
                    </div>
            
            
                    <div  class="table1-data employee-column">
                        <small class="form-data-col emp-id">187352</small>
                        <small class="form-data-col emp-dept">Admin</small>
                        <small class="form-data-col">Salary</small>
                        <small class="form-data-col">₱ 7,000.00</small>
                        <small class="form-data-col">₱ 6,700.00</small>
                    </div>

                    <div  class="table1-data employee-column">
                        <small class="form-data-col emp-id">881327</small>
                        <small class="form-data-col emp-dept">Admin</small>
                        <small class="form-data-col">Salary</small>
                        <small class="form-data-col">₱ 7,000.00</small>
                        <small class="form-data-col">₱ 6,700.00</small>
                    </div>

                    <div  class="table1-data employee-column last">
                        <small class="form-data-col emp-id">123123</small>
                        <small class="form-data-col emp-dept">Admin</small>
                        <small class="form-data-col">Hourly</small>
                        <small class="form-data-col">₱ 7,000.00</small>
                        <small class="form-data-col">₱ 6,700.00</small>
                    </div>
                </div>

                <div class="d-flex w-100 justify-content-end gap3">
                    <a class="primary-btn2-small" id="cancel-payroll-btn">Cancel Payroll</a>
                    <a class="primary-btn3-small" id="approve-payroll-btn">Approve Payroll</a>
                </div>
                
            </div>
            
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/run-payroll.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
