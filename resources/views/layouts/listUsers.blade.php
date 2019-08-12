@extends('m_Layout.master')
@section('body')
	<h3>Users</h3>
	<p>List of Users</p>
	<br>
  <table class="table table-dark">
  <thead>
    <tr>
      <th >#</th>
      <th >User Name</th>
      <th >User_Roles</th>
      <th >Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0?>
    @foreach($users as $user)
    <?php $i++?>
    <tr>
      <th ><?php echo $i?></th>
      <td>{{$user->name}}</td>
      <td>{{$user->user_role}}</td>
      <td>
        <form action="{{route('deluser',$user->id)}}" method="post">
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