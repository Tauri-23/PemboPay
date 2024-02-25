<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PemboPay</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/treasury-dash.css">

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
        <x-sidenav activeLink="1"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Dashboard"/>
        

        {{-- Content --}}
        <div class="content-cont-1">
            <div class="long-cont">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <small class="text-m1 bold">Payroll Period</small>
                    <div>
                        <select id="select-year" class="select-long">
                            <option value="2023">2023</option>
                            <option value="2023">2024</option>
                            <option value="2023">2025</option>
                            <option value="2023">2026</option>
                            <option value="2023">2027</option>
                        </select>
                        <select id="select-month" class="select-long">
                            <option value="">January</option>
                            <option value="">February</option>
                            <option value="">March</option>
                            <option value="">April</option>
                            <option value="">May</option>
                            <option value="">June</option>
                            <option value="">July</option>
                            <option value="">August</option>
                            <option value="">September</option>
                            <option value="">October</option>
                            <option value="">November</option>
                            <option value="">December</option>
                        </select>
                    </div>
                </div>
        
            </div>
            
            <div class="flex-wrap-cont mar-top-2 mar-bottom-1">
                <div class="med-cont-1">
                    <div class="dash-table-cont1">
        
                        <div class="flex-grow-1 padding-x-3" style="border-right: 1px solid #DDDDDD;">
                            <div class="small-icon-cont-circle bg-AppBlueLight2">
                                <i class="icons1 color-AppBlue bi bi-people-fill"></i>
                            </div>
                            <small class="text-m1 bold" id="totalEmp">0</small><br />
                            <small class="text-m2">Total Employees</small>
                        </div>
        
                        <div class="flex-grow-1" style="padding: 0 20px; border-right: 1px solid #DDDDDD;">
                            <div class="small-icon-cont-circle bg-AppGreenLight1">
                                <i class="icons1 color-AppGreen bi bi-buildings-fill"></i>
                            </div>
                            <small class="text-m1 bold" id="totalDept">0</small><br />
                            <small class="text-m2">Total Departments</small>
                        </div>
        
                        <div class="flex-grow-1" style="padding: 0 20px;">
                            <div class="small-icon-cont-circle bg-AppGoldLight1">
                                <i class="icons1 color-AppGold fa-solid fa-coins"></i>
                            </div>
                            <small class="text-m1 bold" id="totalComp">0</small><br />
                            <small class="text-m2">Total Compensation</small>
                        </div>
        
                    </div>
        
                    <div class="d-flex justify-content-center align-items-center padding1">
                        <div>
                            <small class="text-m1">Next Payroll Date : </small>
                            <small class="text-m1 bold color-AppGold">15 January, 2024</small>
                            <div class="d-flex mar-top-3 gap2">
                                <a asp-page="PayrollHistory/index" class="secondary-btn3-small d-flex align-items-center">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <small class="text-m2 mar-start-3">Payroll History</small>
                                </a>
                                <a asp-page="RunPayroll/index" class="primary-btn1-small d-flex align-items-center">
                                    <small class="text-m2 color-white">Run Payroll</small>
                                </a>
                            </div>
                        </div>
                    </div>
        
                </div>
        
                <div class="med-cont-2">
                    <div class="d-flex w-100 justify-content-between align-items-start">
                        <small class="text-m2 bold">Employees in Departments</small>
                        <small class="month-year text-m3">January - 2023</small>
                    </div>
                </div>
        
                <div class="med-cont-2">
                    <div class="flex w-100 justify-content-between align-items-start">
                        <small class="text-m2 bold">Compensation</small>
                        <small class="month-year text-m3">@Model.CurrentMonth - @Model.CurrentYear</small>
                    </div>
                    <div class="donut-chart-cont mar-top-2">
                        <div class="text-m2 bold text-center-self h-100 @(totalCompensation > 0 ? "d-none" : "")" id="compensation-dist-null">No Data</div>
                        <div>
                            <canvas class="@(totalCompensation > 0 ? "" : "d-none")" id="compensation-distribution-chart"></canvas>
                        </div>
                    </div>
                    <div class="mar-top-2" id="compensationDeptTotal">
                        <small class="bold text-m1 @(totalCompensation > 0 ? "" : "d-none")">@string.Format("₱{0:N2}", totalCompensation)</small><br />
                        <small class="text-m3 @(totalCompensation > 0 ? "" : "d-none")">Total Compensation</small>
                    </div>
        
                </div>
        
                <div class="med-cont-2">
                    <div class="flex w-100 justify-content-between align-items-start">
                        <small class="text-m2 bold">Employees in Department</small>
                        <small class="month-year text-m3">@Model.CurrentMonth - @Model.CurrentYear</small>
                    </div>
                    <div class="donut-chart-cont mar-top-2">
                        <div>
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
