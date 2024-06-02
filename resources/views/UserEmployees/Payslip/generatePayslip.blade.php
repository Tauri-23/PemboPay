<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PemboPay</title>
        
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
        <x-employee-sidenav activeLink="3"/>

        {{-- nav small option --}}
        <x-employee_nav_small_option/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Payslip" pfp="{{$loggedEmployee->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">
            
            <div id="salary-slip-cont" class="d-flex flex-direction-y gap3 align-items-center">
                @php
                    foreach ($payrollRecordsEmp as $payrecord) {
                        if ($payrecord->employee == $employee->id) {
                            $hoursWorked = $payrecord->hours_worked;
                            $basicPay = $payrecord->basic_pay;
                            $grossPay = $payrecord->gross_pay;
                            $netPay = $payrecord->net_pay;
                            $overTimeRecord = $payrecord->over_time;
                        }
                    }

                    foreach ($overtime as $ot) {
                        if ($ot->employee == $employee->id) {
                            $basicPay -= $ot->overtime_price;
                            $overtime_price = $ot->overtime_price;
                        }
                    }
                @endphp
                <div id="payslip" class="salary-slip-cont d-flex flex-direction-y gap1">
                
                    <div class="d-flex gap3 align-items-center">
                        <div class="logo-m position-relative">
                            <img class="w-100 h-100 position-absolute" src="/assets/media/logos/mwp-pembo.png" />
                        </div>

                        <div class="" style="width: 250px;">
                            <small class="text-m1 bold">Barangay Pembo</small><br />
                            <small class="text-m3">29 Sampaguita Extension 1218 Makati, Philippines</small>
                        </div>
                    </div>
                
                
                    <div class="text-m2 bold">
                        Pay Slip For <span id="period">{{$payrollPeriod}}</span>
                    </div>
                
                
                    <div class="text-m2">
                        <small>Name: <span id="emp-fullname">{{$employee->firstname}} {{$employee->middlename}} {{$employee->lastname}}</span></small><br />
                        <small>Employee ID: <span id="emp-id">{{$employee->id}}</span></small><br />
                        <small>Department: <span id="emp-dept">{{$employee->Department()->first()->department_name}}</span></small>
                    </div>

                    <div class="text-m2">
                        <small>Hours Worked: <span id="emp-hours-worked">{{$hoursWorked}} h</span></small><br />

                        @if ($overTimeRecord > 0)
                            <small>Overtime: <span id="emp-hours-worked">{{$overTimeRecord}} h</span></small><br />
                        @endif
                        
                    </div>
            
            
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <div class="text-m2 bold mar-bottom-4">Earnings</div>
                            <div class="text-m2 d-flex justify-content-between salary-slip-inside-cont">
                                <div>
                                    {{-- Basic Pay names --}}
                                    <small>Basic Pay: </small><br />

                                    {{-- Overtime if it has --}}
                                    @if ($overtime_price > 0)
                                        <small>Overtime: </small><br />  
                                    @endif
                                    

                                    {{-- General Allowance names --}}
                                    @foreach ($allowanceRecord as $allowance)
                                        <small>{{$allowance->allowance_name}}</small><br />
                                    @endforeach
                                    {{-- Self Allowance names --}}
                                    @foreach ($allowanceRecordSelf as $allowance)
                                        <small>{{$allowance->allowance_name}}</small><br />
                                    @endforeach
                                </div>

                                {{-- Values --}}
                                <div class="text-right">
                                    {{-- Basic Pay Value --}}
                                    <small>{{"₱ " . number_format($basicPay, 2, '.', ',')}}</small><br />

                                    {{-- Overtime if it has --}}
                                    @if ($overtime_price > 0)
                                        <small>{{"₱ " . number_format($overtime_price, 2, '.', ',')}}</small><br />  
                                    @endif

                                    {{-- General Allowance Value --}}
                                    @foreach ($allowanceRecord as $allowance)
                                        <small>{{"₱ " . number_format($allowance->allowance_type == "Amount" ? $allowance->allowance_price : $allowance->allowance_price * $basicPay, 2, '.', ',')}}</small><br />
                                    @endforeach

                                    {{-- Self Allowance Value --}}
                                    @foreach ($allowanceRecordSelf as $allowance)
                                        <small>{{$allowance->allowance_price}}</small><br />
                                    @endforeach
                                </div>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <small>Gross Pay</small>
                                @foreach ($payrollRecordsEmp as $payrecord)
                                    @if ($payrecord->employee == $employee->id)
                                        <small>{{"₱ " . number_format($payrecord->gross_pay, 2, '.', ',')}}</small>
                                    @endif
                                @endforeach
                                
                            </div>
                        </div>
                
                        <div>
                            <div class="text-m2 bold mar-bottom-4">Deductions</div>
                            <div class="text-m2 d-flex justify-content-between salary-slip-inside-cont">
                                <div>
                                    {{-- Taxes names --}}
                                    @foreach ($taxRecord as $tax)
                                        @if ($tax->employee == $employee->id)
                                            <small>{{$tax->tax_name}}</small><br />
                                        @endif                                            
                                    @endforeach

                                    {{-- Deductions names --}}
                                    @foreach ($deductions as $deduction)
                                        <small>{{$deduction->deduction_name}}</small><br />                                         
                                    @endforeach
                                </div>
                                <div class="text-right">
                                    {{-- Taxes Value --}}
                                    @foreach ($taxRecord as $tax)
                                        @if ($tax->employee == $employee->id)
                                            <small>{{"₱ " . number_format($tax->tax_price, 2, '.', ',')}}</small><br />
                                        @endif  
                                    @endforeach

                                    {{-- Deductions value --}}
                                    @foreach ($deductions as $deduction)
                                        <small>{{"₱ " . number_format($deduction->deduction_price, 2, '.', ',')}}</small><br />                                       
                                    @endforeach
                                </div>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <small>Total Deduction</small>
                                @foreach ($payrollRecordsEmp as $payrecord)
                                    @if ($payrecord->employee == $employee->id)
                                        <small>{{"₱ " . number_format($payrecord->deductions, 2, '.', ',')}}</small>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                
                
                    <div class="w-100">
                        <div class="text-m2 flex justify-content-between salary-slip-inside-cont">
                            <small>Net Pay: </small>
                            @foreach ($payrollRecordsEmp as $payrecord)
                                    @if ($payrecord->employee == $employee->id)
                                        <small>{{"₱ " . number_format($payrecord->net_pay, 2, '.', ',')}}</small>
                                    @endif
                                @endforeach
                        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Print the Payslip
        $(document).ready(function () {
            const printBtn = $('#print-btn');

            printBtn.on('click', () => {
                const elements = $('#payslip');

                let empId = {!! json_encode($ids) !!};
                let payPeriod = {!! json_encode($payrollPeriod) !!};

                // Generate a timestamp or any unique string
                const timestamp = new Date().toISOString().replace(/[-T:Z]/g, '');

                // Set the filename with the desired name and the timestamp
                const filename = `${empId}_${payPeriod}_pay_slip_${timestamp}.pdf`;

                // Print the container
                elements.printThis({
                    pageTitle: filename,
                    importCSS: true,
                    importStyle: true,
                    loadCSS: ['/assets/css/app.css', '/assets/css/elements.css', '/assets/css/navbar.css', '/assets/css/generate-payslip.css'],
                    beforePrint: function () {
                        document.title = filename;
                    }
                });
            });
        });
    </script>
</html>
