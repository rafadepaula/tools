@extends('layouts.main')
@section('title')
    {{$title}}
@endsection
@section('header')
    @include(
        'elements.header',
        [
            'icon' => $icon, 'title' => $title,
            'options' => $options
        ]
    )
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$title}}
                    </h5>
                    <form action="{{route($route, $model->id ?? null)}}" method="post">
                        @csrf
                        @foreach($fields as $row)
                            <div class="row">
                                @foreach($row as $field)
                                    <div class="{{$field['size']}} form-group">
                                        @if($field['type'] == 'select')
                                            @include('elements.form.select', $field)
                                        @elseif($field['type'] == 'textarea')
                                            @include('elements.form.textarea', $field)
                                        @else
                                            @include('elements.form.input', $field)
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        @include('elements.form.submit')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection