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
        <x-sidenav activeLink="3"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Payroll History"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-x gap2 position-relative">
            <div class="long-cont text-l3 bold">
                <div class="flex gap3">Payroll History <i class="bi bi-clock-history"></i></div>
            </div>

            <div class="table1">
                <div class="table1-header">
                    <div class="w-50 flex-grow-1">Payroll Period</div>
                    <div class="w-50 flex-grow-1">Total HoursWorked</div>
                    <div class="w-50 flex-grow-1">Total BasicPay</div>
                    <div class="w-50 flex-grow-1">Total GrossPay</div>
                    <div class="w-50 flex-grow-1">Total NetPay</div>
                    <div class="w-50 flex-grow-1">Processed Date</div>
                </div>

                <a href="" class="table1-data">
                    <div class="w-50 flex-grow-1">April 15 2023</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">MMM dd, yyyy hh:mm:ss tt</div>
                </a>

                <a href="" class="table1-data">
                    <div class="w-50 flex-grow-1">April 15 2023</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">MMM dd, yyyy hh:mm:ss tt</div>
                </a>

                <a href="" class="table1-data last">
                    <div class="w-50 flex-grow-1">April 15 2023</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">₱ 0.00</div>
                    <div class="w-50 flex-grow-1">MMM dd, yyyy hh:mm:ss tt</div>
                </a>
            </div>
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
