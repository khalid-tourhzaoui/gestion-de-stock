@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white" >Ajouter un paiement</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('admin-paiement.store') }}">
                            @csrf
                            <!--**********************************************************************************************************************-->
                            <div class="row mb-3">
                                <label for="id"class="col-md-4 col-form-label text-md-end">{{ __('Client : ') }}</label>
                                <div class="col-md-6">
                                    <select id="id" class="form-control" name="id">
                                        @foreach ($clients as $client )
                                        <option value="{{$client->id}}">{{$client->name}}</option>
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
                                <label for="prix_paiement"class="col-md-4 col-form-label text-md-end">{{ __('Montant du paiement : ') }}</label>
                                <div class="col-md-6">
                                    <input id="prix_paiement" type="number" class="form-control text-danger" name="prix_paiement" placeholder="Veuillez saisir le monatnt du paiement" required/>
                                    @error('prix_paiement')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_paiement"class="col-md-4 col-form-label text-md-end">{{ __('Date du paiement : ') }}</label>
                                <div class="col-md-6">
                                    <input id="date_paiement" type="date" class="form-control" name="date_paiement"  required autofocus>
                                    @error('date_paiement')
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
