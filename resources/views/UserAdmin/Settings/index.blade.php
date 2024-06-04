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
        <link rel="stylesheet" href="/assets/css/payroll-settings.css">
        <link rel="stylesheet" href="/assets/css/forms.css">
        <link rel="stylesheet" href="/assets/css/tables.css">

        {{-- Icon --}}
        <link rel="icon" href="/assets/media/logos/mwp-pembo.png" type="image/x-icon" />

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Boxicons --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        {{-- Modals --}}
        <x-modals modalType="edit-sal-grade"/>
        <x-modals modalType="add-sal-grade"/>
        <x-modals modalType="add-tax-exempt"/>


        <x-modals modalType="add-taxes"/>
        <x-modals modalType="add-allowance"/>
        <x-modals modalType="add-deduction"/>

        <x-modals modalType="warning-yn"/>
        <x-modals modalType="warning-yn"/>
        <x-modals modalType="warning-yn"/>
        <x-modals modalType="warning-yn"/>

        <x-modals modalType="success"/>
        <x-modals modalType="error"/>

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="6"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Settings"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            {{-- Category --}}
            <div class="long-cont d-flex flex-direction-y gap2">
                <div class="text-m2 bold">Category</div>
                <div class="flex gap3">
                    <a id="sal-grade-btn" class="category-btn-1 {{$page == 'default' ? 'active' : ''}}">Salary Grade</a>
                    <a id="tax-exempt-btn" class="category-btn-1 {{$page == 'contributions' ? 'active' : ''}}">Contributions</a>
                    <a id="allowance-btn" class="category-btn-1 {{$page == 'allowances' ? 'active' : ''}}">Allowances</a>
                    <a id="deductions-btn" class="category-btn-1 {{$page == 'deductions' ? 'active' : ''}}">Deductions</a>
                    <a id="payperiod-btn" class="category-btn-1 {{$page == 'payrollperiod' ? 'active' : ''}}">Payroll Period</a>
                </div>
            </div>

            {{-- Salary Grades --}}
            <div id="sal-grade-table" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1 {{$page == 'default' ? '' : 'd-none'}}">
                <div id="hourly-rate-content" class="d-flex flex-direction-y gap3">

                    <div class="text-l3 bold"> Salary Grade </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    {{-- Render --}}
                    <x-admin_render_sal_grade :elements="$salGrades"/>

                    <div class="d-flex gap3 mar-top-1 justify-content-end w-100">
                        <a id="add-sal-grade-btn" class="primary-btn1-long">Add Salary Grade</a>
                    </div>
                </div>
            </div>





            {{-- Contributions --}}
            <div id="tax-exempt-table" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1 {{$page == 'contributions' ? '' : 'd-none'}}">
                <div id="hourly-rate-content" class="d-flex flex-direction-y gap3">

                    <div class="text-l3 bold"> Contributions </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    {{-- Render --}}
                    <x-admin_render_tax_exempts :elements="$taxExempts"/>

                    <div class="d-flex gap3 mar-top-1 justify-content-end w-100">
                        <a id="add-tax-exempt-btn" class="primary-btn1-long">Add Contribution</a>
                    </div>
                </div>
            </div>



            {{-- Allowances --}}
            <div id="allowances-table" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1 {{$page == 'allowances' ? '' : 'd-none'}}">
                <div id="hourly-rate-content" class="d-flex flex-direction-y gap3">

                    <div class="text-l3 bold"> Allowances </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    {{-- Render --}}
                    <x-render-settings-tables :elements="$allowances" elementsName="Allowances"/>

                    <div id="save-btn-hrly-rate" class="d-flex gap3 mar-top-1 justify-content-end w-100">
                        <a id="add-allowance-btn" class="primary-btn1-long">Add Allowance</a>
                    </div>
                </div>
            </div>



            {{-- Deductions --}}
            <div id="deductions-table" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1 {{$page == 'deductions' ? '' : 'd-none'}}">
                <div id="hourly-rate-content" class="d-flex flex-direction-y gap3">

                    <div class="text-l3 bold"> Deductions </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    {{-- Render --}}
                    <x-render-settings-tables :elements="$deductions" elementsName="Deductions"/>

                    <div id="save-btn-hrly-rate" class="d-flex gap3 mar-top-1 justify-content-end w-100">
                        <a id="add-deduction-btn" class="primary-btn1-long">Add Deduction</a>
                    </div>
                </div>
            </div>



            {{-- Payroll Period --}}
            <div id="payroll-period-table" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1 {{$page == 'payrollperiod' ? '' : 'd-none'}}">
                <div id="hourly-rate-content" class="d-flex flex-direction-y gap3">

                    <div class="text-l3 bold"> Payroll Period </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    <div class="text-m1">Payroll Period</div>
                    <input type="text" class="edit-text-1 w-100" value="{{$payrollPeriod->payroll_Period}}" disabled>

                    <div class="text-m1">Payroll Cutoff (days before payday)</div>
                    <input type="text" class="edit-text-1 w-100" value="{{$payrollPeriod->payroll_cutoff}}" disabled>

                </div>
            </div>



        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>

    <script>
        const salGrades = @json($salGrades);
        const taxExempts = @json($taxExempts);
        const allowances = @json($allowances);
        const deductions = @json($deductions);
    </script>
    <script src="/assets/js/admin-settings.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
