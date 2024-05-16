@php
    use Carbon\Carbon;
@endphp

@if ($accountants->count() < 1) 
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
            <div class="text-l3 text-center">No Accountants</div>
        </div>
    </div>
@else
    <div class="table1">
        <div class="table1-header">
            <div class="form-data-col">
                <small class="text-m2">Name</small>
                <div class="table1-PFP-small-cont mar-end-1"></div>
            </div>
            <small class="text-m2 form-data-col">ID</small>
            <small class="text-m2 form-data-col">Email</small>
            <small class="text-m2 form-data-col">Joined</small>
            <small class="text-m2 form-data-col">Actions</small>
        </div>

        @php
            $accountantsCont = 0;
        @endphp
        {{--Data Fetched from the database this is for ui for now--}}
        @foreach ($accountants as $acc)
            @if ($count != null && $accountantsCont > $count)
                @break;
            @endif

            <div  class="table1-data {{ $loop->last ? 'last' : '' }} accountant-column" id="{{$acc->id}}">
                <div class="form-data-col">
                    <div class="table1-PFP-small mar-end-1">
                        <img class="emp-pfp" src="/assets/media/pfp/{{ $acc->pfp }}" alt="">
                    </div>
                    <small class="text-m2 emp-name">{{ $acc->Firstname }} {{ $acc->Lastname }}</small>
                </div>
                <small class="form-data-col emp-id">{{ $acc->id }}</small>
                <small class="form-data-col">{{ $acc->email }}</small>
                <small class="form-data-col emp-dept">{{ Carbon::parse($acc->created_at)->format('M d, Y') }}</small>
                <div class="form-data-col d-flex gap3">
                    <div class="primary-btn2-small delete-acc-btn" id="{{$acc->id}}"><i class="bi bi-trash3"></i></div>
                    <a href="/AdminViewAccountantProfile/{{$acc->id}}" class="primary-btn1-small"><i class="bi bi-eye"></i></a>
                </div>
            </div>
            @php
                $accountantsCont++;
            @endphp
        @endforeach
    </div>
@endif
