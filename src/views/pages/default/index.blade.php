@extends('layouts.main')
@section('title')
    {{$title}}
@endsection
@section('header')
    @include(
        'elements.header',
        [
            'icon' => $icon, 'title' => $title,
            'description' => '',
            'options' => $options
        ]
    )
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Listagem de {{$title}}</h5>
                    @include('elements.table', $table)
                </div>
            </div>
        </div>
    </div>
@endsection