@if(!empty($model->id) && isset($model->gallery) && $model->gallery()->exists())
    @if($model->gallery->medias()->where('type', 'F')->exists())
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Gerenciar arquivos
                        </h5>
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Arquivo</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($model->gallery->medias()->where('type', 'F')->get() as $media)
                                        <tr>
                                            <td>
                                                <a href="{{$media->content_url}}" target="_blank">
                                                    {{$media->title ?? $media->content}}
                                                </a>
                                            </td>
                                            <td>
                                                <p class="delete-media"
                                                   data-type="file"
                                                   data-route="{{route($route.'_delete_media', ['media_id' => $media->id])}}">
                                                    Deletar <span class="fa fa-trash"></span>
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($model->gallery->medias()->where('type', 'I')->exists())
        <div class="row">
            <div class="col-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Gerenciar imagens
                        </h5>
                        <div class="row">
                            @foreach($model->gallery->medias()->where('type', 'I')->get() as $media)
                                <div class="col-sm-4 col-xs-6" style="margin-bottom: 25px">
                                    <img src="{{$media->content_url}}"
                                         style="max-height: 200px; width: auto; margin: 0 auto; display: block">
                                    <p class="delete-media text-center"
                                       data-route="{{route($route.'_delete_media', ['media_id' => $media->id])}}">
                                        Deletar <span class="fa fa-trash"></span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif