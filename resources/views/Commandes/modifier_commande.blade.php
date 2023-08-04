@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white" >Modifier une commande</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('commande.update',$data->id_commande) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="quantite_commande"class="col-md-4 col-form-label text-md-end">{{ __('Quantité commandée en (KG) : ') }}</label>
                                <div class="col-md-6">
                                    <input id="quantite_commande" class="form-control text-danger" type="number" name="quantite_commande" 
                                    value="{{old('quantite_commande',$data->quantite_commande)}}" required />
                                    @error('quantite_commande')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $quantite_commande }}</strong>
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
