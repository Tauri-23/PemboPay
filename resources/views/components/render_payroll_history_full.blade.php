@if ($payrolls->count() < 1) 
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/no-data.svg" alt="" srcset="">  
            <div class="text-l3 text-center">No Records</div>
        </div>
    </div>

@else
    <div class="table1">
        <div class="table1-header">
            <div class="w-50 flex-grow-1">Employee Id</div>
            <div class="w-50 flex-grow-1">Department</div>
            <div class="w-50 flex-grow-1">Total Hours Worked</div>
            <div class="w-50 flex-grow-1">BasicPay</div>
            <div class="w-50 flex-grow-1">GrossPay</div>
            <div class="w-50 flex-grow-1">NetPay</div>
            <div class="w-50 flex-grow-1">Processed Date</div>
        </div>

        @foreach ($payrolls as $item)
            <div class="table1-data {{ $loop->last ? 'last' : '' }}">
                <div class="w-50 flex-grow-1">{{$item->employee}}</div>
                <div class="w-50 flex-grow-1">{{$item->employee()->first()->department()->first()->department_name}}</div>
                <div class="w-50 flex-grow-1">{{$item->hours_worked}} h</div>
                <div class="w-50 flex-grow-1">{{"₱ " . number_format($item->basic_pay, 2, '.', ',')}}</div>
                <div class="w-50 flex-grow-1">{{"₱ " . number_format($item->gross_pay, 2, '.', ',')}}</div>
                <div class="w-50 flex-grow-1">{{"₱ " . number_format($item->net_pay, 2, '.', ',')}}</div>
                <div class="w-50 flex-grow-1">{{date_format($item->created_at, 'M d, Y h:i a')}}</div>
            </div>
        @endforeach

@endif     
</div>