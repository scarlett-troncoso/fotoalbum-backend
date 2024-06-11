@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Photos
            </h1>
            <a href="{{ route('admin.photos.create') }}">Create</a>
        </div>
    </header>

    <div class="container mt-4">

        <div class="table-responsive">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">In Evidenza</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($photos as $photo)
                        <tr class="">
                            <td scope="row"> {{ $photo->id }} </td>

                            <td>
                                @if (Str::startsWith($photo->upload_image, 'https://'))
                                    <!--se il percorso inizia con https allora é un'immagine del seeder-->
                                    <img width="140" loading="lazy" src="{{ $photo->upload_image }}" alt="">
                                @else
                                    <!--  altrimente aggiungere storage/ al percorso-->
                                    <img width="140" loading="lazy" src="{{ asset('storage/' . $photo->upload_image) }}"
                                        alt="">
                                @endif
                            </td>

                            <td>{{ $photo->title }}</td>
                            <td>{{ $photo->slug }}</td>
                            {{-- <td>{{ $photo->category }}</td>
                            <td>{{ $photo->in_evidenza }}</td> --}}

                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.photos.show', $photo) }}">
                                    <i class="fas fa-eye fa-xs fa-fw"></i>
                                </a>
                                <a class="btn btn-sm btn-secondary" href="{*{ route('admin.photos.edit', $photo) }}">
                                    <i class="fas fa-pencil fa-xs fa-fw"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="#">
                                    <i class="fas fa-trash fa-xs fa-fw"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="7">No photos to show</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
