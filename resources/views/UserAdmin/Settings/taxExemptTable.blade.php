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
        <x-modals modalType="add-tax-column"/>
        <x-modals modalType="edit-tax-column"/>
        <x-modals modalType="warning-yn"/>
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="6"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Settings"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <div class="d-flex justify-conten-start">
                <a href="/AdminSettings/contributions" class="d-flex gap3 text-black text-decoration-none align-items-center text-m1">
                    <i class="fa-solid fa-chevron-left"></i>Back
                </a>
            </div>
            {{-- Taxes --}}
            <div id="tax-table" class="long-cont d-flex flex-direction-y gap3 mar-bottom-1">
                <div id="hourly-rate-content" class="d-flex flex-direction-y gap3">

                    <div class="text-m2 bold">{{$taxExempt->name}} </div>
                    <div class="line1 mar-bottom-3 mar-top-3"> </div>

                    {{-- Render --}}
                    <x-admin_render_tax_exempt_values :elements="$taxExemptRows"/>

                    <div class="d-flex gap3 mar-top-1 justify-content-end w-100">
                        <a id="add-tax-exempt-row-btn" class="primary-btn1-long">Add Contribution Row</a>
                    </div>
                </div>
            </div>



        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        const taxId = @json($taxExempt->id);
        const taxExemptRows = @json($taxExemptRows);
    </script>
    <script src="/assets/js/admin-tax-exempt-table.js"></script>
</html>
