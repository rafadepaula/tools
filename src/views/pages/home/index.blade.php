@extends('layouts.main')
@section('title') Dashboard @endsection
@section('header')
    @include(
        'elements.header',
        ['icon' => 'pe-7s-home', 'title' => 'Portal Serra Gaúcha', 'description' => 'Página de resumo']
    )
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Newsletter</div>
                        <div class="widget-subheading">Registros de newsletter não exportados</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>0</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Nº de Publicações</div>
                        <div class="widget-subheading">Notícias, serra gaúcha, eventos, roteiros e vivências</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">0</div>
                    </div>
                </div>
            </div>
        </div>
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
        <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection