@extends('m_Layout.master')
@section('body')
	<h3>hotel</h3>
	<p>List of hotel</p>
	<table class="table table-dark">
  <thead>
    <tr>
      <th >#</th>
      <th >Hotel title</th>
      <th >Description</th>
      <th >Image</th>
      <th >Price</th>
      <th >Location coordinate</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0?>
    @foreach($hotels as $hotel)
    <?php $i++?>
    <tr>
      <th ><?php echo $i?></th>
      <td>{{$hotel->name}}</td>
      <td>{{$hotel->description}}</td>
      <td>
        <img src="{{url($hotel->img)}}" width="130px" height="150px" style="background-color: white">
      </td>
      <td>{{$hotel->price}}</td>
      <td>{{$hotel->location_coordinate}}</td>
      <td>
        <form action="{{route('hotel.edit',$hotel->id)}}" method="post">
            <button class="btn btn-info">
            @csrf
            @method('get')
            Edit
            </button>
        </form>
        <form action="{{route('hotel.destroy',$hotel->id)}}" method="post">
            <button class="btn btn-danger">
            @csrf
            @method('delete')
            Delete
            </button>
        </form>
        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection