@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card my-2 bg-light">
                <div class="card-header" style="background-color:#008F7A">
                    <div class="text-center">
                        <h3 class="text-white">Les détails du réclamation</h3>
                    </div>
                </div>
                <div class="row card-body">
                    @if (Auth::user()->role=="admin")
                    <div class="row card-body">
                        <!-- Displaying user details for an admin -->
                        <div class="col-md-6 form-group">
                            <label>Nom & Prénom : </label>
                            <input class="form-control" value="{{ $data->user->name }}" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Téléphone</label>
                            <input class="form-control" value="{{ $data->user->telephonne }}" readonly>
                        </div>
                    </div>
                    <!-- ********************************************************************************************** -->
                    <div class="row card-body">
                        <div class="col-md-6 form-group">
                            <label>Adresse : </label>
                            <input class="form-control" value="{{ $data->user->adresse }}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Date Réclamation : </label>
                            <input class="form-control" value="{{ $data->date_reclamation }}" readonly>
                        </div>
                    </div>
                    @else
                    <div class="row card-body">
                        <!-- Displaying reclamation details for a regular user -->
                        <div class="col-md-6 form-group ">
                            <label>ID</label>
                            <input class="form-control" value="{{ $data->id }}" readonly>
                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Date Réclamation</label>
                            <input class="form-control" value="{{ $data->date_reclamation }}" readonly>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row card-body">
                    <!-- Displaying the reclamation message -->
                    <div class="col-12 form-group">
                        <label>Message</label>
                        <textarea readonly cols="10" class="form-control" rows="5">{{ $data->message }}</textarea>
                    </div>
                </div>
                <div class="row card-body">
                    <div class=" col-md-6 offset-3 form-group ">
                        @if (Auth::user()->role=="admin")
                        <!-- Displaying a "Retour" button for admin users -->
                        <a href="{{ route('admin-reclamation.index') }}" class="btn btn-outline-success w-100">Retour</a>
                        @else
                        <!-- Displaying a "Retour" button for regular users -->
                        <a href="{{ route('reclamation.index') }}" class="btn btn-outline-success w-100">Retour</a>
                        @endif
                    </div>
                </div>           
            </div>
        </div>
    </div>
</div>
@endsection
