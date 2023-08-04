@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white" >Ajouter un nouveau réclamation</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('reclamation.store') }}">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="message"class="col-md-4 col-form-label text-md-end">{{ __('Message : ') }}</label>
                                <div class="col-md-6">
                                    <textarea id="message" class="form-control text-danger" name="message" placeholder="Veuillez saisir la message du réclamation" required>
                                        
                                    </textarea>

                                    @error('message')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date_reclamation"class="col-md-4 col-form-label text-md-end">{{ __('Date réclamation : ') }}</label>
                                <div class="col-md-6">
                                    <input id="date_reclamation" type="date" class="form-control" name="date_reclamation" value="{{ old('date_reclamation') }}"  required autofocus>
                                    @error('date_reclamation')
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
