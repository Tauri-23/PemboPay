<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/forms.css">

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        {{-- Modals --}}
        <x-LoginModals modalType="wrong-credentials"/>
        <x-LoginModals modalType="something-went-wrong"/>
        
        {{-- Main Content --}}
        <div class="container-box-s center-absolute-xy">
            <div class="logo-l logo-login">
                <img class="position-absolute w-100 h-100" src="/assets/media/logos/mwp-pembo.png" />
            </div>

            <p class="text-l1 text-center bold mar-top-1">PemboPay Treasury</p>

            <form method="post" id="treasury-login-form">
                @csrf
                <input id="username" name="username" class="edit-text-1 w-100 mar-top-2" placeholder="Username" type="text" />
                <div class="d-flex position-relative align-items-center mar-top-2">
                    <input id="password" name="password" class="edit-text-1 w-100" placeholder="Password" type="password" />
                    <i class="fa-solid fa-eye position-absolute right3 cursor-pointer" id="show-pass-btn"></i>
                </div>
                <button id="login-btn" class="primary-btn1-small w-100 mar-top-1">Login</button>
            </form>

            

            <div class="w-100 d-flex justify-content-center mar-top-3">
                <a class="link-m3">Forgot Password</a>
            </div>
            <div class="w-100 d-flex justify-content-center">
                <a class="link-m3">System Admin Login</a>
            </div>
            
        </div>
    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
