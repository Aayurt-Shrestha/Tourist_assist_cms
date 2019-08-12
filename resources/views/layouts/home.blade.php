@extends('m_Layout.master')
@section('body')
	<h3>Home</h3>
	<p>Popular Tours</p>
	<br>
  <div class="container">
    <div class="row">
    <div class="col-9">
    <table class="table table-dark">

    <tr>
      <th >Popular Tours</th>

    </tr>
  
    <tr>
        <?php $i=0?>
        @foreach($tours as $tour)
        <?php $i++?>
        <td  width="25%">
                            <div align="center">
                              <img src="{{url($tour->img)}}" width="130px" height="150px" style="background-color: white">
                            </div>
                            <div align="center" style="height:80px;margin:3px;">
                              <font style="font-size:16px; ">
                              <a href="tour/{{$tour->id}}" style="color: #ace600">{{$tour->name}}</a>
                              </font>
                              <br>
                                              <font size="1" color="#888888"><b>Rs. {{$tour->price}}</b><br><font color="grey">{{$tour->location}}</font>
                                              </font>
                                              <br>

                                            </div>
                          </td>
                          @if($i % 4 == 0)
                          </tr><tr>
                          @endif
                          @endforeach
    </tr>
</table>
    </div>
    <div class="col-3">
     <table class="table table-dark">
      <tr>
      <th >Categories</th>

    </tr>
    @foreach($categories as $category)
    <tr>
      <td><a href="category/{{$category->id}}">{{$category->name}}</a></td>
     
    </tr>
     @endforeach
     </table>
    </div>
    </div>

  </div>
@endsection