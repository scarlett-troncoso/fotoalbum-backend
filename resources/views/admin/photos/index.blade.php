@extends('layouts.admin')

@section('content')
    <header class="py-3 title-pages-admin">
        <div class=" container d-flex justify-content-between align-items-center">
            <h2 class="m-auto">
                <i class="fas fa-camera fa-lg px-1"></i>
                Foto di {{ Auth::user()->name }}
            </h2>
            <!--<a class="btn fw-bold link-admin-pages" href="{*{ route('admin.photos.create') }}">Crea</a>-->
        </div>
    </header>

    <div class="container mt-4">
        @include('partials.session-messages')
        <div class="table-responsive ">
            <table class="table w-75 m-auto table-success">
                <thead>
                    <tr class="">
                        <th scope="col" class="py-3">Id</th>
                        <th scope="col" class="py-3">Foto</th>
                        <th scope="col" class="py-3">Titolo</th>
                        <th scope="col" class="py-3">Categoria</th>
                        <th scope="col" class="py-3">In evidenza</th>
                        <th scope="col" class="py-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($photos as $photo)
                        <tr>
                            <td scope="row" class="text-center"> {{ $photo->id }} </td>

                            <td class="cont-img">
                                @if (Str::startsWith($photo->upload_image, 'https://'))
                                    <!--se il percorso inizia con https allora é un'immagine del seeder-->
                                    <img src="{{ $photo->upload_image }}">
                                @else
                                    <!--  altrimente aggiungere storage/ al percorso-->
                                    <img loading="lazy" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                                @endif
                            </td>

                            <td class="ml-3">{{ $photo->title }}</td>
                            <td>{{ $photo->category ? $photo->category->name : 'Senza Categoria' }}</td>
                            <td class="text-center">
                                <i
                                    class=" text-center {{ $photo->in_evidence == true ? 'fas fa-circle-check fa-lg fa-fw text-success' : 'fas fa-circle-xmark fa-fw fa-lg text-danger' }}"></i>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.photos.show', $photo) }}">
                                    <i class="fas fa-eye fa-xs fa-fw"></i>
                                </a>
                                <a class="btn btn-sm btn-secondary" href="{{ route('admin.photos.edit', $photo) }}">
                                    <i class="fas fa-pencil fa-xs fa-fw"></i>
                                </a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $photo->id }}">
                                    <i class="fas fa-trash fa-xs fa-fw"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $photo->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $photo->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $photo->id }}">
                                                    Cancella foto
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei cicuro di voler cancellare questa foto?
                                                <strong>{{ $photo->title }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Chiudi
                                                </button>
                                                <form action="{{ route('admin.photos.destroy', $photo) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-primary">
                                                        Conferma
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="">
                            <td scope="row" colspan="7">Non ci sono foto da mostrare</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{ $photos->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
