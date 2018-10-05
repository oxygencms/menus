@extends('oxygencms::admin.layout')

@section('title', 'Edit Link')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-baseline mb-3">
            <h1>Edit Menu</h1>

            <div class="ml-auto d-flex justify-content-end">
                <div>
                    <a href="{{ route('menu.link.create', $menu) }}" class="btn">
                        Add Link <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('menu.update', $menu) }}" method="POST" class="mb-4">
        {!! csrf_field() !!}
        {!! method_field('patch') !!}

        @include('oxygencms::admin.menus._form-fields')

        <button class="btn btn-primary" type="submit">Update</button>
    </form>

    @if($menu->links->isEmpty())
        <h2>This menu has no link yet.</h2>
    @else
        <h2>Links</h2>

        <!-- links of the menu -->
        <table-component :data="models">
            <table-column show="text.en" label="Text"></table-column>
            <table-column label="Actions" :filterable="false" :sortable="false">
                <template slot-scope="row">
                    <a :href="row.edit_url">Edit</a>
                    <a href="#" @click.prevent="confirmAndDestroy(row)">Delete</a>
                </template>
            </table-column>
        </table-component>
    @endif

@endsection