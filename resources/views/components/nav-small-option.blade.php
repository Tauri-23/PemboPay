@php
    use Carbon\Carbon;
@endphp

<div class="nav-small-options d-none" id="nav-small-option">
    <a href="/AccountantViewProfile/{{session('logged_treasury')}}" class="color-black-2"><i class="bi bi-person-fill"></i> Profile</a>
    <a href="/logoutTreasury" class="bg-app-red color-white"><i class="bi bi-box-arrow-left"></i> Sign out</a>
</div>

<div class="nav-notifications-cont d-none" id="nav-notifications-cont">
    <div class="text-l3">Activities</div>
    <div class="line1"></div>

    <div class="notifications-cont">

        @foreach ($logs as $log)
            @php
                $created_at = Carbon::parse($log->created_at);
                $now = Carbon::now();
                $diff = $now->diffInMinutes($created_at);
            @endphp
            <div class="notification-box">
                <div class="notification-pfp">
                    <img class="position-absolute h-100" src="/assets/media/pfp/{{$log->accountant()->first()->pfp}}" alt="pfp">
                </div>
                <div class="notification-texts">
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        @if ($log->accountant == session('logged_treasury'))
                            <div class="text-l3 fw-bold">Just You</div> 
                        @else
                            <div class="text-l3 fw-bold">{{$log->accountant()->first()->Firstname}}</div>  
                        @endif
                    </div>

                    <div class="notification-title">{{$log->title}}</div>

                    @if ($diff < 1)
                            <div class="text-m3 fw-bold"><i class="bi bi-clock-history"></i> Now</div>
                        @elseif($diff < 60)
                            <div class="text-m3 fw-bold"><i class="bi bi-clock-history"></i> {{$diff < 2 ? 'a minute ago' : $diff.' minutes ago'}}</div>
                        @elseif($diff >= 60 && $diff < 60 * 24)
                            <div class="text-m3 fw-bold"><i class="bi bi-clock-history"></i> {{$diff < 180 ? "an hour ago" : floor($diff / 60).' hours ago'}}</div>
                        @elseif($diff >= 60 * 24 && $diff <= 60 * 96)
                            <div class="text-m3 fw-bold"><i class="bi bi-clock-history"></i> {{$diff < 60 * 48 ? "a day ago" : floor($diff / (60*24)).' days ago'}}</div>
                        @else
                            <div class="text-m3 fw-bold"><i class="bi bi-clock-history"></i> {{$created_at->format('M d, Y g:i a')}}</div>
                        @endif
                </div>
            </div>
        @endforeach

    </div>
    {{-- @if ($no)
        
    @else
        
    @endif --}}
</div>