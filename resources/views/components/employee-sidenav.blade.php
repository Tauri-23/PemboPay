<div class="side-nav" id="side-nav">
    <div class="side-nav-logo" id="side-nav-logo">
        <img id="side-nav-logo-img" src="/assets/media/logos/Logo.png" />
    </div>
    <div class="menu-text">Menu</div>
    <a href="/EmployeeDash" class="side-nav-links {{$activeLink == 1 ? 'active' : ''}}">
        <i class="bi bi-speedometer side-nav-icon"></i>
        <div class="sidenav-text">Timein / out</div>
    </a>
    <a href="/EmployeeTimesheet/null" class="side-nav-links {{$activeLink == 2 ? 'active' : ''}}">
        <i class="{{$activeLink == 2 ? 'bi bi-calendar-week-fill' : 'bi bi-calendar-week'}} side-nav-icon"></i>
        <div class="sidenav-text">Timesheet</div>
    </a>
    <a href="/EmployeePayslip" class="side-nav-links {{$activeLink == 3 ? 'active' : ''}}">
        <i class="fa-solid fa-receipt side-nav-icon"></i>
        <div class="sidenav-text">Pay Slip</div>
    </a>
</div>