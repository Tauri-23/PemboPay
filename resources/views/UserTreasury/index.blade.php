<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PemboPay</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/treasury-dash.css">
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
        

        {{-- Sidenav --}}
        <x-sidenav activeLink="1"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Dashboard" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2">
            
            <div class="long-cont d-flex justify-content-between align-items-center">
                <div class="text-m1 fw-bold">Payroll Year</div>
                <select id="select-year" class="select-med">
                    <option value="all-time" selected>All time</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>

            <div class="w-100 d-flex gap2">
                <div class="dash-short-cont">
                    <div class="d-flex align-items-center gap2">
                        <div class="small-icon-cont-circle bg-AppBlueLight2">
                            <i class="bi bi-people-fill color-AppBlue"></i>
                        </div>
                        <div class="text-m1 fw-bold">Total Employees</div>
                    </div>
                    <div class="line1 mar-top-3 mar-bottom-3"></div>
                    <div class="text-l3 fw-bold">
                        0
                    </div>
                </div>


                <div class="dash-short-cont">
                    <div class="d-flex align-items-center gap2">
                        <div class="small-icon-cont-circle bg-AppGreenLight1">
                            <i class="bi bi-buildings-fill color-AppGreen"></i>
                        </div>
                        <div class="text-m1 fw-bold">Total Departments</div>
                    </div>
                    <div class="line1 mar-top-3 mar-bottom-3"></div>
                    <div class="text-l3 fw-bold">
                        0
                    </div>
                </div>


                <div class="dash-short-cont">
                    <div class="d-flex align-items-center gap2">
                        <div class="small-icon-cont-circle bg-AppGoldLight1">
                            <i class="bi bi-bank2 color-AppGold"></i>
                        </div>
                        <div class="text-m1 fw-bold">Budget</div>
                    </div>
                    <div class="line1 mar-top-3 mar-bottom-3"></div>
                    <div class="text-l3 fw-bold">
                        ₱ 1,000,000.00
                    </div>
                </div>
            </div>
            
            <div class="flex-wrap-cont mar-bottom-1">
                {{-- Salary Trend --}}
                <div class="med-cont-2">
                    <div class="d-flex justify-content-between align-items-center mar-bottom-1">
                        <div class="text-m1 fw-bold">Salary Chart</div>
                        <div>
                            <select id="select-mode" class="select-med">
                                <option value="all" selected>Gross</option>
                                <option value="2023">Regular</option>
                            </select>
                        </div>
                    </div>

                    <canvas class="w-100" id="compentsation-chart"></canvas>
        
                </div>
        
                {{-- Budget Trend --}}
                <div class="med-cont-2">
                    <div class="d-flex justify-content-between align-items-center mar-bottom-1">
                        <div class="text-m1 fw-bold">Budget Chart</div>
                        <div>
                            <select id="select-mode" class="select-med">
                                <option value="all" selected>Gross</option>
                                <option value="2023">Regular</option>
                            </select>
                        </div>
                    </div>

                    <canvas class="w-100" id="budget-chart"></canvas>
                </div>
        
                {{-- Employee Trend --}}
                <div class="med-cont-2">
                    <div class="d-flex justify-content-between align-items-center mar-bottom-1">
                        <div class="text-m1 fw-bold">Employee Chart</div>
                    </div>

                    <canvas class="w-100" id="employee-chart"></canvas>
                </div>
        
                <div class="med-cont-2">
                    <div class="flex w-100 justify-content-between align-items-start">
                        <small class="text-m2 bold">Employees in Department</small>
                        <small class="month-year text-m3">@Model.CurrentMonth - @Model.CurrentYear</small>
                    </div>
                    <div class="donut-chart-cont mar-top-2">
                        <div>
                            <canvas id=""></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/treasury-dash.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
