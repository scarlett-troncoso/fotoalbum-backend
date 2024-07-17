@extends('layouts.admin')

@section('content')
    <header class="title-pages-admin">
        <div class="container d-flex justify-content-between align-items-center">
            <h2>
                {{ $photo->title }}
            </h2>
            <a class="btn fw-bold link-admin-pages" href="{{ route('admin.photos.index') }}">Torna indietro</a>
        </div>
    </header>
    <div class="cont-show">
        <div class="container mt-3 mb-2 pt-3">
            <div class="row row-cols-1 row-cols-md-2 show">
                <div class="col cont-img-show">
                    @if (Str::startsWith($photo->upload_image, 'https://'))
                        <!--se il percorso inizia con https allora é un'immagine del seeder-->
                        <img loading="lazy" src="{{ $photo->upload_image }}" alt="">
                    @else
                        <!--  altrimente aggiungere storage/ al percorso-->
                        <img loading="lazy" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                    @endif
                </div>
                <div class="col mt-3 px-5">
                    <h4 class="green-dark">
                        {{ $photo->title }}
                    </h4>
                    <p class="f-merienda pt-3"> " {{ $photo->description }} " </p>
                    <div class="py-3">
                        <strong class="categ-green">Categoria: </strong>
                        <span class="badge bg-categ-green">
                            {{ $photo->category ? $photo->category->name : 'Uncategorized' }}
                        </span>
                    </div>
                    @if ($photo->in_evidence)
                        <div class="in_evidence py-1  orange">
                            <i class="fa-solid fa-circle-check"></i> <strong>Foto in evidenza</strong>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
