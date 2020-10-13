@extends('layouts.main')
@section('title') Dashboard @endsection
@section('header')
    @include(
        'elements.header',
        ['icon' => 'pe-7s-home', 'title' => Config::get('app.name'), 'description' => 'Página de resumo']
    )
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-grow-early">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Mídias armazenadas</div>
                        <div class="widget-subheading">Espaço alocado no servidor por fotos/arquivos</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">0 MB</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection