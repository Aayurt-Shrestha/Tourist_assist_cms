@extends('m_Layout.master')
@section('body')
	<h3>Category</h3>
	<p>Create a category</p>
	<br>
  @if(empty($category) > 0)
	<form action="{{route('category.store')}}" method="POST">
		@csrf 
		@method('post')
  @else
   <form action="{{route('category.update',$category->id)}}" method="POST">
    @csrf 
    @method('put')
  @endif

  	<div class="input-group mb-3">
    	<div class="input-group-prepend">
      		<span class="input-group-text">Title</span>
    	</div>
    	<input type="text" class="form-control" 
      placeholder="Type the category title" 
      name="name"
      @if(!empty($category) > 0)
        value="{{$category->name}}"
      @endif
      >
      <div class="input-group-append">
          <span class="input-group-text">#</span>
      </div>
  	</div>
 	<div class="input-group mb-3">
 		<span class="input-group-text">Description</span>
    <textarea class="form-control" rows="5" name="description">@if(!empty($category)> 0){{
      $category->description
    }}
      @endif
    </textarea>
  </div>

  <input class="btn btn-success" type="submit" name="submit" value="Submit">
</form>
@endsection