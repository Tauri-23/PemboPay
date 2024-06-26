<!DOCTYPE html>
@php
    use Carbon\Carbon; 
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay - My Profile</title>
        
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

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        {{-- Calendar CDN --}}
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.13/index.global.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>


        
    </head>
    <body>
        {{-- Modals --}}
        <form method="post">
            <x-editEmployeeProfileModal modalType="emp-edit-info-compensation" :cities="$cities" :brgys="$brgys"/>
            <x-editEmployeeProfileModal modalType="emp-edit-info-personal" :cities="$cities" :brgys="$brgys"/>
            <x-editEmployeeProfileModal modalType="emp-edit-info-address" :cities="$cities" :brgys="$brgys"/>
        </form>
        
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        

        {{-- Sidenav --}}
        <x-employee-sidenav activeLink="0"/>

        {{-- nav small option --}}
        <x-employee_nav_small_option/>
        

        {{-- Navbar --}}
        <x-navbar titleString="My Profile" pfp="{{$loggedEmployee->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            

            {{-- Personal Profile Container --}}
            <div class="d-flex gap1 h-100 mar-bottom-1" id="personal-profile-content">

                {{-- Vertical Info Container --}}
                <div class="long-cont-vertical align-self-start">
                    <div class="d-flex flex-direction-y gap1 position-relative">
                        <div class="mini-Profile-PFP m-auto position-relative d-flex justify-content-center">
                            <img id="pfp" src="/assets/media/pfp/{{ $employee->pfp }}" class="h-100 position-absolute" />
                        </div>
                        <div class="text-center">
                            <small class="text-l2 bold">{{ $employee->firstname . ' ' . $employee->lastname }}</small><br />
                            <small class="text-m1">{{ $employee->department()->first()->department_name }}</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3 mar-top-1">
                            <small class="text-m2 bold">Employee ID</small>
                            <small class="text-m2">{{ $employee->id }}</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3">
                            <small class="text-m2 bold">Email</small>
                            <small class="text-m2">{{ $employee->email }}</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3">
                            <small class="text-m2 bold">Phone Number</small>
                            <small class="text-m2">+63 {{ $employee->phone }}</small>
                        </div>
                        <div class="d-flex flex-direction-y gap3">
                            <small class="text-m2 bold">Joined</small>
                            <small class="text-m2">{{ \Carbon\Carbon::parse($employee->created_at)->format('M d, Y') }}</small>
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
                            <small class="w-100" id="fname">{{ $employee->firstname}}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Middle Name:</small>
                            <small class="w-100" id="mname">{{ $employee->middlename ?? "N/A"}}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Last Name:</small>
                            <small class="w-100" id="lname">{{ $employee->lastname }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">phone:</small>
                            <small class="w-100" id="phone">{{ '+63 ' . $employee->phone }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Gender:</small>
                            <small class="w-100" id="gender">{{ $employee->gender }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Birth Date:</small>
                            <small class="w-100">{{ \Carbon\Carbon::parse($employee->birth_date)->format('M d, Y') }}</small>
                        </div>
                    </div>


                    {{-- Addresses --}}
                    <div class="long-cont3 d-flex flex-direction-y gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Address</div>
                        
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3 mar-top-3">
                            <small class="w-50">Street Address:</small>
                            <small class="w-100">{{ $employee->street_address }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Barangay:</small>
                            <small class="w-100">{{ $employee->barangay()->first()->barangay }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">City:</small>
                            <small class="w-100">{{ $employee->city()->first()->city . ' City' }}</small>
                        </div>
                        <div class="d-flex text-m1 align-items-center gap3 mar-start-3">
                            <small class="w-50">Postal / Zip Code:</small>
                            <small class="w-100">{{ $employee->barangay()->first()->postal_code }}</small>
                        </div>
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
    </script>
    {{-- <script src="/assets/js/timesheet-calendar.js"></script> --}}
    <script src="/assets/js/view-employee.js"></script>
</html>
