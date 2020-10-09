@extends('layouts.app')
@section('content')

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">board: {{$vehicle->board}}</h5>
        <h5 class="card-text">model: {{$vehicle->model}}</h5>
        <a href="{{route('vehicles.index')}}" class="btn btn-outline-secondary">Voltar</a>
        <h5>image:</h5>
        <img class="card-img-top" src="{{ asset('storage/'.$vehicle->image->path)}}" alt="Card image cap">
      </div>
</div>