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
            <div class="w-50 flex-grow-1">Payroll Period</div>
            <div class="w-50 flex-grow-1">Total HoursWorked</div>
            <div class="w-50 flex-grow-1">Total BasicPay</div>
            <div class="w-50 flex-grow-1">Total GrossPay</div>
            <div class="w-50 flex-grow-1">Total NetPay</div>
            <div class="w-50 flex-grow-1">Processed Date</div>
        </div>

        @foreach ($payrolls as $item)
            <a href="" class="table1-data">
                <div class="w-50 flex-grow-1">{{$item->payroll_period}}</div>
                <div class="w-50 flex-grow-1">{{$item->total_hours_worked}}</div>
                <div class="w-50 flex-grow-1">{{"₱ " . number_format($item->total_basic_pay, 2, '.', ',')}}</div>
                <div class="w-50 flex-grow-1">{{"₱ " . number_format($item->total_gross_pay, 2, '.', ',')}}</div>
                <div class="w-50 flex-grow-1">{{"₱ " . number_format($item->total_net_pay, 2, '.', ',')}}</div>
                <div class="w-50 flex-grow-1">{{date_format($item->created_at, 'M d, Y h:i a')}}</div>
            </a>
        @endforeach

@endif     
</div>