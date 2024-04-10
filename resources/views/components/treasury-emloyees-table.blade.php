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
            <small class="text-m2 form-data-col">Compensation Type</small>
        </div>


        {{--Data Fetched from the database this is for ui for now--}}
        @foreach ($employees as $emp)
            <div  class="table1-data {{ $loop->last ? 'last' : '' }} employee-column">
                <div class="form-data-col">
                    <div class="table1-PFP-small mar-end-1">
                        <img class="emp-pfp" src="/assets/media/pfp/{{ $emp->pfp }}" alt="">
                    </div>
                    <small class="text-m2 emp-name">{{ $emp->firstname }} {{ $emp->lastname }}</small>
                </div>
                <small class="form-data-col emp-id">{{ $emp->id }}</small>
                <small class="form-data-col">{{ $emp->email }}</small>
                <small class="form-data-col emp-dept">{{ $emp->department()->first()->department_name }}</small>
                {{-- <small class="form-data-col">{{  dd($emp->toArray())  }} Debug output</small> --}}
                <small class="form-data-col">{{ $emp->compensation()->first()->compentsation_type }}</small>
            </div>
        @endforeach
    </div>
@endif
