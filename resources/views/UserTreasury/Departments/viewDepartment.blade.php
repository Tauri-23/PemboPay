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
        <link rel="stylesheet" href="/assets/css/departments.css">
        <link rel="stylesheet" href="/assets/css/tables.css">
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
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        <x-modals modalType="close"/>
        <x-modals modalType="close-yn"/>

        {{-- Sidenav --}}
        <x-sidenav activeLink="7"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Departments" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <div class="department-cover-cont d-flex align-items-center">
                <div class="mar-start-2" style="z-index: 2;">
                    <div class="text-xl2 fw-bold color-white">{{$department->department_name}}</div>
                    <div class="color-white d-flex flex-direction-y">
                        <small class="text-m1">{{$employees->Count()}}</small>
                        <small class="text-m3">{{$employees->Count() > 1 ? "Employees" : "Employee"}}</small>
                    </div>
                </div>
                
                <img class="position-absolute w-100" src="/assets/media/dept-pfp/{{$department->department_pfp}}" />
                <div class="overlay-blur-dark" style="z-index: 1;"></div>
            </div>


            <div class="w-100 d-flex justify-content-between mar-top-2 mar-bottom-3">
                <a href="/TreasuryDepartments" class="d-flex gap3 text-black text-decoration-none align-items-center text-m1">
                    <i class="fa-solid fa-chevron-left"></i>Back
                </a>
            
                <form method="post">
                    @csrf
                    <div class="d-flex gap3">
                        <a href="/TreasuryAddEmployees" class="primary-btn3-small">
                            <i class="bi bi-person-plus-fill mar-end-3"></i>Add Employee
                        </a>

                        <button id="edit-dept-btn" class="secondary-btn1-small">
                            <i class="fa-solid fa-pen-to-square mar-end-3"></i>Edit Department
                        </button>
                        
                        <button id="del-dept-btn" class="secondary-btn2-small">
                            <i class="bi bi-building-fill-x mar-end-3"></i>Delete Department
                        </button>
                    </div>
                </form>
            </div>



            {{-- Render Employees --}}
            <x-TreasuryEmloyeesTable :employees="$employees"/>
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        const employees = {!! json_encode($employees) !!};
        const deptId = {!! json_encode($department->id) !!}
    </script>
    <script src="/assets/js/view-department.js"></script>
</html>
