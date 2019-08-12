@extends('m_Layout.master')
@section('body')
	<h3>Tour</h3>
	<p>Create a tour</p>
	<br>
  @if(empty($tour) > 0)
	<form action="{{route('tour.store')}}" method="POST" enctype="multipart/form-data"
  name="formy">
		@csrf 
		@method('post')
  @else
   <form action="{{route('tour.update',$tour->id)}}" enctype="multipart/form-data"
  name="formy" method="POST">
    @csrf 
    @method('put')
  @endif

  	<div class="input-group mb-3">
    	<div class="input-group-prepend">
      		<span class="input-group-text">Title</span>
    	</div>
    	<input type="text" class="form-control" 
      placeholder="Type the tour title" 
      name="name"
      @if(!empty($tour) > 0)
        value="{{$tour->name}}"
      @endif
      >
      <div class="input-group-append">
          <span class="input-group-text">tour</span>
      </div>
  	</div>
 	<div class="input-group mb-3">
 	<span class="input-group-text">Description</span><textarea class="form-control" rows="5" name="description">@if(!empty($tour)> 0){{
      $tour->description
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
      @if(!empty($tour) > 0)
        value="{{$tour->price}}"
      @endif
      >
      <div class="input-group-append">
          <span class="input-group-text">Individual</span>
      </div>
  </div>
  @if(empty($tour) > 0)
  <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Category</span>
          <div class="checkbox">
            @foreach($categories as $category)
            @if(($category->id)==1)
              <input type="checkbox" name="check_list[]" value="1" checked hidden>
            @else
          <label><input type="checkbox" name="check_list[]" value="{{$category->id}}">{{$category->name}}</label>
          @endif
          @endforeach
          </div>
    </div>
  </div>
  @else
  <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Category</span>
          <div class="checkbox">
            @foreach($tour->categories as $category)
              <input type="checkbox"  checked disabled>{{ $category->name }}
            @endforeach
          </div>
    </div>
  </div>
  @endif
  <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Feature Image</span>
      </div>
      @if(!empty($tour)> 0)
         <img src="{{url($tour->img)}}" width="130px" height="150px" style="background-color: white">
         <input  class="form-control"
      type="file" name="image" value="$tour->img" 
      >
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
              @if(!empty($tour) > 0)
              {{$tour->location_coordinate}}
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
      @if(!empty($tour) > 0)
              var coordinate_is = "{{$tour->location_coordinate}}";
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
        <div class="input-group mb-3">
    <div class="input-group-prepend">
          <span class="input-group-text">Location</span>
      </div>
      <input type="text" class="form-control" 
      placeholder="Type location tag" 
      name="location"
      @if(!empty($tour) > 0)
        value="{{$tour->location}}"
      @endif
      >
      <div class="input-group-append">
          <span class="input-group-text">Tag</span>
      </div>
  </div>
        <input class="btn btn-success" type="submit" name="submit" value="Submit">
      </form>
@endsection