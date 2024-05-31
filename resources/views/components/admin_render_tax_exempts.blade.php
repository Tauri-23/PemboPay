@if ($elements->count() < 1)
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
            <div class="text-l3 text-center">No tax-exempts</div>
        </div>
    </div>
    
@else

<div class="table1">
    <div class="table1-header">
        <small class="text-m2 form-data-col">Tax name</small>
        <small class="text-m2 form-data-col">Period</small>
        <small class="text-m2 form-data-col d-flex justify-content-end">Action</small>
    </div>


    @foreach ($elements as $elm)
        <div  class="table1-data {{ $loop->last ? 'last' : '' }}">
            <small class="form-data-col">{{$elm->name}}</small>
            <small class="form-data-col">{{$elm->period_of_deduction}}</small>
            <div class="form-data-col d-flex justify-content-end gap3">
                <a class="primary-btn2-small del-btn" data-id="{{$elm->id}}">
                    <i class="bi bi-trash"></i>
                </a>
                <a href="/AdminViewTaxExemptTable/{{$elm->id}}" class="primary-btn1-small" id="{{$elm->id}}">
                    <i class="bi bi-table"></i>
                </a>
            </div>
        </div>
    @endforeach
</div>

@endif