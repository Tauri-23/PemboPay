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
        <x-sidenav activeLink="5"/>

        {{-- nav small option --}}
        <x-NavSmallOption/>
        

        {{-- Navbar --}}
        <x-navbar titleString="Generate Payslip" pfp="{{$loggedTreasury->pfp}}"/>
        

        {{-- Content --}}
        <div class="content-cont-1 d-flex flex-direction-y gap2 position-relative">

            <div class="long-cont">
                <small class="text-m2 bold">
                    <a asp-page="index" class="text-black text-decoration-none"><i class="fa-solid fa-chevron-left mar-end-3"></i></a>
                    Pay Slip / @fullname
                </small>
            </div>
            
            
            <div id="salary-slip-cont" class="d-flex flex-direction-y gap3 align-items-center">
                @foreach ($employees as $emp)
                    <div class="salary-slip-cont d-flex flex-direction-y gap1 payslip">
                
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
                            <small>Name: <span id="emp-fullname">{{$emp->firstname}} {{$emp->middlename}} {{$emp->lastname}}</span></small><br />
                            <small>Employee ID: <span id="emp-id">{{$emp->id}}</span></small><br />
                            <small>Department: <span id="emp-dept">{{$emp->Department()->first()->department_name}}</span></small>
                        </div>
                
                
                        <div class="d-flex w-100 justify-content-between">
                            <div>
                                <div class="text-m2 bold mar-bottom-4">Earnings</div>
                                <div class="text-m2 d-flex justify-content-between salary-slip-inside-cont">
                                    <div>
                                        {{-- Basic Pay names --}}
                                        <small>Basic Pay: </small><br />
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
                                        @foreach ($payrollRecordsEmp as $payrecord)
                                            @if ($payrecord->employee == $emp->id)
                                                <small>{{"₱ " . number_format($payrecord->basic_pay, 2, '.', ',')}}</small><br />
                                            @endif
                                        @endforeach

                                        {{-- General Allowance Value --}}
                                        @foreach ($allowanceRecord as $allowance)
                                            <small>{{$allowance->allowance_price}}</small><br />
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
                                        @if ($payrecord->employee == $emp->id)
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
                                            <small>{{$tax->tax_name}}</small><br />
                                        @endforeach
                                    </div>
                                    <div class="text-right">
                                        {{-- Taxes Value --}}
                                        @foreach ($taxRecord as $tax)
                                            <small>{{"₱ " . number_format($tax->tax_price, 2, '.', ',')}}</small><br />
                                        @endforeach
                                    </div>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between">
                                    <small>Total Deduction</small>
                                    @foreach ($payrollRecordsEmp as $payrecord)
                                        @if ($payrecord->employee == $emp->id)
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
                                        @if ($payrecord->employee == $emp->id)
                                            <small>{{"₱ " . number_format($payrecord->net_pay, 2, '.', ',')}}</small>
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
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
            const savePdfBtn = $('#print-btn');

            savePdfBtn.on('click', () => {
                let element = $('.payslip');
                let empId = "";

                // Generate a timestamp or any unique string
                const timestamp = new Date().toISOString().replace(/[-T:Z]/g, '');

                // Set the filename with the desired name and the timestamp
                const filename = empId + "_pay_slip_" + timestamp + ".pdf";

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
</html>
