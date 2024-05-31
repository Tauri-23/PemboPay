<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay | Admin</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/tables.css">
        <link rel="stylesheet" href="/assets/css/forms.css">

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
        <x-modals modalType="emp-mini-profile-1"/>
        <x-modals modalType="warning-yn"/>
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="3"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Employees"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <div class="long-cont d-flex justify-content-between align-items-center">
                <div class="d-flex gap3">
                    <div class="d-flex position-relative align-items-center">
                        <i class="fa-solid fa-magnifying-glass position-absolute text-m1 padding-start-4"></i>
                        <input id="search-emp" class="edit-text-2" name="searchEmp" type="text" placeholder="Search Name or ID" autocomplete="off" />
                    </div>
                    
                    <select class="select-med input-light-grey" id="sort-emp">
                        <option value="all">All</option>
                        <option value="a-z">a-z</option>
                        <option value="z-a">z-a</option>
                    </select>
                </div>

                {{-- <a href="/AdminAddEmployees" class="primary-btn1-small d-flex align-items-center">
                    <i class="bi bi-person-fill-add mar-end-3 text-m1"></i>
                    Add Employee
                </a> --}}
            </div>
            
            <div id="original-emp-cont">
                <x-admin_employees_table :employees="$employees"/>
            </div>

            <div id="sort-result-emp-cont">
                
            </div>
            


        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        const employeesList = {!! json_encode($employees) !!};
    </script>
    <script src="/assets/js/admin-employees.js"></script>
</html>
