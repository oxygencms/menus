@extends('oxygencms::admin.layout')

@section('title', 'Create Menu')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-baseline mb-3">
            <h1>Create Menu</h1>
        </div>
    </div>

    <form action="{{ route('menu.store') }}" method="POST">
        @csrf

        @include('oxygencms::admin.menus._form-fields')

        <button class="btn btn-primary" type="submit">Save</button>
    </form>

@endsection