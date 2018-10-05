@extends('oxygencms::admin.layout')

@section('title', 'Menus')

@section('content')

    <div class="row">
        <div class="col-12 d-flex align-items-baseline mb-3">
            <h1>Menus</h1>

            <div class="ml-auto d-flex justify-content-end">
                <div>
                    <a href="{{ route('menu.create') }}" class="btn">
                        Create <i class="far fa-edit"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <table-component :data="models">
        {{--<table-column show="online" label="Online" :filterable="false">--}}
            {{--<template slot-scope="row">--}}
                {{--<input type="checkbox"--}}
                       {{--@click.prevent="toggleActiveAttribute(row)"--}}
                       {{--:checked="row.active"--}}
                {{-->--}}
            {{--</template>--}}
        {{--</table-column>--}}
        <table-column show="name" label="Name"></table-column>
        <table-column label="Actions" :filterable="false" :sortable="false">
            <template slot-scope="row">
                <a :href="row.edit_url">edit</a>
                <a href="#" @click.prevent="confirmAndDestroy(row)">delete</a>
            </template>
        </table-column>
    </table-component>

@endsection