<!DOCTYPE html>
@php
    use Carbon\Carbon;
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay Employee</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/treasury-dash.css">
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
        {{-- MOdal --}}
        <x-modals modalType="info-yn"/>

        <x-modals modalType="success"/>
        <x-modals modalType="error"/>
        

        {{-- Sidenav --}}
        <x-employee-sidenav activeLink="2"/>

        {{-- nav small option --}}
        <x-employee_nav_small_option/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Timesheet" pfp="{{$loggedEmployee->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2">
            <div class="mar-bottom-1" id="timesheet-cont">
                <div class="d-flex flex-direction-d gap3">
                    
                    
                    <div class="mar-bottom-1 w-100" id="timesheet-cont">
                        <div class="d-flex flex-direction-d gap3">
                            <div class="timesheet-cont">
                                <div class="timesheet-head">
                                    <small class="text-m2 bold">Time Sheet</small>
                                    <div class="d-flex gap2">

                                        @php
                                            $monthToday = $endDate->format('m');
                                        @endphp
        
                                        <select class="select-long2" id="timesheet-months">
                                            <option value="1" {{$monthToday == "1" ? "selected" : ""}}>January</option>
                                            <option value="2" {{$monthToday == "2" ? "selected" : ""}}>February</option>
                                            <option value="3" {{$monthToday == "3" ? "selected" : ""}}>March</option>
                                            <option value="4" {{$monthToday == "4" ? "selected" : ""}}>April</option>
                                            <option value="5" {{$monthToday == "5" ? "selected" : ""}}>May</option>
                                            <option value="6" {{$monthToday == "6" ? "selected" : ""}}>June</option>
                                            <option value="7" {{$monthToday == "7" ? "selected" : ""}}>July</option>
                                            <option value="8" {{$monthToday == "8" ? "selected" : ""}}>August</option>
                                            <option value="9" {{$monthToday == "9" ? "selected" : ""}}>September</option>
                                            <option value="10" {{$monthToday == "10" ? "selected" : ""}}>October</option>
                                            <option value="11" {{$monthToday == "11" ? "selected" : ""}}>November</option>
                                            <option value="12" {{$monthToday == "12" ? "selected" : ""}}>December</option>
                                        </select>
        
                                        <select class="select-long2" id="timesheet-year">
                                            <option value="2024" {{Carbon::now()->format('y') == "2024" ? "selected" : ""}}>2024</option>
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
                                        <small class="form-data-col fw-bold"></small>
                                    </div>
        
                                    
                                    
                                    @php
                                        $week = 0;
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
                                                <small class="form-data-col"></small>
                                            </div>  
                                        @else
                                            <div class="timesheet-table-data {{$isHoliday ? 'holiday' : ($isPresent ? 'good' : 'bad')}}">
                                                <small class="form-data-col">{{$date->format('M d, Y - l')}}</small>
                                                @if ($isHoliday)
                                                    <small class="form-data-col">-:-- --</small>
                                                    <small class="form-data-col">-:-- --</small>
                                                    <small class="form-data-col">Holiday</small>
                                                    <small class="form-data-col"></small>
                                                @elseif($isPresent)
                                                    @foreach ($timesheetDates as $time)
                                                        @if ($time->created_at->format('Y-m-d') == $dateString)

                                                            @php
                                                                $timeIn = Carbon::parse($time->time_in);
                                                                $timeOut = Carbon::parse($time->time_out);

                                                                $hours = ($timeOut->diffInMinutes($timeIn) / 60) - 1;
                                                            @endphp
                                                            
                                                            <small class="form-data-col">{{ \Carbon\Carbon::parse($time->time_in)->format('g:i a') }}</small>
                                                            <small class="form-data-col">{{ $time->time_out ? \Carbon\Carbon::parse($time->time_out)->format('g:i a') : '--:-- --' }}</small>
                                                            <small class="form-data-col">Present</small>
                                                            @php
                                                                $timeOutTime = Carbon::parse($time->time_out)->format('H:i:s');
                                                                $timeInTime = Carbon::parse($time->time_in)->format('H:i:s');
                                                                $fivePmTime = '17:00:00';
                                                                $eightAmTime = '08:00:00';
                                                            @endphp
                                                            <small class="form-data-col">{{$hours > 8 ? 'Overtime' : ($timeOutTime < $fivePmTime ? 'Undertime' : ($timeInTime > $eightAmTime ? 'Late' : ''))}}</small>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <small class="form-data-col">-:-- --</small>
                                                    <small class="form-data-col">-:-- --</small>
                                                    <small class="form-data-col">Absent</small>
                                                    <small class="form-data-col"></small>
                                                @endif
                                            </div>                             
                                        @endif
        
                                        
                                        
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/employee-timesheet.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
