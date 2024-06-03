<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay | Login</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
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
        {{-- Modals --}}
        <x-LoginModals modalType="wrong-credentials"/>
        <x-LoginModals modalType="something-went-wrong"/>

        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        
        {{-- Main Content --}}

        {{-- Login --}}
        <div class="container-box-s center-absolute-xy" id="login-box">

            <div class="logo-l logo-login">
                <img class="position-absolute w-100 h-100" src="/assets/media/logos/mwp-pembo.png" />
            </div>

            <p class="text-l1 text-center bold mar-top-1">PemboPay</p>

            
            <form method="post" id="treasury-login-form">
                @csrf
                <input id="username" name="username" class="edit-text-1 w-100 mar-top-2" placeholder="Username" type="text" />
                <div class="d-flex position-relative align-items-center mar-top-2">
                    <input id="password" name="password" class="edit-text-1 w-100 password-input" placeholder="Password" type="password" />
                    <i class="bi bi-eye-fill position-absolute right3 cursor-pointer see-pass"></i>
                </div>
                <div class="w-100 d-flex justify-content-end mar-top-3">
                    <a class="link-m3" id="forgot-pass-btn">Forgot Password</a>
                </div>
                <div class="d-flex flex-direction-y gap3 mar-top-1">
                    <button id="login-btn" class="primary-btn1-small w-100">Login</button>
                    <a href="/EmployeeTimeIn" class="secondary-btn3-small w-100 text-center">Employee Time in/out</a>
                </div>
            </form>

            <div class="w-100 d-flex flex-direction-y align-items-center mar-top-3">
                <a href="/Employee" class="link-m3">Employee Login</a>
            </div>
            
        </div>


        {{-- Forgot Password 1 --}}
        <div class="container-box-s center-absolute-xy d-none" id="forgot-password-email-cont">

            <div class="logo-l logo-login">
                <img class="position-absolute w-100 h-100" src="/assets/media/logos/mwp-pembo.png" />
            </div>

            <p class="text-l1 text-center bold mar-top-1">Forgot Password</p>

            
            <form method="post" id="treasury-login-form">
                @csrf
                <input id="forgot-pass-email-in" class="edit-text-1 w-100 mar-top-2" placeholder="Email" type="text" />
                <div id="next-btn" class="primary-btn1-small w-100 mar-top-1 text-center">Next</div>
            </form>
            
        </div>


        {{-- Forgot Password 2 --}}
        <div class="container-box-s center-absolute-xy d-none" id="forgot-password-otp-cont">

            <div class="logo-l logo-login">
                <img class="position-absolute w-100 h-100" src="/assets/media/logos/mwp-pembo.png" />
            </div>

            <p class="text-l1 text-center bold mar-top-1">Forgot Password</p>

            
            <form method="post" id="treasury-login-form">
                @csrf
                <input id="forgot-pass-otp-in" class="edit-text-1 w-100 mar-top-2" placeholder="OTP" type="text" />
                <div id="next-btn" class="primary-btn1-small w-100 mar-top-1 text-center">Next</div>
            </form>
            
        </div>


        {{-- Forgot Password 3 --}}
        <div class="container-box-s center-absolute-xy d-none" id="forgot-password-change-cont">

            <div class="logo-l logo-login">
                <img class="position-absolute w-100 h-100" src="/assets/media/logos/mwp-pembo.png" />
            </div>

            <p class="text-l1 text-center bold mar-top-1">Forgot Password</p>

            
            <form method="post" id="treasury-login-form">
                @csrf
                <div class="d-flex position-relative align-items-center mar-top-2">
                    <input id="new-pass-in" class="edit-text-1 w-100 password-input" placeholder="New Password" type="password" />
                    <i class="bi bi-eye-fill  position-absolute right3 cursor-pointer see-pass" id="show-pass-btn-newpass"></i>
                </div>
                <div class="d-flex position-relative align-items-center mar-top-2">
                    <input id="con-new-pass-in" class="edit-text-1 w-100 password-input" placeholder="Confirm Password" type="password" />
                    <i class="bi bi-eye-fill position-absolute right3 cursor-pointer see-pass"></i>
                </div>
                <div id="change-pass-btn" class="primary-btn1-small w-100 mar-top-1 text-center">Change Password</div>
            </form>
            
        </div>







    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/login.js"></script>
    <script src="/assets/js/forgot-pass.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
