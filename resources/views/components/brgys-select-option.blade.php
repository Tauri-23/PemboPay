@foreach($brgy as $brgy)
    <option value="{{$brgy->id}}">{{$brgy->barangay}}</option>
@endforeach