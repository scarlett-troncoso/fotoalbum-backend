@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3 class="fs-4 text-secondary my-4">
            Ciao {{ Auth::user()->name }}
        </h3>
    </div>
@endsection
