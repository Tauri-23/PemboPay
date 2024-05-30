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

        {{-- Boxicons --}}
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        {{-- Modals --}}
        <x-modals modalType="add-dept-position"/>
        <x-modals modalType="edit-dept-position"/>

        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        <x-modals modalType="warning-yn"/>

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="4"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Departments Settings | {{$department->department_name}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <div class="department-cover-cont d-flex align-items-center">
                <div class="mar-start-2" style="z-index: 2;">
                    <div class="text-xl2 fw-bold color-white">{{$department->department_name}} ({{$department->department_tag}})</div>
                </div>
                
                <img class="position-absolute w-100" src="/assets/media/dept-pfp/{{$department->department_pfp}}" />
                <div class="overlay-blur-dark" style="z-index: 1;"></div>
            </div>

            <div class="long-cont d-flex align-items-center justify-content-between">
                <div class="text-l2">Department Positions</div>
                <div class="primary-btn1-small" id="add-position"><i class="bi bi-plus-square-fill mar-end-3"></i>Add Position</div>
            </div>

            {{-- Render Positions --}}
            <div class="">
                <x-admin_render_dept_pos :positions="$positions"/>
            </div>
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        const salGrades = @json($salGrades);
        const deptId = @json($deptId);
        const positions = @json($positions);
    </script>
    
    <script src="/assets/js/admin-dept-settings.js"></script>
</html>
