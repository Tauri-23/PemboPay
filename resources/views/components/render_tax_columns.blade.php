@if ($elements->count() < 1)
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
        <div class="text-l3 text-center">No tax columns</div>
    </div>
</div>
    
@else
    <div class="table1">
        <div class="table1-header">
            <small class="text-m2 form-data-col">Value</small>
            <small class="text-m2 form-data-col">Threshold Range</small>
            <small class="text-m2 form-data-col d-flex justify-content-end">Action</small>
        </div>
    
    
        {{--Data Fetched from the database this is for ui for now--}}
        @foreach ($elements as $elm)
            <div  class="table1-data {{ $loop->last ? 'last' : '' }}">
                <small class="form-data-col">{{"₱ " . number_format($elm->price_amount, 2, '.', ',')}} + {{$elm->price_percent}}%</small>
                <small class="form-data-col">{{"₱ " . number_format($elm->threshold_min, 2, '.', ',')}} - {{"₱ " . number_format($elm->threshold_max, 2, '.', ',')}}</small>
                <div class="form-data-col d-flex justify-content-end gap3">
                    <a class="primary-btn2-small del-btn" id="{{$elm->id}}">
                        <i class="bi bi-trash"></i>
                    </a>
                    <a class="primary-btn3-small edit-btn" id="{{$elm->id}}">
                        <i class="bi bi-pen"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endif