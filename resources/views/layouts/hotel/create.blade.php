@extends('m_Layout.master')
@section('body')
	<h3>Hotel</h3>
	<p>Create a hotel</p>
	<br>
  @if(empty($hotel) > 0)
	<form action="{{route('hotel.store')}}" method="POST" enctype="multipart/form-data"
  name="formy">
		@csrf 
		@method('post')
  @else
   <form action="{{route('hotel.update',$hotel->id)}}" enctype="multipart/form-data"
  name="formy" method="POST">
    @csrf 
    @method('put')
  @endif

  	<div class="input-group mb-3">
    	<div class="input-group-prepend">
      		<span class="input-group-text">Title</span>
    	</div>
    	<input type="text" class="form-control" 
      placeholder="Type the hotel title" 
      name="name"
      @if(!empty($hotel) > 0)
        value="{{$hotel->name}}"
      @endif
      required>
      <div class="input-group-append">
          <span class="input-group-text">HOTEL</span>
      </div>
  	</div>
 	<div class="input-group mb-3">
 	<span class="input-group-text">Description</span><textarea class="form-control" rows="5" name="description">@if(!empty($hotel)> 0){{
      $hotel->description
    }}
      @endif</textarea>
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Price in Rs.</span>
      </div>
      <input type="number" class="form-control" 
      placeholder="Type price" 
      name="price"
      @if(!empty($hotel) > 0)
        value="{{$hotel->price}}"
      @endif
      required>
      <div class="input-group-append">
          <span class="input-group-text">Individual</span>
      </div>
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Feature Image</span>
      </div>
      @if(!empty($hotel)> 0)
         <img src="{{url($hotel->img)}}" width="130px" height="150px" style="background-color: white">
         <input  class="form-control"
      type="file" name="image" value="$hotel->img" 
      required>
      @else
      <input  class="form-control"
      type="file" name="image" required="true" 
      >
      @endif
      
      <div class="input-group-append">
          <span class="input-group-text">Single</span>
      </div>
  </div>
  <input type="hidden" name="author_id" value="{{Auth::user()->id}}">
  <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Map coordinate select</span>
      </div>
            <div id='map' style='width: 400px; height: 300px;'></div>
            <p id='coordinates'>Default:
              @if(!empty($hotel) > 0)
              {{$hotel->location_coordinate}}
              @else
              27.6588,85.3247
              @endif</p>
            <input type="hidden" name="location_cord" id="location_cord" >
      <script>
        oFormObject = document.forms['formy'];
        oFormElement = oFormObject.elements["location_cord"];
      mapboxgl.accessToken = 'pk.eyJ1IjoiYWF5dXJ0IiwiYSI6ImNqdWt3b3A3MTA4dHg0Y284czkyczczaWQifQ.gWr2V_XKM3uZPJdWFXlqAg';
      var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [85.3247,27.6588],
      zoom: 15
      });
      var coordinates = document.getElementById('coordinates');
      @if(!empty($hotel) > 0)
              var coordinate_is = "{{$hotel->location_coordinate}}";
              @else
              var coordinate_is = "27.6588,85.3247";
              @endif
      
      
      oFormObject.elements["location_cord"].value = coordinate_is;
      var marker = new mapboxgl.Marker({
      draggable: true})
      .setLngLat([85.3247,27.6588])
      .addTo(map);
      function onDragEnd() {
      var lngLat = marker.getLngLat();
      coordinate_is = lngLat.lat+','+lngLat.lng;
      coordinates.innerHTML = coordinate_is;
       oFormObject.elements["location_cord"].value = coordinate_is;
      }
      marker.on('dragend', onDragEnd);
      </script>
      <div class="input-group-append">
          <span class="input-group-text">Must be dragged</span>
      </div>
        </div>
        <input class="btn btn-success" type="submit" name="submit" value="Submit">
      </form>
@endsection