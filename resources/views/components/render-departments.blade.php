@if ($departments->count() < 1)
    <div class="placeholder-illustrations">
        <div class="d-flex flex-direction-y gap2">
            <img src="/assets/media/illustrations/empty1.svg" alt="" srcset="">  
            <div class="text-l3 text-center">No Departments</div>
        </div>
    </div>
@else
    @foreach ($departments as $dept)
        <a href="" id="Department_ID" class="departments-cont-box departments">
            <div class="department-name" style="z-index: 2;">{{$dept->department_name}}</div>
            <div class="overlay-blur-dark"></div>
            <img class="department-pic" src="/assets/media/dept-pfp/bg1.jpg" />
        </a>
    @endforeach
@endif