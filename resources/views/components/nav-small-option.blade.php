@php
    use Carbon\Carbon;
@endphp

<div class="nav-small-options d-none" id="nav-small-option">
    <a href="/AccountantViewProfile/{{session('logged_treasury')}}" class="color-black-2"><i class="bi bi-person-fill"></i> Profile</a>
    <a href="/logoutTreasury" class="bg-app-red color-white"><i class="bi bi-box-arrow-left"></i> Sign out</a>
</div>

<div class="nav-notifications-cont d-none" id="nav-notifications-cont">
    <div class="text-l3">Logs</div>
    <div class="line1"></div>

    <div class="notifications-cont">

        <x-render_accountant_logs :logs="$logs" count="null"/>

    </div>
    {{-- @if ($no)
        
    @else
        
    @endif --}}
</div>