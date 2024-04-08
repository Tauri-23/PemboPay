@if ($employees->count() < 1) 
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
            <div class="text-l3 text-center">No Employees</div>
        </div>
    </div>
@else
    <div class="table1">
        <div class="table1-header">
            <div class="form-data-col">
                <small class="text-m2">Employee Name</small>
                <div class="table1-PFP-small-cont mar-end-1"></div>
            </div>
            <small class="text-m2 form-data-col">Employee ID</small>
            <small class="text-m2 form-data-col">Employee Email</small>
            <small class="text-m2 form-data-col">Department</small>
            <small class="text-m2 form-data-col">Status</small>
        </div>


        {{--Data Fetched from the database this is for ui for now--}}
        @foreach ($employees as $emp)
            <a href="" class="table1-data {{ $loop->last ? 'last' : '' }}">
                <div class="form-data-col">
                    <div class="table1-PFP-small mar-end-1">
                        <img src="/assets/media/pfp/{{ $emp->pfp }}" alt="">
                    </div>
                    <small class="text-m2">{{ $emp->firstname }} {{ $emp->lastname }}</small>
                </div>
                <small class="form-data-col">{{ $emp->id }}</small>
                <small class="form-data-col">{{ $emp->email }}</small>
                <small class="form-data-col">{{ $emp->department()->first()->department_name }}</small>
                {{-- <small class="form-data-col">{{  dd($emp->toArray())  }} Debug output</small> --}}
                <small class="form-data-col">{{ $emp->status }}</small>
            </a>
        @endforeach
    </div>
@endif
