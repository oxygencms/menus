@extends('oxygencms::admin.layout')

@section('title', 'Edit Link')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-baseline mb-3">
            <h1>Editing link in: {{ $menu->name }}</h1>
        </div>
    </div>

    <form action="{{ route('menu.link.update', [$menu, $link]) }}" method="POST">
        {!! csrf_field() !!}
        {!! method_field('patch') !!}

        @include('oxygencms::admin.menus.links._form-fields')

        <button class="btn btn-primary" type="submit">Update</button>
    </form>

@endsection