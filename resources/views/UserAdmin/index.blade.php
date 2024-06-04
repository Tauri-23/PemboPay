<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PemboPay | Admin</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/treasury-dash.css">
        <link rel="stylesheet" href="/assets/css/forms.css">
        <link rel="stylesheet" href="/assets/css/tables.css">

        {{-- Icon --}}
        <link rel="icon" href="/assets/media/logos/mwp-pembo.png" type="image/x-icon" />

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        
        {{-- Boxicons --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="1"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Dashboard"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2">

            <div class="w-100 d-flex gap2">
                <div class="dash-short-cont flex-grow-1">
                    <div class="d-flex align-items-center gap2">
                        <div class="text-m1 fw-bold">Total Accountants</div>
                    </div>
                    <div class="line1 mar-top-3 mar-bottom-3"></div>
                    <div class="text-l3 fw-bold">
                        {{$accountants->count()}}
                    </div>
                </div>


                <div class="dash-short-cont flex-grow-1">
                    <div class="d-flex align-items-center gap2">
                        <div class="text-m1 fw-bold">Total Accountant Logs</div>
                    </div>
                    <div class="line1 mar-top-3 mar-bottom-3"></div>
                    <div class="text-l3 fw-bold">
                        {{$logs->count()}}
                    </div>
                </div>
            </div>
            
            {{-- Accountants --}}
            <div class="long-cont">
                <div class="d-flex justify-content-between align-items-center mar-bottom-1">
                    <div class="text-m1 fw-bold">Accountants</div>
                </div>
                <x-render_accountant :accountants="$accountants" count="10"/>
            </div>

            <div class="long-cont">
                <div class="d-flex justify-content-between align-items-center mar-bottom-1">
                    <div class="text-m1 fw-bold">Accountant Logs</div>
                </div>
                <x-render_accountant_logs :logs="$logs" count="10"/>
            </div>
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
