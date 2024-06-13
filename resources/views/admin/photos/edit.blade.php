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

            <!---<div class="d-flex gap-2 flex-wrap">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                                                {*{ $photo->in_evidence == true ? 'checked' : '' }} value="in_evidence">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">In Evidenza
                                                                {*{ $photo->in_evidence }}</label>
                                                            value="{*{ $photo->in_evidence }}"

                                                            {*{ old('in_evidence', $photo->in_evidence) ? 'checked' : '' }}
                                                        </div>
                                                        @*error('in_evidence')
                                                            <div class="text-danger">{*{ $message }}</div>
                                                        @*enderror
                                                    </div>-->

            <!--<div class="mb-3">
                    <label for="in_evidence" class="form-label">In Evidenza</label>
                    <select class="form-select form-select-lg" name="in_evidence" id="in_evidence">
                        <option value="1">true</option>
                        <option value="0">false</option>-->
            <!--
                                                    <option value="{*{ $photo->in_evidence }}"
                                                        {*{ $photo->in_evidence == old('in_evidence', $photo->in_evidence) ? 'selected' : '' }}>
                                                        {*{ $photo->in_evidence }}
                                                    </option>
                                                    <option value="{*{ $photo->in_evidence }}"
                                                        {*{ $photo->in_evidence == old('in_evidence', $photo->in_evidence) ? 'selected' : '' }}>
                                                        true
                                                    </option>
                                                @*if (old('in_evidence') == 0) selected @*endif-->
            </select>
    </div>


    <div class="mb-3">
        <label for="category_id" class="form-label">Categoria</label>
        <select class="form-select form-select-lg" name="category_id" id="category_id">
            <option selected disabled>Scegli una</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $category->id == old('category_id', $photo->category?->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
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
