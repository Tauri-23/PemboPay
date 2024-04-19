<div class="side-nav" id="side-nav">
    <div class="side-nav-logo" id="side-nav-logo">
        <img id="side-nav-logo-img" src="/assets/media/logos/Logo.png" />
    </div>
    <div class="menu-text">Menu</div>
    <a href="/TreasuryDashboard" class="side-nav-links {{$activeLink == 1 ? 'active' : ''}}">
        <i class="bi bi-speedometer side-nav-icon"></i>
        <div class="sidenav-text">Dashboard</div>
    </a>
    <a href="/TreasuryRunPayroll" class="side-nav-links {{$activeLink == 2 ? 'active' : ''}}">
        <i class="fa-solid fa-file-invoice-dollar side-nav-icon"></i>
        <div class="sidenav-text">Run Payroll</div>
    </a>
    <a href="/TreasuryPayrollHistory" class="side-nav-links {{$activeLink == 3 ? 'active' : ''}}">
        <i class="bi bi-graph-up-arrow side-nav-icon"></i>
        <div class="sidenav-text">Payroll History</div>
    </a>
    <a href="/TreasuryReports" class="side-nav-links {{$activeLink == 4 ? 'active' : ''}}">
        <i class="bi bi-file-earmark-bar-graph-fill side-nav-icon"></i>
        <div class="sidenav-text">Report</div>
    </a>
    <a href="/TreasuryPayslip" class="side-nav-links {{$activeLink == 5 ? 'active' : ''}}">
        <i class="fa-solid fa-receipt side-nav-icon"></i>
        <div class="sidenav-text">Pay Slip</div>
    </a>
    <a href="/TreasuryEmployees" class="side-nav-links  {{$activeLink == 6 ? 'active' : ''}}">
        <i class="bi bi-people-fill side-nav-icon"></i>
        <div class="sidenav-text">Employees</div>
    </a>
    <a href="/TreasuryDepartments" class="side-nav-links  {{$activeLink == 7 ? 'active' : ''}}">
        <i class="bi bi-buildings-fill side-nav-icon"></i>
        <div class="sidenav-text">Departments</div>
    </a>
    <a href="/AccountantPayrollSettings" class="side-nav-links  {{$activeLink == 8 ? 'active' : ''}}">
        <i class="bi bi-sliders side-nav-icon"></i>
        <div class="sidenav-text">Payroll Settings</div>
    </a>
</div>