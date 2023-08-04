@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white">Modifier un utilisateur</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('admin.update', $data->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nom & Prénom : ') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" placeholder="Veuillez saisir le nom & prénom d'utilisateur" required>
                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="cin" class="col-md-4 col-form-label text-md-end">{{ __('CIN : ') }}</label>
                                <div class="col-md-6">
                                    <input id="cin" type="text" class="form-control" name="cin" placeholder="Veuillez saisir la cin d'utilisateur" value="{{ old('cin', $data->cin) }}" required/>
                                    <input type="hidden" name="old_cin" value="{{ old('cin', $data->cin) }}"/>
                                    @error('cin')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email : ') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Veuillez saisir l'email d'utilisateur" value="{{ old('email', $data->email) }}" required/>
                                    <input type="hidden"  value="{{ old('email', $data->email) }}" name="old_email"/>
                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="adresse" class="col-md-4 col-form-label text-md-end">{{ __('Adresse : ') }}</label>
                                <div class="col-md-6">
                                    <input id="adresse" type="text" class="form-control" name="adresse" placeholder="Veuillez saisir l'adresse d'utilisateur" value="{{ old('adresse', $data->adresse) }}" required/>
                                    @error('adresse')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="telephonne" class="col-md-4 col-form-label text-md-end">{{ __('téléphonne : ') }}</label>
                                <div class="col-md-6">
                                    <input id="telephonne" type="text" class="form-control" name="telephonne" placeholder="Veuillez saisir l'telephonne d'utilisateur" value="{{ old('telephonne', $data->telephonne) }}" required/>
                                    @error('telephonne')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role : ') }}</label>
                                <div class="col-md-6">
                                    <select id="role" class="form-control" name="role">
                                        <option value="0">Admin</option>
                                        <option value="1">Client</option>
                                        <option value="2">Fournisseur</option>
                                        <option value="3">Livreur</option>
                                    </select>
                                    @error('role')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-success w-100">
                                        {{ __('Mettre à jour') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
