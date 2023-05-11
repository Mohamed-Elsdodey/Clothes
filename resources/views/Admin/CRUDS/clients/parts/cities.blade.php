@if(count($cities)>0)

    <option selected disabled>Choose the city now</option>
    @foreach($cities as $city)
        <option value="{{$city->id}}"> {{$city->title}}</option>
    @endforeach


@else


    <option selected disabled>That province has no cities</option>



@endif
