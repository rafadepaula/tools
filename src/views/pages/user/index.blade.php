@extends('layouts.main')
@section('title')
    Administradores
@endsection
@section('header')
    @include(
        'elements.header',
        [
            'icon' => 'pe-7s-users', 'title' => 'Administradores',
            'description' => 'Administradores e moderadores cadastrados',
            'options' => ['title' => 'Cadastrar novo', 'url' => route('user_add')]
        ]
    )
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Administradores cadastrados</h5>
                    @include('elements.table', $users)
                </div>
            </div>
        </div>
    </div>
@endsection