@extends('layouts.main')
@section('title')
    Cadastro - Administradores
@endsection
@section('header')
    @include(
        'elements.header',
        [
            'icon' => 'pe-7s-users', 'title' => 'Cadastro - Administradores',
            'options' => ['title' => 'Voltar para listagem', 'url' => route('user_index')]
        ]
    )
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">
                        @if(empty($user->id))
                            Cadastrar administrador
                        @else
                            Atualizar cadastro de administrador
                        @endif
                    </h5>
                    <form action="{{route('user_save', $user->id ?? null)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                @include(
                                    'elements.form.input',
                                     [
                                     	'label' => 'E-mail', 'name' => 'email',
                                        'value' => $user->email ?? null,
                                        'required' => 'required',
                                        'type' => 'email'
                                    ]
                                 )
                            </div>
                            <div class="col-md-6">
                                @include(
                                    'elements.form.select',
                                     [
                                     	'label' => 'Tipo', 'name' => 'type',
                                        'value' => $user->type ?? null,
                                        'required' => 'required',
                                        'options' => ['A' => 'Administrador', 'M' => 'Moderador']
                                    ]
                                 )
                            </div>
                            <div class="col-md-6">
                                @include(
                                    'elements.form.input',
                                    [
                                    	'label' => 'Senha', 'name' => 'password','type' => 'password',
                                        'required' => empty($user->id) ? 'required' : null]
                                 )
                            </div>
                            <div class="col-md-6">
                                @include(
                                    'elements.form.input',
                                    [
                                    	'label' => 'Confirme sua senha',
                                    	'name' => 'password_confirmation',
                                    	'required' => empty($user->id) ? 'required' : null,
                                    	'type' => 'password']
                                 )
                            </div>
                        </div>
                        @include('elements.form.submit')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection