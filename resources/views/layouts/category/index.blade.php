@extends('m_Layout.master')
@section('body')
	<h3>Category</h3>
	<p>List of category</p>
	<table class="table table-dark">
  <thead>
    <tr>
      <th >#</th>
      <th >Category title</th>
      <th >Description</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0?>
    @foreach($categories as $category)
    <?php $i++?>
    <tr>
      <th ><?php echo $i?></th>
      <td><a href="category/{{$category->id}}">{{$category->name}}</a></td>
      <td>{{$category->description}}</td>
      <td>
        <form action="{{route('category.edit',$category->id)}}" method="post">
            <button class="btn btn-info">
            @csrf
            @method('get')
            Edit
            </button>
        </form>
        <form action="{{route('category.destroy',$category->id)}}" method="post">
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