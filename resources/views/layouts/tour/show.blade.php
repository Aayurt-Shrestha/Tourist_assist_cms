@extends('m_Layout.master')
@section('body')
	<h2>Tour</h3>
	<p>Tour Detail</p>
	<br>

  <h3>{{$tour->name}}</h2>
    <table class="table table-dark">
      <tr>
      <th>Category</th>
      <td>@foreach($tour->categories as $category)
        {{ $category->name }},
  @endforeach</td>
  
  </tr>
  <tr>
    <th>Description</th>
    <td>{{$tour->description}}</td>
  </tr>
  <tr>
    <th>Image</th>
    <td><img src="{{url($tour->img)}}" width="150px" height="170px" style="background-color: white"></td>

  </tr>
   <tr>
    <th>Price</th>
    <td>{{$tour->price}}</td>
  </tr>
  <tr>
    <th>Location and Nearby Hotels</th>


    <td>
      <div id='map' style='width: 400px; height: 300px;'></div>

      <p id='lcoordinates'>{{$tour->location_coordinate}}</p>
      <br>
      <p>Nearby Hotels:</p>
      <?php $i=0;
            $k = $tour->location_coordinate;
            $tour_arr = explode(",", $k);
            $tour_lat = $tour_arr[0];
            $tour_lng = $tour_arr[1];
      ?>
      @foreach($hotels as $hotel)

        <?php $j =$hotel->location_coordinate;
              $hotel_arr = explode(",", $j);
              $hotel_lat = $hotel_arr[0];
              $hotel_lng = $hotel_arr[1];
              if (abs($tour_lat-$hotel_lat) < 0.7 && abs($tour_lng-$hotel_lng) < 0.7) {
                echo "<a style=' text-decoration: none;' href='/hotel/".$hotel->id."'>".$hotel->name."</a>";
                echo "<br>";
              }
        ?>
      @endforeach
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