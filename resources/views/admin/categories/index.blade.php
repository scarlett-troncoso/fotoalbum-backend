@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Categories
            </h1>
        </div>
    </header>

    <div class="container mt-4">
        @include('partials.session-messages')

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col-2">
                <form action="{{ route('admin.categories.store') }}" method="post" class="d-flex">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Creare nuova categoria: </label>
                        <div class="d-flex">
                            <input type="text" class="form-control m-50" name="name" id="name"
                                aria-describedby="helpId" placeholder="Nome Categoria" />

                            <button type="submit" class="btn btn-primary btn-sm m-50">
                                <i class="fa fa-plus fa-sm fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2">
                <div class="table-responsive">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Totale foto</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="">
                                    <td scope="row"> {{ $category->id }} </td>

                                    <td>
                                        <form action="{{ route('admin.categories.update', $category) }}" method="post">
                                            @csrf
                                            @method('PATCH') <!---patch perche sará sólo un campo-->
                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="name" id="name"
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $category->name }}" />
                                            </div>
                                        </form>
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        {{ $category->photos->count() }}
                                    </td>

                                    <td>
                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $category->id }}">
                                            <i class="fas fa-trash fa-xs fa-fw"></i>
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-{{ $category->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $category->id }}">
                                                            Cancella category
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Sei cicuro di voler cancellare questa foto?
                                                        <strong>{{ $category->name }}</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Chiudi
                                                        </button>
                                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                                            method="post">
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
                                    <td scope="row" colspan="7">Non ci sono categotie da mostrare</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
