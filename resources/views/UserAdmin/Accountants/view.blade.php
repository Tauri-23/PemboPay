<!DOCTYPE html>
@php
    use Carbon\Carbon;
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay - View Employee</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/forms.css">
        <link rel="stylesheet" href="/assets/css/tables.css">
        <link rel="stylesheet" href="/assets/css/view-employee.css">

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
        {{-- Modals --}}
        <form method="post">
            <x-edit_accountant_profile_modals modalType="acc-edit-info-personal" />
            <x-edit_accountant_profile_modals modalType="acc-edit-password" />
            {{-- <x-editEmployeeProfileModal modalType="emp-edit-info-personal" :cities="$cities" :brgys="$brgys"/>
            <x-editEmployeeProfileModal modalType="emp-edit-info-address" :cities="$cities" :brgys="$brgys"/> --}}
        </form>
        
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="2"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Accountant | {{$accountant->Firstname . ' ' . $accountant->Lastname}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">
            
            <div class="d-flex justify-conten-start">
                <a href="/AdminAccountants" class="d-flex gap3 text-black text-decoration-none align-items-center text-m1">
                    <i class="fa-solid fa-chevron-left"></i>Back
                </a>
            </div>

            {{-- Personal Profile Container --}}
            <div class="d-flex gap1 h-100 mar-bottom-1" id="personal-profile-content">

                {{-- Vertical Info Container --}}
                <div class="long-cont-vertical align-self-start">
                    <div class="d-flex flex-direction-y gap1 position-relative">
                        <div class="mini-Profile-PFP m-auto position-relative d-flex justify-content-center">
                            <form method="post"></form>
                            <img id="pfp" src="/assets/media/pfp/{{ $accountant->pfp }}" class="h-100 position-absolute" />
                        </div>
                        <div class="text-center">
                            <small class="text-l2 bold">{{ $accountant->Firstname . ' ' . $accountant->Lastname }}</small><br />
                            <small class="text-m1">Accountant</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3 mar-top-1">
                            <small class="text-m2 bold">Employee ID</small>
                            <small class="text-m2">{{ $accountant->id }}</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3">
                            <small class="text-m2 bold">Email</small>
                            <small class="text-m2">{{ $accountant->email }}</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3">
                            <small class="text-m2 bold">Joined</small>
                            <small class="text-m2">{{ \Carbon\Carbon::parse($accountant->created_at)->format('M d, Y') }}</small>
                        </div>
                    </div>
                </div>



                {{-- Horizontal Infos --}}
                <div class="flex-grow-1 d-inline-flex flex-direction-y gap2">
                    
                    {{-- Personal Informations --}}
                    <div class="long-cont3 d-flex flex-direction-y gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Personal Information</div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3 mar-top-3">
                            <small class="w-50">First Name:</small>
                            <small class="w-100" id="fname">{{ $accountant->Firstname}}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Middle Name:</small>
                            <small class="w-100" id="mname">{{ $accountant->Middlename ?? "N/A"}}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Last Name:</small>
                            <small class="w-100" id="lname">{{ $accountant->Lastname }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Gender:</small>
                            <small class="w-100" id="lname">{{ $accountant->gender }}</small>
                        </div>
                    </div>

                    {{-- Personal Informations --}}
                    {{-- <div class="long-cont3 d-flex flex-direction-y gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Credentials</div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3 mar-top-3">
                            <small class="w-50">Password:</small>
                            <input type="password" class="edit-text-1 disabled w-100" value="{{$accountant->password}}" id="" disabled>
                        </div>
                    </div> --}}

                    {{-- Personal Activities --}}
                    <div class="long-cont3 d-flex flex-direction-y gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Latest Logs</div>
                        <x-render_accountant_logs :logs="$logs" count="null"/>
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
