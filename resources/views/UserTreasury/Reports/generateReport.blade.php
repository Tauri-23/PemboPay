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
        <x-NavSmallOption/>
        

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
            
                    <div class="text-l3 bold">
                        Report for <span id="period">{{$payrollPeriod}}</span>
                    </div>
            
                    <div class="text-m2 d-flex justify-content-between">
                        <div class="w-50">
                            <small>Total Employees :</small><br />
                            <small>Total Departments :</small><br />
                            <small>New Employees :</small><br />
                            <small>New Departments :</small><br />
                        </div>
                        <div class="w-50 text-right">
                            <small>Total Emp of the period</small><br />
                            <small>Total Depts of the period</small><br />
                            <small>New Employees of the period</small><br />
                            <small>New Depts of the period</small><br />
                        </div>
                    </div>
                    <hr class="report-hr" />
            
                    {{-- Departments --}}
                    <div class="text-m2 d-flex flex-direction-y gap2">
                        <div class="bold">
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
                                <small class="bold mar-start-3">{{$dept->department_name}}</small>
                                <div class="d-flex justify-content-between mar-start-2">
                                    <div class="w-50">
                                        <small>Date Established :</small><br />
                                        <small>Total Employees :</small><br />
                                        <small>Total Compensation :</small>
                                    </div>
                                    <div class="w-50 text-right">
                                        <small>{{$dept->created_at->Format('M d, Y h:i a')}}</small><br />
                                        <small>{{\App\Models\Employees::where('department', $dept->id)->count()}}</small><br />
                                        <small>{{"₱ " . number_format($totalCompensation, 2, '.', ',')}}</small>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
            
                    <hr class="report-hr" />
            
                    <div class="text-m2 d-flex flex-direction-y gap3">
                        <div class="bold">
                            Employees
                        </div>
            
                        <div class="text-m2">
                            <div class="d-flex justify-content-between mar-start-3">
                                <div class="w-50">
                                    <small>Total Allowances :</small><br />
                                    <small>Total Deductions :</small><br />
                                    <small>Total Compensation :</small>
                                </div>
                                <div class="w-50 text-right">
                                    <small>{{"₱ " . number_format($totalAllowance, 2, '.', ',')}}</small><br />
                                    <small>{{"₱ " . number_format($totalDeduction, 2, '.', ',')}}</small><br />
                                    <small>{{"₱ " . number_format($totalCompensation, 2, '.', ',')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <hr class="report-hr" />
            
                    <div class="text-m2 d-flex flex-direction-y gap3">
                        <div class="bold">
                            Allowances
                        </div>
            
                        <div class="text-m2 ">
                            {{-- @foreach(Model.AllowanceRecords)
                            {
                                <div class="flex justify-content-between mar-start-3">
                                    <div class="w-50">
                                        <small>@i.Allowance_Name :</small><br />
                                    </div>
                                    <div class="w-50 text-right">
                                        <small>@string.Format("₱ {0:N2}", i.Allowance_Price)</small><br />
                                    </div>
                                </div>
                            } --}}
                        </div>
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
