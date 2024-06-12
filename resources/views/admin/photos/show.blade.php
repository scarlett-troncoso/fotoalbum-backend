@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                {{ $photo->title }}
            </h1>
            <a href="{{ route('admin.photos.index') }}">Back</a>
        </div>
    </header>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                @if (Str::startsWith($photo->upload_image, 'https://'))
                    <!--se il percorso inizia con https allora é un'immagine del seeder-->
                    <img loading="lazy" class="img-fluid" src="{{ $photo->upload_image }}" alt="">
                @else
                    <!--  altrimente aggiungere storage/ al percorso-->
                    <img loading="lazy" class="img-fluid" src="{{ asset('storage/' . $photo->upload_image) }}"
                        alt="">
                @endif
            </div>
            <div class="col">
                <strong>Categoria: </strong>
                <span class="badge bg-dark">
                    {{ $photo->category ? $post->category->name : 'Uncategorized' }}
                </span>
                <p>{{ $photo->description }}</p>
            </div>
        </div>
    </div>
@endsection
