<div class="side-nav" id="side-nav">
    <div class="side-nav-logo" id="side-nav-logo">
        <img id="side-nav-logo-img" src="/assets/media/logos/Logo.png" />
    </div>
    <div class="menu-text">Menu</div>
    <a href="/EmployeeDash" class="side-nav-links {{$activeLink == 1 ? 'active' : ''}}">
        <i class="bi bi-speedometer side-nav-icon"></i>
        <div class="sidenav-text">Dashboard</div>
    </a>
    <a href="/EmployeeTimesheet" class="side-nav-links {{$activeLink == 2 ? 'active' : ''}}">
        <i class="bi bi-calendar4-week side-nav-icon"></i>
        <div class="sidenav-text">Timesheet</div>
    </a>
</div>