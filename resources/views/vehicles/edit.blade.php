@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col">
    <div class="pull-left">
      <h2>Editar Veículos</h2>
    </div>
  </div>
</div>

<form action="{{route('vehicles.update', $vehicle->id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="exampleInputEmail1">Placa do Veículo</label>
  <input type="text" class="form-control" name="board" value="{{$vehicle->board}}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Modelo do Veiculo</label>
    <input type="text" class="form-control" name="model" value="{{$vehicle->model}}">
  </div>  
  <div class="form-group">
    <label for="exampleInputEmail1">Imagem do Veiculo</label>
  <img src="{{asset('storage/'.$vehicle->image->path)}}">
    <input type="file" class="form-control" name="image" id="image">
  </div> 
  <button type="submit" class="btn btn-primary">Editar</button>
</form>

@endsection