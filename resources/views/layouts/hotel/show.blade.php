@extends('m_Layout.master')
@section('body')
	<h2>Hotel</h3>
	<p>Hotel Detail</p>
	<br>

  <h3>{{$hotel->name}}</h2>
    <table class="table table-dark">
  <tr>
    <th>Description</th>
    <td>{{$hotel->description}}</td>
  </tr>
  <tr>
    <th>Image</th>
    <td><img src="{{url($hotel->img)}}" width="150px" height="170px" style="background-color: white"></td>

  </tr>
   <tr>
    <th>Price</th>
    <td>{{$hotel->price}}</td>
  </tr>
  <tr>
    <th>Location</th>

    <td>
      <div id='map' style='width: 400px; height: 300px;'></div>

      <p id='lcoordinates'>{{$hotel->location_coordinate}}</p>
      <br>
      <p id='coordinates'></p>
      <script>
        var lacoordinates = document.getElementById('lcoordinates');
        lacoordinates.style.display = "none";
        var lcoordinates = lacoordinates.textContent;
        var cordArr = lcoordinates.split(',');
        var lat = cordArr[0];
        var lng = cordArr[1];
        var lat1 = parseFloat(lat);
        var lng1 = parseFloat(lng);
        
      mapboxgl.accessToken = 'pk.eyJ1IjoiYWF5dXJ0IiwiYSI6ImNqdWt3b3A3MTA4dHg0Y284czkyczczaWQifQ.gWr2V_XKM3uZPJdWFXlqAg';
      var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [lng1,lat1],
      zoom: 15
      });
  // var coordinates = document.getElementById('coordinates');
  // coordinates.innerHTML = lat1;
      var marker = new mapboxgl.Marker({
      draggable: false})
      .setLngLat([lng1,lat1])
      .addTo(map);

      </script>
    </td>
  </tr>

  </table>
  <a href="{{url('/')}}">
  <button class="btn btn-info">Go to Home</button>
  </a>
@endsection