@extends('layouts.admin')
@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Editare {{ $photo->title }}
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.photos.index') }}">Torna indietro</a>
        </div>
    </header>

    <div class="container mt-4">

        @include('partials.errors')

        <form action="{{ route('admin.photos.update', $photo) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Titolo per la mia foto" value="{{ old('title', $photo->title) }}" />
                <small id="titleHelper" class="form-text text-muted">Cambia titolo per la foto</small>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
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
                <img width="140" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                <label for="upload_image" class="form-label">Cambia foto</label>
                <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="cover image"
                    aria-describedby="uploadImageHelper" />
                <div id="uploadImageHelper" class="form-text">Carica una nuova foto</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" name="description" id="description" rows="5">{{ old('description', $photo->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Salva Modifiche
            </button>


        </form>
    </div>
@endsection
