@extends('layouts.admin')
@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Aggiungere una nuova Foto
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.photos.index') }}">Back</a>
        </div>
    </header>

    <div class="container mt-4">

        @include('partials.errors')

        <form action="{{ route('admin.photos.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Titolo per la mia foto" value="{{ old('title') }}" />
                <small id="titleHelper" class="form-text text-muted">Scrivi qui il un titolo per la foto</small>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select class="form-select form-select-lg" name="category" id="category">
                    <option selected disabled>Scegli una</option>
                    <option value="categories">
                        Categorie
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="upload_image" class="form-label">Foto</label>
                <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="cover image"
                    aria-describedby="uploadImageHelper" />
                <div id="uploadImageHelper" class="form-text">Carica una foto</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Crea
            </button>


        </form>
    </div>
@endsection
