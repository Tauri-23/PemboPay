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
        <link rel="stylesheet" href="/assets/css/payroll-settings.css">
        <link rel="stylesheet" href="/assets/css/forms.css">

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

        {{-- Sidenav --}}
        <x-sidenav activeLink="8"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Employees" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            {{-- Category --}}
            <div class="long-cont d-flex flex-direction-y gap2">
                <div class="text-m2 bold">Category</div>
                <div class="flex gap3">
                    <a id="hrlyRateBtn" class="category-btn-1 active">Taxes</a>
                    <a id="allowanceRateBtn" class="category-btn-1">Allowances</a>
                    <a id="deductions-btn" class="category-btn-1">Deductions</a>
                    <a id="payPeriodBtn" class="category-btn-1">Payroll Period</a>
                </div>
            </div>

            {{--  --}}
            <div id="config-container" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1">
                <div id="hourly-rate-content" class="flex flex-direction-d gap3">

                    <div class="text-m2 bold"> Taxes </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    <div class="d-flex justify-content-between">
                        <div class="text-m2">SSS</div>
                        <div class="text-m2">₱<input id="@i.Department_ID" type="number" step="any" value="@i.Hourly_Rate" class="editText1 hrlyRateSettings mar-start-3 deptHlryRate" /> </div>
                    </div>

                    <div id="save-btn-hrly-rate" class="flex gap3 mar-top-1 justify-content-end w-100">
                        <a id="saveSettingBtn" class="primary-btn1-long">Save</a>
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
