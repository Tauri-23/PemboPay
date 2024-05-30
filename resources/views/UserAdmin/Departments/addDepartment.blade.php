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
        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        <x-modals modalType="close"/>
        <x-modals modalType="info-yn"/>

        {{-- Sidenav --}}
        <x-admin_side_nav activeLink="4"/>
        

        {{-- Navbar --}}
        <x-admin_navbar title="Departments"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <form method="post" class="w-100">
                @csrf
                <div class="long-cont d-flex flex-direction-y gap2">
                    <div>
                        <label for="dept-name-in" class="text-m2 bold">Department Name</label>
                        <input type="text" class="edit-text-1 w-100" id="dept-name-in" placeholder="Department Name" />
                        <div class="color-AppRed d-none" id="dept-name-required">Please enter Department Name</div>
                    </div>

                    <div>
                        <label for="dept-tag-in" class="text-m2 bold">Department Tag (2 Characters)</label>
                        <input type="text" class="edit-text-1 w-100 text-form-uc" id="dept-tag-in" maxlength="2" placeholder="e.g. AD" />
                        <div class="color-AppRed d-none" id="dept-tag-required">Please enter Department Tag</div>
                    </div>
                    

                    
                
                    <input type="hidden" id="dept-bg-in" value="" placeholder="Department Background" />
                    <div class="d-flex flex-direction-y gap3 mar-top-1">
                        <small class="text-m2 bold">Choose Background</small>
                        <div class="d-flex flex-wrap gap3 w-100">
    
                            {{-- Enclose with loop --}}
                            @for ($i = 1; $i < 11; $i++)
                                <div class="dept-bg-select-cont" style="">
                                    <div class="deptBgOverlay d-none">Selected</div>
                                    <img class="position-absolute w-100 h-100 dept-bg-pic" id="bg{{$i}}.jpg" src="/assets/media/dept-pfp/bg{{$i}}.jpg" loading="lazy" />
                                </div>
                            @endfor

                        </div>
                        <div class="color-AppRed d-none" id="dept-pic-required">Please select Department Picture</div>
                        <div class="w-100 d-flex justify-content-end">
                            <a class="secondary-btn3-small mar-top-1 d-none" id="clear-selection">Clear Selected Background</a>
                        </div>
                
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <a class="primary-btn1-long mar-top-1" id="add-department">Add Department</a>
                    </div>
                
                </div>
            </form>
            
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="/assets/js/admin-add-department.js"></script>
</html>
