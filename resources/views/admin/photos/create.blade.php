@extends('layouts.admin')
@section('content')
    <header class="py-4 title-pages-admin">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Aggiungere una Foto
            </h1>
            <a class="btn fw-bold link-admin-pages" href="{{ route('admin.photos.index') }}">Back</a>
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

            <div class="d-flex gap-2 flex-wrap mb-3">
                <div class="form-check form-switch" {{ $errors->has('in_evidence') ? 'is-invalid' : '' }}>
                    <input class="form-check-input" type="checkbox" role="switch" id="in_evidence" name="in_evidence"
                        value="1" {{ old('in_evidence') == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="in_evidence">In Evidenza</label>
                </div>
                @error('in_evidence')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 w-25">
                <label for="category_id" class="form-label">Categoria: </label>
                <select class="form-select form-select-sm" name="category_id" id="category_id">
                    <option selected disabled>Scegli una</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                            <!-- Se l'id category = category precedente allora selected-->
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="upload_image" class="form-label">Aggiunge una foto</label>
                <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="Foto"
                    aria-describedby="uploadImageHelper" />
                <div id="uploadImageHelper" class="form-text">Dimensione massima della foto a caricare: 200kb</div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mb-3">
                Crea
            </button>


        </form>
    </div>
@endsection
