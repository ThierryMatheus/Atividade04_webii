@extends('layouts.app')

@section('content')

    @foreach ($vehicles as $vehicle)
    <div class="card">
        <div class="card-header">
            <h1>{{$vehicle->title}}</h1>
        </div>
    </div>
    <div class="card-body">
        <p class="card-title">User: {{$vehicle->user->name}}</p>
        <p class="card-text">Board{{$vehicle->board}}</p>
        <p class="card-text">Model{{$vehicle->model}}</p>
        @isset($vehicle->image)
        <img class="card-img-top" src="{{asset('storage/'.$vehicle->image->path)}}">
        @endisset
  
    </div>

    @endforeach

    {{$vehicles->links()}}
<img src="{{asset('storage/co1pbt2uaaf51.jpg')}}" alt="">
@endsection
