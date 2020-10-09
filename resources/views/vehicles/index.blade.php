@extends('layouts.app')
@section('content')


<div class="row">
  <div class="col">
    <div class="pull-left">
      <h2>Index Veículos</h2>
    </div>
  </div>
</div>

@if (session('sucess'))
    <div class="alert alert-sucess">
      {{session('sucess')}}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
      {{session('error')}}
    </div>
@endif


<table class="table table-bordered">
  <tr>
    <th>ID</th>
    <th>Board</th>
    <th>Model</th>
    <th>User</th>
    <th width="230px">Action</th>
  </tr>
  @foreach ($vehicles ?? '' as $vehicle)
  <tr>
    <td>{{$vehicle->id }}</td>
    <td>
      <a href="{{url("/vehicles/{$vehicle->id}")}}">
        {{$vehicle->board}}
      </a>
    </td>
    <td>
        {{$vehicle->model}}
      </a>
    </td>
    <td>
      {{$vehicle->user->name}}
    </a>
  </td>


    <td>
      <form action="{{route('vehicles.destroy', $vehicle->id)}}" method="POST">
        <a class="btn btn-info" href="{{route('vehicles.show',$vehicle->id)}}">
          Show
        </a>
        <a class="btn btn-primary" href="{{route('vehicles.edit',$vehicle->id)}}">Edit</a>
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>

{{ $vehicles ?? ''->links() }}

@endsection