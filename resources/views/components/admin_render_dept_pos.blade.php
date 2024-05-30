@if ($positions->count() < 1)
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
        <div class="text-l3 text-center">No positions</div>
    </div>
@else
    <div class="table1">
        <div class="table1-header">
            <small class="text-m2 form-data-col">Position</small>
            <small class="text-m2 form-data-col">Salary Grade</small>
            <small class="text-m2 form-data-col d-flex justify-content-end">Action</small>
        </div>


        {{--Data Fetched from the database this is for ui for now--}}
        @foreach ($positions as $pos)
            <div class="table1-data {{ $loop->last ? 'last' : '' }} position-row">
                <small class="form-data-col">{{$pos->position}}</small>
                <small class="form-data-col">{{$pos->salary_grades()->first()->grade}}</small>
                <div class="form-data-col d-flex justify-content-end gap3">
                    <a class="primary-btn2-small del-btn" data-id="{{$pos->id}}">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="primary-btn3-small edit-btn" data-id="{{$pos->id}}">
                        <i class="bi bi-pen"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endif