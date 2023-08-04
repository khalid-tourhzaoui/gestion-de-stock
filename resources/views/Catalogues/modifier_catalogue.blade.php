@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 bg-light ">
                    <div class="card-header" style="background-color:#008F7A">
                        <div class="text-center">
                            <h3 class="text-white">Modifier le catalogue</h3>
                        </div>
                    </div>
                    <div class="card-body bg-light">
                        <form method="POST" action="{{ route('catalogue.update', $data->id_catalogue) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title : ') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $data->title) }}" placeholder="Veuillez saisir le titre du catalogue" required>
                                    @error('title')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description : ') }}</label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" placeholder="Veuillez saisir la description du catalogue" required>{{ old('description', $data->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Image : ') }}</label>
                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" placeholder="Veuillez sélectionner une nouvelle image">
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
