@foreach($departments as $dept)
    <option value="{{$dept->id}}">{{$dept->department_name}}</option>
@endforeach