@extends('layouts.admin')

@section('content')
    <header class="py-4 title-pages-admin">
        <div class="container d-flex justify-content-between align-items-center">
            <h2>
                {{ $photo->title }}
            </h2>
            <a class="btn fw-bold link-admin-pages" href="{{ route('admin.photos.index') }}">Back</a>
        </div>
    </header>

    <div class="container mt-2 mb-2">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col cont-img-show">
                @if (Str::startsWith($photo->upload_image, 'https://'))
                    <!--se il percorso inizia con https allora é un'immagine del seeder-->
                    <img loading="lazy" src="{{ $photo->upload_image }}" alt="">
                @else
                    <!--  altrimente aggiungere storage/ al percorso-->
                    <img loading="lazy" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                @endif
            </div>
            <div class="col mt-3">
                <h4>
                    {{ $photo->title }}
                </h4>
                <strong>Categoria: </strong>
                <span class="badge bg-dark">
                    {{ $photo->category ? $photo->category->name : 'Uncategorized' }}
                </span>
                @if ($photo->in_evidence)
                    <div class="in_evidence py-1">
                        <i class="fa-solid fa-circle-check orange"></i> Foto in evidenza
                    </div>
                @endif
                <p>{{ $photo->description }}</p>
            </div>
        </div>
    </div>
@endsection
