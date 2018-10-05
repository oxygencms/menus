@extends('oxygencms::admin.layout')

@section('title', 'Create Link')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-baseline mb-3">
            <h1>Create link in: {{ $menu->name }}</h1>
        </div>
    </div>

    <form action="{{ route('menu.link.store', $menu) }}" method="POST">
        @csrf

        @include('oxygencms::admin.menus.links._form-fields')

        <button class="btn btn-primary" type="submit">Save</button>
    </form>

@endsection