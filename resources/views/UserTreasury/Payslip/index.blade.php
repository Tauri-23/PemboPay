<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PemboPay</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/tables.css">

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        

        {{-- Sidenav --}}
        <x-sidenav activeLink="5"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Payslip"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-x gap2 position-relative">
            <div class="long-cont">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="text-m1 bold">Generate Salary Slip</p>
                    <a id="generate-salary-slip" class="primary-btn1-long">
                        <small class="text-m2">Generate Salary Slip</small>
                    </a>
                </div>
                <div class="line1 mar-top-2 mar-bottom-2"></div>
                <div class="flex justify-content-between">
                    <div class="flex gap3 flex-wrap-cont">
                        <input type="text" id="SearchEmployee" class="editText3" placeholder="Employee Name" />
                        <form method="post"></form>
                        <select id="month" class="select-long">
                            <option value="Jan">January</option>
                            <option value="Feb">February</option>
                            <option value="Mar">March</option>
                            <option value="Apr">April</option>
                            <option value="May">May</option>
                            <option value="Jun">June</option>
                            <option value="Jul">July</option>
                            <option value="Aug">August</option>
                            <option value="Sep">September</option>
                            <option value="Oct">October</option>
                            <option value="Nov">November</option>
                            <option value="Dec">December</option>
                        </select>
            
                        <select id="period" class="select-long">
                            <option value="1-15">1-15</option>
                            <option value="16-30">16-30</option>
                        </select>
            
                        <select id="year" class="select-long">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>
            
            </div>
            
            <div class="table1">
                <div class="table1-header">
                    <small class="text-m2 flex-grow-1">Employee Name</small>
                    <div class="table1-PFP-small-cont mar-end-1"></div>
                    <small class="text-m2 flex-grow-1">Employee ID</small>
                    <small class="text-m2 flex-grow-1">Employee Email</small>
                    <small class="text-m2 flex-grow-1">Department</small>
                    <small class="text-m2 flex-grow-1">Status</small>
                </div>


                {{--Data Fetched from the database this is for ui for now--}}
                <div class="table1-data">
                    <div class="table1-PFP-small mar-end-1"></div>
                    <small class="text-m2 flex-grow-1">Employee Name</small>
                    <small class="text-m2 flex-grow-1">Employee ID</small>
                    <small class="text-m2 flex-grow-1">Employee Email</small>
                    <small class="text-m2 flex-grow-1">Department</small>
                    <small class="text-m2 flex-grow-1">Status</small>
                </div>
                <div class="table1-data last">
                    <div class="table1-PFP-small mar-end-1"></div>
                    <small class="text-m2 flex-grow-1">Employee Name</small>
                    <small class="text-m2 flex-grow-1">Employee ID</small>
                    <small class="text-m2 flex-grow-1">Employee Email</small>
                    <small class="text-m2 flex-grow-1">Department</small>
                    <small class="text-m2 flex-grow-1">Status</small>
                </div>
            </div>
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
