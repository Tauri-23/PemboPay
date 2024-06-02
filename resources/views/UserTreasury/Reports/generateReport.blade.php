<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <title>PemboPay | Generate Payroll</title>
        
        {{-- Styles --}}
        <link rel="stylesheet" href="/assets/css/app.css">
        <link rel="stylesheet" href="/assets/css/elements.css">
        <link rel="stylesheet" href="/assets/css/navbar.css">
        <link rel="stylesheet" href="/assets/css/generate-payslip.css">

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

        {{-- Sidenav --}}
        <x-sidenav activeLink="4"/>

        {{-- nav small option --}}
        <x-NavSmallOption :logs="$logs"/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Reports" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-x gap2 position-relative">

            <div class="d-flex flex-direction-y gap3 align-items-center w-100">
                <div id="report" class="salary-slip-cont d-flex flex-direction-y gap1">
            
                    <div class="d-flex gap3 align-items-center">
                        <div class="logo-m position-relative">
                            <img class="w-100 h-100 position-absolute" src="/assets/media/logos/mwp-pembo.png" />
                        </div>
                        <div class="" style="width: 250px;">
                            <small class="text-m1 bold">Barangay Pembo</small><br />
                            <small class="text-m3">29 Sampaguita Extension 1218 Taguig City, Philippines</small>
                        </div>
                    </div>


                    @php
                        $deptNameTopComp = '';
                        $deptBiggestComp = 0;

                        $deptNameBotComp = '';
                        $deptLowestComp = 10000000;

                        

                        foreach ($uniqueDepartments as $dept) {
                            $deptName = '';
                            $deptSalary = 0.0;
                            foreach ($payrollRecords as $pay) {
                                if($dept == $pay->employee()->first()->department) {
                                    $deptSalary += $pay->net_pay;
                                    $deptName = $pay->employee()->first()->department()->first()->department_name;
                                }
                            }

                            if($deptSalary > $deptBiggestComp) {
                                $deptBiggestComp = $deptSalary;
                                $deptNameTopComp = $deptName;
                            }

                            if($deptSalary < $deptLowestComp) {
                                $deptLowestComp = $deptSalary;
                                $deptNameBotComp = $deptName;
                            }
                        }
                    @endphp

            
                    <div class="text-l3 bold">
                        Report for <span id="period">{{$payrollPeriod}}</span>
                    </div>
            
                    <div class="text-m2 d-flex justify-content-between">
                        <div class="w-50">
                            <small>Total Employees :</small><br />
                            <small>Total Departments :</small><br /><br />
                            
                            
                            <small>Total Allowances :</small><br />
                            <small>Total Deductions :</small><br />
                            <small>Total Salary :</small><br /><br />

                            <small>Department with highest Salary :</small><br />
                            <small>Department Salary :</small><br /><br />

                            <small>Department with lowest Salary :</small><br />
                            <small>Department Salary :</small><br /><br />
                        </div>
                        <div class="w-50 text-right">
                            <small>{{$payrollRecords->count()}}</small><br />
                            <small>{{$uniqueDepartments->count() }}</small><br /><br />

                            <small>{{"₱ " . number_format($totalAllowance, 2, '.', ',')}}</small><br />
                            <small>{{"₱ " . number_format($totalDeduction, 2, '.', ',')}}</small><br />
                            <small>{{"₱ " . number_format($payrollRecordSummary->total_net_pay, 2, '.', ',')}}</small><br /><br />

                            <small>{{$deptNameTopComp}}</small><br />
                            <small>{{"₱ " . number_format($deptBiggestComp, 2, '.', ',')}}</small><br /><br />

                            <small>{{$deptNameBotComp}}</small><br />
                            <small>{{"₱ " . number_format($deptLowestComp, 2, '.', ',')}}</small><br /><br />
                        </div>
                    </div>

                    <hr class="report-hr" />
            
                    {{-- Departments --}}
                    <div class="text-m2 d-flex flex-direction-y gap2">
                        <div class="bold text-l3">
                            Departments
                        </div>
                        @foreach ($departments as $dept)
                            @php
                                $totalCompensation = 0.0;
                        
                                foreach ($payrollRecords as $pay) {
                                    if($pay->employee()->first()->department == $dept->id) {
                                        $totalCompensation += $pay->net_pay;
                                    }
                                }
                            @endphp
                            <div class="text-m2 d-flex flex-direction-y gap4">
                                <small class="bold mar-start-3 text-m2">{{$dept->department_name}} ({{$dept->department_tag}})</small>
                                <div class="d-flex justify-content-between mar-start-2">
                                    <div class="w-50">
                                        <small>Date Established :</small><br />
                                        <small>Total Employees :</small><br />
                                        <small>Department Compensation :</small>
                                    </div>
                                    <div class="w-50 text-right">
                                        <small>{{$dept->created_at->Format('M d, Y h:i a')}}</small><br />
                                        <small>{{\App\Models\Employees::where('department', $dept->id)->count()}}</small><br />
                                        <small>{{"₱ " . number_format($totalCompensation, 2, '.', ',')}}</small>
                                    </div>
                                </div>

                                {{-- Employees in Departments --}}
                                @foreach ($payrollRecords as $pay)


                                    {{-- GET THE OVERTIME OF THE EMPLOYEE --}}
                                    @php
                                        $overtimePrice = 0;

                                        foreach ($overTimeRecords as $ot) {
                                            if ($ot->employee == $pay->employee) {
                                                $overtimePrice += $ot->overtime_price;
                                            }
                                        }

                                    @endphp

                                    @if ($pay->employee()->first()->department == $dept->id)
                                        <div class="d-flex flex-direction-y gap4 mar-start-3 mar-top-2">
                                            <small class="bold mar-start-3">{{$pay->employee()->first()->firstname}} {{$pay->employee()->first()->lastname}} ({{$pay->employee}})</small>

                                            <div class="d-flex justify-content-between mar-start-2">
                                                <div class="w-50">
                                                    <small>Hours Worked :</small><br />
                                                    <small>Overtime :</small><br />
                                                    <small>Days Absent :</small><br />

                                                    <div class="bold text-m3 mar-top-3 mar-bottom-4">Compensation</div>

                                                    <small class="mar-top-1">Basic Pay :</small><br />
                                                    <small class="mar-top-1">Overtime Pay :</small><br />
                                                    <small>Gross Pay :</small><br />
                                                    <small>Net Pay:</small><br />

                                                    <div class="bold text-m3 mar-top-3 mar-bottom-4">Deductions</div>

                                                    @foreach ($taxes as $tax)
                                                        @if ($tax->employee == $pay->employee)
                                                            <small>{{$tax->tax_name}}:</small><br />
                                                        @endif                                                        
                                                    @endforeach

                                                    <div class="bold text-m3 mar-top-3 mar-bottom-4">Allowances</div>

                                                    @foreach ($allowanceRecords as $allowance)
                                                        <small>{{$allowance->allowance_name}}:</small><br />                                                      
                                                    @endforeach
                                                    
                                                </div>
                                                <div class="w-50 text-right">
                                                    <small>{{$pay->hours_worked}} h</small><br />
                                                    <small>{{$pay->over_time}} h</small><br />
                                                    <small>{{$pay->days_absent}} d</small><br />

                                                    <div class="text-m3 mar-top-3 mar-bottom-4">------------------</div>

                                                    <small>{{"₱ " . number_format($pay->basic_pay - $overtimePrice, 2, '.', ',')}}</small><br />
                                                    <small>{{"₱ " . number_format($overtimePrice, 2, '.', ',')}}</small><br />
                                                    <small>{{"₱ " . number_format($pay->gross_pay, 2, '.', ',')}}</small><br />
                                                    <small>{{"₱ " . number_format($pay->net_pay, 2, '.', ',')}}</small><br />

                                                    <div class="text-m3 mar-top-3 mar-bottom-4">------------------</div>

                                                    @foreach ($taxes as $tax)
                                                        @if ($tax->employee == $pay->employee)
                                                            <small>{{"₱ " . number_format($tax->tax_price, 2, '.', ',')}}</small><br />
                                                        @endif                                                        
                                                    @endforeach

                                                    <div class="text-m3 mar-top-3 mar-bottom-4">------------------</div>

                                                    @foreach ($allowanceRecords as $allowance)
                                                        <small>{{"₱ " . number_format($allowance->allowance_price, 2, '.', ',')}}</small><br />                                                      
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                    @endif
                                    
                                @endforeach
                                {{-- <hr class="report-hr mar-start-3" /> --}}
                                <div class="mar-start-3">----------------------------------------------------------------------------------</div>
                            </div>

                            
                        @endforeach
                    </div>
            
                    <hr class="report-hr" />
            
                    <div class="text-m2">
                        Printed on {{\Carbon\Carbon::now()->Format('M d, Y - l')}}
                    </div>
            
                </div>
                <div class="d-flex gap2">
                    <button id="print-btn" class="secondary-btn4-small"><i class="bi bi-printer-fill mar-end-3"></i>Print</button>
                </div>
            </div>
        
        </div>

    </body>

    {{-- Scripts --}}
    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/navbar.js"></script>
    <script src="/assets/js/printThis.js"></script>
    <script>
        // Print the Payslip
        $(document).ready(function () {
            const savePdfBtn = $('#print-btn');
    
            savePdfBtn.on('click', () => {
                let element = $('#report');
                let period = {!! json_encode($payrollPeriod) !!};
    
                // Generate a timestamp or any unique string
                const timestamp = new Date().toISOString().replace(/[-T:Z]/g, '');
    
                // Set the filename with the desired name and the timestamp
                const filename = "Report_" + period + "_salary_slip_" + timestamp + ".pdf";
    
                element.printThis({
                    pageTitle: filename,
                    importCSS: true,
                    importStyle: true,
                    beforePrint: function () {
                        document.title = filename;
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
