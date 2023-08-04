@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background-color:#008F7A">
                    <div class="text-center">
                        <h3 class="text-white">Les détailles d'un catalogue</h3>
                    </div>
                </div>
                <div class="row card-body">
                    <div class="card mb-3 text-dark">
                                <div class="row g-0">
                                    <div class="col-md-6 mt-3">
                                        <img src="{{ asset($data->image) }}" class="img-fluid rounded-start" style="width: 30rem;height:auto;" alt="...">
                                    </div>
                                    <!--********************************************************************************************-->
                                    <div class="col-md-6">
                                    @if (Auth::user()->role=="admin")
                                    <div class=" row card-body">
                                            <div class=" col-6 form-group mb-3">
                                                <label >Nom & Prénom</label>
                                                <input class="form-control" value="{{$data->user->name}}" readonly>
                                            </div>
                                            <div class=" col-6 form-group mb-3">
                                                <label >Adresse & Téléphonne</label>
                                                <input class="form-control" value="{{$data->user->adresse.' | '.$data->user->telephonne}}" readonly>
                                            </div>

                                        </div>
                                    @endif
                                        <div class=" row card-body">
                                            <div class=" col-6 form-group mb-3">
                                                <label >Titre</label>
                                                <input class="form-control" value="{{$data->title}}" readonly>
                                            </div>
                                            <div class=" col-6 form-group mb-3">
                                                <label >Date du Catalogue</label>
                                                <input class="form-control" value="{{ \Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}" readonly>
                                            </div>

                                        </div>
                                        
                                        <div class=" row card-body">
                                            <div class=" col-12 form-group mb-3">
                                                <label >Description</label>
                                                <textarea class="form-control" readonly>{{$data->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class=" row card-body">
                                            <div class=" col-12 form-group mb-3">
                                                @if (Auth::user()->role=="admin")
                                                <a href="{{route('admin-catalogue.index')}}" class="btn btn-outline-success w-100">Retour</a>
                                                @else
                                                <a href="{{route('catalogue.index')}}" class="btn btn-outline-success w-100">Retour</a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>            
            </div>
        </div>
    </div>
</div>
@endsection
