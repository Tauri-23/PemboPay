@if ($elements->count() < 1)
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
        <div class="text-l3 text-center">No {{$elementsName}}</div>
    </div>
</div>
    
@else

    @if ($elementsName == "Taxes")
        <div class="table1">
            <div class="table1-header">
                <small class="text-m2 form-data-col">Tax name</small>
                <small class="text-m2 form-data-col">Period</small>
                <small class="text-m2 form-data-col d-flex justify-content-end">Action</small>
            </div>
        
        
            @foreach ($elements as $elm)
                <div  class="table1-data {{ $loop->last ? 'last' : '' }}">
                    <small class="form-data-col">{{$elm->name}}</small>
                    <small class="form-data-col">{{$elm->period}}</small>
                    <div class="form-data-col d-flex justify-content-end gap3">
                        <a class="primary-btn2-small {{"del-btn-".$elementsName}}" id="{{$elm->id}}">
                            <i class="bi bi-trash"></i>
                        </a>
                        <a href="/viewTaxTable/{{$elm->id}}" class="primary-btn1-small" id="{{$elm->id}}">
                            <i class="bi bi-table"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="table1">
            <div class="table1-header">
                <small class="text-m2 form-data-col">{{$elementsName}} name</small>
                <small class="text-m2 form-data-col">Amount</small>
                <small class="text-m2 form-data-col">Period</small>
                <small class="text-m2 form-data-col d-flex justify-content-end">Action</small>
            </div>
        
        
            {{--Data Fetched from the database this is for ui for now--}}
            @foreach ($elements as $elm)
                <div  class="table1-data {{ $loop->last ? 'last' : '' }}">
                    <small class="form-data-col">{{$elm->name}}</small>
                    <small class="form-data-col">{{$elm->type == "Amount" ? "₱ " . number_format($elm->price, 2, '.', ',') : $elm->price}} {{$elm->type == "Percent" ? "%" : ""}}</small>
                    <small class="form-data-col">{{$elm->period}}</small>
                    <div class="form-data-col d-flex justify-content-end gap3">
                        <a class="primary-btn2-small {{"del-btn-".$elementsName}}" id="{{$elm->id}}">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
    @endif

@endif