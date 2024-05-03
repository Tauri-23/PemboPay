<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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

        {{-- Font Awesome --}}
        <script src="https://kit.fontawesome.com/04f0992e18.js" crossorigin="anonymous"></script>

        {{-- Jquery --}}
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        {{-- Modals --}}
        <x-modals modalType="emp-mini-profile-1"/>
        <x-modals modalType="emp-edit-info-personal"/>
        <x-modals modalType="emp-edit-info-address"/>
        

        {{-- Sidenav --}}
        <x-sidenav activeLink="6"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="{{$employee->firstname . ' ' . $employee->lastname}}" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <div class="long-cont-nopadding padding-start-4 padding-end-4 d-flex gap3 mar-bottom-3">
                <div class="nav-link-2 active" id="personal-page">Personal</div>
                <div class="nav-link-2" id="timesheet-page">Time Sheets</div>
            </div>

            {{-- Personal Profile Container --}}
            <div class="d-flex gap1 h-100 mar-bottom-1" id="personal-profile-content">

                {{-- Vertical Info Container --}}
                <div class="long-cont-vertical align-self-start">
                    <div class="d-flex flex-direction-y gap1 position-relative">
                        <div class="mini-Profile-PFP m-auto position-relative d-flex justify-content-center">
                            <div id="change-pfp-btn" class="edit-overlay">
                                <i class="bi bi-pen-fill"></i>
                            </div>
                            <form method="post"></form>
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
                            <small class="text-m2">{{ $employee->created_at }}</small>
                        </div>
                    </div>
                </div>



                {{-- Horizontal Infos --}}
                <div class="flex-grow-1 d-inline-flex flex-direction-y gap2">
                    
                    {{-- Personal Informations --}}
                    <div class="long-cont3 d-flex flex-direction-y gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Personal Information</div>
                        <a id="edit-personal" class="secondary-btn1v2-small position-absolute right1">
                            <i class="fa-solid fa-pen-to-square mar-end-3"></i>Edit
                        </a>
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
                            <small class="w-100">{{ $employee->birth_date }}</small>
                        </div>
                    </div>


                    {{-- Addresses --}}
                    <div class="long-cont3 d-flex flex-direction-y gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Address</div>
                        <a id="edit-address" class="secondary-btn1v2-small position-absolute right1 edit-info-btn">
                            <i class="fa-solid fa-pen-to-square mar-end-3"></i>Edit
                        </a>
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


                    {{-- Compensation --}}
                    <div class="long-cont3 flex flex-direction-d gap1 position-relative">
                        <div class="text-l3 mar-bottom-3 bold">Compensation</div>
                        
                        <div class="mar-bottom-2">
                            <div class="mar-start-3 text-m1 mar-bottom-2">Compensation Type: {{ $employee->compensation()->first()->compentsation_type }}</div>
                            <div class="flex text-m1 align-items-center gap3 mar-start-3 mar-top-3">
                                <button id="edit-hourly-rate" class="primary-btn1-small position-absolute right1 text-m2">
                                    <i class="fa-solid fa-pen-to-square mar-end-3"></i>Edit {{ $employee->compensation()->first()->compentsation_type }}
                                </button>
                                <small class="w-50">{{ $employee->compensation()->first()->compentsation_type }}:</small>
                                <small class="w-100">{{ $employee->compensation()->first()->value }}</small>
                            </div>
                        </div>
                    </div>


                </div>

            </div>




            {{-- Time sheet Container --}}
            <div class="mar-bottom-1 d-none" id="timesheet-cont">
                <div class="d-flex flex-direction-d gap3">
                    <div class="timesheet-cont">
                        <div class="timesheet-head">
                            <small class="text-m2 bold">Time Sheet</small>
                            <div class="d-flex gap2">
                                <select class="select-long2" id="timesheet-months">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="February">March</option>
                                    <option value="February">April</option>
                                    <option value="February">May</option>
                                    <option value="February">June</option>
                                    <option value="February">July</option>
                                    <option value="February">August</option>
                                    <option value="February">September</option>
                                    <option value="February">October</option>
                                    <option value="February">November</option>
                                    <option value="February">December</option>
                                </select>

                                <select class="select-long2" id="timesheet-year">
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                </select>
                            </div>
                        </div>

                        <div class="line1 mar-top-3 mar-bottom-3"></div>


                        <div id="timesheet-canvas">

                            <div class="timesheet-table-header">
                                <small class="form-data-col fw-bold">Day</small>
                                <small class="form-data-col fw-bold">Time-in</small>
                                <small class="form-data-col fw-bold">Time-out</small>
                                <small class="form-data-col fw-bold">Status</small>
                            </div>

                            
                            
                            <div class="week-label">Week 1</div>
                            @php
                                $week = 1;
                            @endphp
                            {{-- Loops to Date in month now --}}
                            @foreach ($datesInRange as $date)  

                                @if ($date->format('l') == "Saturday")
                                    @continue;
                                @endif

                                @if ($date->format('l') == "Sunday")
                                    @php
                                        $week ++;
                                    @endphp
                                    <div class="week-label">week {{$week}}</div>
                                    @continue;
                                @endif


                                @php
                                    $dateString = $date->format('Y-m-d');
                                    $isHoliday = false;
                                    $isPresent = false;

                                    // Check if date is a holiday
                                    foreach ($holidays as $holiday) {
                                        if ($holiday->holiday_date == $dateString) {
                                            $isHoliday = true;
                                            break;
                                        }
                                    }


                                    // check if date hase timesheet data
                                    foreach ($timesheetDates as $time) {
                                        if($time->created_at->format('Y-m-d') == $dateString) {
                                            $isPresent = true;
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($date->now() < $date)
                                    <div class="timesheet-table-data null">
                                        <small class="form-data-col">{{$date->format('M d, Y - l')}}</small>
                                        <small class="form-data-col">-:-- --</small>
                                        <small class="form-data-col">-:-- --</small>
                                        <small class="form-data-col">------</small>
                                    </div>  
                                @else
                                    <div class="timesheet-table-data {{$isHoliday ? 'holiday' : ($isPresent ? 'good' : 'bad')}}">
                                        <small class="form-data-col">{{$date->format('M d, Y - l')}}</small>
                                        @if ($isHoliday)
                                            <small class="form-data-col">-:-- --</small>
                                            <small class="form-data-col">-:-- --</small>
                                            <small class="form-data-col">Holiday</small>
                                        @elseif($isPresent)
                                            @foreach ($timesheetDates as $time)
                                                @if ($time->created_at->format('Y-m-d') == $dateString)
                                                    <small class="form-data-col">{{ \Carbon\Carbon::parse($time->time_in)->format('g:i a') }}</small>
                                                    <small class="form-data-col">{{ $time->time_out ? \Carbon\Carbon::parse($time->time_out)->format('g:i a') : '--:-- --' }}</small>
                                                    <small class="form-data-col">Present</small>
                                                    @break
                                                @endif
                                            @endforeach
                                        @else
                                            <small class="form-data-col">-:-- --</small>
                                            <small class="form-data-col">-:-- --</small>
                                            <small class="form-data-col">Absent</small>
                                        @endif
                                    </div>                             
                                @endif

                                
                                
                            @endforeach
                            
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
        const oldFname = {!! json_encode($employee->firstname) !!};
        const oldMname = {!! json_encode($employee->middlename) !!};
        const oldLname = {!! json_encode($employee->lastname) !!};
        const oldPhone = {!! json_encode($employee->phone) !!};
        const oldGender = {!! json_encode($employee->gender) !!};
        const oldStreetAddress = {!! json_encode($employee->street_address) !!};
    </script>
    <script src="/assets/js/view-employee.js"></script>
</html>
