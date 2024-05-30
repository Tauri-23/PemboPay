<div class="side-nav" id="side-nav">
    <div class="side-nav-logo" id="side-nav-logo">
        <img id="side-nav-logo-img" src="/assets/media/logos/Logo.png" />
    </div>
    <div class="menu-text">Menu</div>
    <a href="/AdminDashboard" class="side-nav-links {{$activeLink == 1 ? 'active' : ''}}">
        <i class='bx bxs-dashboard side-nav-icon'></i>
        <div class="sidenav-text">Dashboard</div>
    </a>
    <a href="/AdminAccountants" class="side-nav-links {{$activeLink == 2 ? 'active' : ''}}">
        <i class="{{$activeLink == 2 ? 'bi bi-people-fill' : 'bi bi-people'}} side-nav-icon"></i>
        <div class="sidenav-text">Accountants</div>
    </a>
    <a href="/AdminEmployees" class="side-nav-links {{$activeLink == 3 ? 'active' : ''}}">
        <i class="{{$activeLink == 3 ? 'bi bi-people-fill' : 'bi bi-people'}} side-nav-icon"></i>
        <div class="sidenav-text">Employees</div>
    </a>
    <a href="/AdminDepartments" class="side-nav-links  {{$activeLink == 4 ? 'active' : ''}}">
        <i class="{{$activeLink == 4 ? 'bi bi-buildings-fill' : 'bi bi-buildings'}} side-nav-icon"></i>
        <div class="sidenav-text">Departments</div>
    </a>
    <a href="/AdminAccountantLogs" class="side-nav-links {{$activeLink == 5 ? 'active' : ''}}">
        <i class="{{$activeLink == 5 ? 'bi bi-info-square-fill' : 'bi bi-info-square'}} side-nav-icon"></i>
        <div class="sidenav-text">Accountants Logs</div>
    </a>
    <a href="/AdminSettings" class="side-nav-links {{$activeLink == 6 ? 'active' : ''}}">
        <i class="{{$activeLink == 6 ? 'bi bi-gear-fill' : 'bi bi-gear'}} side-nav-icon"></i>
        <div class="sidenav-text">Settings</div>
    </a>
</div>