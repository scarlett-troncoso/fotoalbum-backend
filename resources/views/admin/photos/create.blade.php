@extends('layouts.admin')
@section('content')
    <header class="py-3 title-pages-admin">
        <div class="container align-items-center m-auto text-center">
            <h2>
                <i class="fas fa-plus-circle fa-lg px-1"></i>
                Aggiungi una Foto
            </h2>
            <!--<a class="btn fw-bold link-admin-pages" href="{*{ route('admin.photos.index') }}">Back</a>-->
        </div>
    </header>

    <div class="container mt-4">

        <div class="color-bg-form m-auto w-75">

            @include('partials.errors')

            <form action="{{ route('admin.photos.store') }}" method="post" enctype="multipart/form-data"
                class="p-3 m-auto formCreate">
                @csrf

                <div class="mb-4">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control form-dark" name="title" id="title"
                        aria-describedby="titleHelper" placeholder="Titolo per la mia foto" value="{{ old('title') }}" />
                </div>

                <div class="d-flex gap-2 flex-wrap mb-4">
                    <div class="form-check form-switch" {{ $errors->has('in_evidence') ? 'is-invalid' : '' }}>
                        <input class="form-check-input" type="checkbox" role="switch" id="in_evidence" name="in_evidence"
                            value="1" {{ old('in_evidence') == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="in_evidence">In Evidenza</label>
                    </div>
                    @error('in_evidence')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 w-50 d-flex ">
                    <label for="category_id" class="form-label">Categoria: </label>
                    <select class="form-select form-select-sm mx-3" name="category_id" id="category_id">
                        <option selected disabled>Scegli una</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>
                                <!-- Se l'id category = category precedente allora selected-->
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="upload_image" class="form-label">Aggiungi una foto</label>
                    <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="Foto"
                        aria-describedby="uploadImageHelper" />
                    <div id="uploadImageHelper" class="form-text text-light">Dimensione massima della foto a caricare:
                        200kb
                    </div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" name="description" id="description" rows="5">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-light mb-1">
                    Crea
                </button>


            </form>
        </div>
    </div>
@endsection
