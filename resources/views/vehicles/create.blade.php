@extends('layouts.app')
@section('content')
    <div class="row">
      <div class="col-lg-12 margin-tb">
        <div class="pull-left">
          <h2>Cadastrar Veículo</h2>
        </div>
      </div>
    </div>

  <form action="{{ route('vehicles.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Placa do Veículo</label>
      <input type="text" class="form-control" name="board" placeholder="AAA-1111">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Modelo do Veiculo</label>
      <input type="text" class="form-control" name="model" placeholder="Modelo">
    </div> 
    <div class="form-group">
      <label for="exampleInputEmail1">Imagem do Veiculo</label>
      <input type="file" class="form-control" name="image" id="image">
    </div> 
    <button type="submit" class="btn btn-primary">Cadastrar</button>
  </form>
@endsection