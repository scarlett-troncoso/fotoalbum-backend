@extends('layouts.admin')
@section('content')
    <header class="title-pages-admin">
        <div class="container d-flex justify-content-between align-items-center">
            <h2>
                <i class="fas fa-pencil fa-md fa-fw"></i> Modifica: {{ $photo->title }}
            </h2>
            <a class="btn fw-bold link-admin-pages" href="{{ route('admin.photos.index') }}">Torna indietro</a>
        </div>
    </header>

    <div class="container mt-4">

        @include('partials.errors')
        <div class="m-auto w-75 color-bg-form ">
            <form action="{{ route('admin.photos.update', $photo) }}" method="post" enctype="multipart/form-data"
                class="p-3 m-auto formCreate mb-2 opacity-7">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                        placeholder="Titolo per la mia foto" value="{{ old('title', $photo->title) }}" />
                    <small id="titleHelper" class="form-text text-muted">Modifica titolo</small>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-2 flex-wrap mb-4">
                        <div class="form-check form-switch" {{ $errors->has('in_evidence') ? 'is-invalid' : '' }}>
                            <input class="form-check-input" type="checkbox" role="switch" id="in_evidence"
                                name="in_evidence" value="1"
                                {{ old('in_evidence', $photo->in_evidence) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="in_evidence">In Evidenza</label>
                        </div>
                        @error('in_evidence')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 w-50 d-flex">
                        <label for="category_id" class="form-label">Categoria:</label>
                        <select class="form-select form-select-sm mx-3" name="category_id" id="category_id">
                            <option selected disabled>Scegli una</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('category_id', $photo->category?->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-4 d-flex align-items-center">
                    <div>
                        <img width="140" class="mb-1" src="{{ asset('storage/' . $photo->upload_image) }}"
                            alt="">
                    </div>
                    <div class="mx-3">
                        <input type="file" class="form-control" name="upload_image" id="upload_image"
                            placeholder="cover image" aria-describedby="uploadImageHelper" />
                        <div id="uploadImageHelper" class="form-text text-light">Dimensione massima della foto a caricare:
                            200kb
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $photo->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-light mb-3">
                    Salva Modifiche
                </button>
            </form>
        </div>

    </div>
@endsection
