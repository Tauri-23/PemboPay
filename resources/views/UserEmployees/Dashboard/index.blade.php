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
        {{-- <x-sidenav activeLink="1"/> --}}

        {{-- nav small option --}}
        {{-- <x-NavSmallOption/> --}}
        

        {{-- Navbar --}}
        {{-- <x-navbar titleString="Dashboard" pfp="{{$loggedTreasury->pfp}}"/> --}}
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2">
            
            <div class="container-box-s center-absolute-xy d-flex flex-direction-y gap2 align-items-center">
                <img class="modal-pfp" src="/assets/media/pfp/{{$loggedEmployee->pfp}}" alt="pfp">

                <div class="d-flex flex-direction-y text-center">
                    <div class="text-l3">Welcome {{$loggedEmployee->firstname}} {{$loggedEmployee->lastname}}</div>
                    <div class="text-l2 fw-bold" id="dateTime"></div>
                </div>
    
                <div class="d-flex gap1">
                    <a class="primary-btn1-small">Time In</a>
                    <a class="primary-btn1-small">Time Out</a>
                </div>
            </div>
            
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/employee-dash.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
