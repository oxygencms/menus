@extends('oxygencms::admin.layout')

@section('title', 'Edit Link')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-baseline mb-3">
            <h1>Edit Menu</h1>

            <div class="ml-auto d-flex justify-content-end">
                <div>
                    <a href="{{ route('admin.menu.link.create', $menu) }}" class="btn">
                        Add Link <i class="fas fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.menu.update', $menu) }}" method="POST" class="mb-4">
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

        <vue-good-table
                :columns="[
                    {label: 'Text', field: `text.${locale}`},
                    {label: 'Actions', field: 'actions', width: '100px', globalSearchDisabled: false, sortable: false},
                ]"
                :rows="models"
                :search-options="{enabled: true}"
                :pagination-options="{enabled: true}"
        >
            <template slot="table-row" slot-scope="props">
            <span v-if="props.column.label === 'Actions'" class="action-links">
                <a :href="props.row.edit_url" title="Edit">edit</a>

                <a @click.prevent="confirmAndDestroy(props.row)" href="#" title="Delete">
                    delete
                </a>
            </span>

                <span v-else v-text="props.formattedRow[props.column.field]"></span>
            </template>
        </vue-good-table>

        {{--<table-component :data="models">--}}
            {{--<table-column show="text.en" label="Text"></table-column>--}}
            {{--<table-column label="Actions" :filterable="false" :sortable="false">--}}
                {{--<template slot-scope="row">--}}
                    {{--<a :href="row.edit_url">Edit</a>--}}
                    {{--<a href="#" @click.prevent="confirmAndDestroy(row)">Delete</a>--}}
                {{--</template>--}}
            {{--</table-column>--}}
        {{--</table-component>--}}
    @endif

@endsection