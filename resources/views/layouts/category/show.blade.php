@extends('m_Layout.master')
@section('body')
	<h2>Category</h3>
	<p>Category Detail</p>
	<br>

  <h3>{{$category->name}}</h2>
    <table class="table table-dark" >
  <tr>
    <th>Description</th>
    
  </tr>
  <tr><td>{{$category->description}}</td></tr>
  </table>
  <a href="{{url('/')}}">
  <button class="btn btn-info">Go to Home</button>
  </a>
@endsection