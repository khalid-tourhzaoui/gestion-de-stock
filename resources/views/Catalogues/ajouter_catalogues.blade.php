@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white" >Ajouter un nouveau catalogue</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('catalogue.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="title"class="col-md-4 col-form-label text-md-end">{{ __('Title : ') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Veuillez saisir le title du catalogue" required >
                                    @error('title')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="description"class="col-md-4 col-form-label text-md-end">{{ __('Description : ') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control text-danger" name="description" placeholder="Veuillez saisir la description du catalogue" required>
                                        
                                    </textarea>

                                    @error('description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image"class="col-md-4 col-form-label text-md-end">{{ __('Image : ') }}</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" placeholder="Veuillez saisir l'image du catalogue" required autofocus>
                                    @error('image')
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
