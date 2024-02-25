<div class="side-nav">
    <div class="side-nav-logo">
        <img src="/assets/media/logos/Logo.png" />
    </div>
    <a href="/TreasuryDashboard" class="side-nav-links {{$activeLink == 1 ? 'active' : ''}}">
        <i class="bi bi-speedometer side-nav-icon"></i>
        Dashboard
    </a>
    <a href="/TreasuryRunPayroll" class="side-nav-links {{$activeLink == 2 ? 'active' : ''}}">
        <i class="fa-solid fa-file-invoice-dollar side-nav-icon"></i>
        Run Payroll
    </a>
    <a href="/TreasuryPayrollHistory" class="side-nav-links {{$activeLink == 3 ? 'active' : ''}}">
        <i class="bi bi-graph-up-arrow side-nav-icon"></i>
        Payroll History
    </a>
    <a href="/TreasuryReports" class="side-nav-links {{$activeLink == 4 ? 'active' : ''}}">
        <i class="bi bi-file-earmark-bar-graph-fill side-nav-icon"></i>
        Report
    </a>
    <a href="/TreasuryPayslip" class="side-nav-links {{$activeLink == 5 ? 'active' : ''}}">
        <i class="fa-solid fa-receipt side-nav-icon"></i>
        Salary Slip
    </a>
    <a class="side-nav-links  {{$activeLink == 6 ? 'active' : ''}}">
        <i class="bi bi-people-fill side-nav-icon"></i>
        Employees
    </a>
    <a class="side-nav-links  {{$activeLink == 7 ? 'active' : ''}}">
        <i class="bi bi-buildings-fill side-nav-icon"></i>
        Departments
    </a>
    <a class="side-nav-links  {{$activeLink == 8 ? 'active' : ''}}">
        <i class="bi bi-sliders side-nav-icon"></i>
        Payroll Settings
    </a>
</div>