@foreach($cities as $city)
    <option value="{{$city->id}}">{{$city->city}}</option>
@endforeach