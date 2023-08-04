@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background-color:#008F7A">
                    <div class="text-center">
                        <h3 class="text-white">Les détails d'un utilistaeur</h3>
                    </div>
                </div>
                    <div class="row card-body">
                    <div class="col-md-6 form-group ">
                            <label>CIN : </label>
                            <input class="form-control" value="{{ $data->cin }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Nom & Prénom : </label>
                            <input class="form-control" value="{{ $data->name }}" readonly>
                        </div>
                        
                    </div>
                    <div class="row card-body">
                        <div class="col-md-6 form-group">
                            <label>Email : </label>
                            <input class="form-control" value="{{ $data->email }}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Role : </label>
                            <input class="form-control" value="{{ $data->role }}" readonly>
                        </div>
                    </div>
                    <div class="row card-body">
                    <div class="col-md-6 form-group">
                            <label>Téléphone</label>
                            <input class="form-control" value="{{ $data->telephonne }}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Adresse</label>
                            <input class="form-control" value="{{ $data->adresse }}" readonly>
                        </div>
                    </div>
                <div class="row card-body">
                    <div class=" col-md-6 offset-3 form-group ">
                        <a href="{{url('admin-utilisateurs') }}" class="btn btn-outline-success w-100">Retour</a>
                    </div>
                </div>           
            </div>
        </div>
    </div>
</div>
@endsection
