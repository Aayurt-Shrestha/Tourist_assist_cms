@extends('m_Layout.master')
@section('body')
	<h3>Tour</h3>
	<p>List of Tour</p>
	<table class="table table-dark">
  <thead>
    <tr>
      <th >#</th>
      <th >Tour title</th>
      <th >Description</th>
      <th >Image</th>
      <th >Price</th>
      <th >Location coordinate</th>
      <th >Category</th>
      <th >Views</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0?>
    @foreach($tours as $tour)
    <?php $i++?>
    <tr>
      <th ><?php echo $i?></th>
      <td><a href="tour/{{$tour->id}}">{{$tour->name}}</a></td>
      <td>{{$tour->description}}</td>
      <td>
        <img src="{{url($tour->img)}}" width="130px" height="150px" style="background-color: white">
      </td>
      <td>{{$tour->price}}</td>
      <td>{{$tour->location_coordinate}}</td>
      <td>
       @foreach($tour->categories as $category)
        {{ $category->name }},
       @endforeach 

      </td>
      <td>
        {{$tour->views}}
      </td>
      <td>
        <form action="{{route('tour.edit',$tour->id)}}" method="post">
            <button class="btn btn-info">
            @csrf
            @method('get')
            Edit
            </button>
        </form>
        <form action="{{route('tour.destroy',$tour->id)}}" method="post">
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