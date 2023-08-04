@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white" >Ajouter une livraison</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('admin-livraison.store') }}">
                            @csrf
                            <!--**********************************************************************************************************************-->
                            <div class="row mb-3">
                                <label for="id"class="col-md-4 col-form-label text-md-end">{{ __('Livreur : ') }}</label>
                                <div class="col-md-6">
                                    <select id="id" class="form-control" name="id">
                                        @foreach ($livreurs as $livreur )
                                        <option value="{{$livreur->id}}">{{$livreur->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="id_commande"class="col-md-4 col-form-label text-md-end">{{ __('Commande : ') }}</label>
                                <div class="col-md-6">
                                    <select id="id_commande" class="form-control" name="id_commande">
                                        @foreach ($commandes as $commande )
                                            <option value="{{$commande->id_commande}}">{{'N² :'.$commande->id_commande.' | Client :'.$commande->user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_commande')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="adresse"class="col-md-4 col-form-label text-md-end">{{ __('Adresse du livraison : ') }}</label>
                                <div class="col-md-6">
                                    <input id="adresse" type="text" class="form-control text-danger" name="adresse" placeholder="Veuillez saisir l'adresse du livraison" required/>
                                    @error('adresse')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_livraison"class="col-md-4 col-form-label text-md-end">{{ __('Date du livraison : ') }}</label>
                                <div class="col-md-6">
                                    <input id="date_livraison" type="date" class="form-control" name="date_livraison" value="{{ old('date_livraison') }}" required autofocus>
                                    @error('date_livraison')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-success w-100">
                                        {{ __('Ajouter') }}
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
