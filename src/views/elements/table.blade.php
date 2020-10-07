{{-- --}}
<div class="table-responsive row">
    <table class="mb-0 table table-striped table-bordered dataTable datatable-init">
        <thead>
            <tr>
                @foreach($headers as $header)
                    @if(is_array($header))
                        <th class="{{$header[1]}}">{{$header[0]}}</th>
                    @else
                        <th>{{$header}}</th>
                    @endif
                @endforeach
                @if(isset($options))
                    <th>Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    @foreach($row as $column => $info)
                        @if($column !== '_id')
                            <td>{{$info}}</td>
                        @endif
                    @endforeach
                    @if(isset($options))
                        <td>
                        @foreach($options as $option)
                            <a href="{{route($option['route'], $row['_id'])}}"
                                @if(!empty($option['confirm'])) onclick="return confirm('Confirma a ação?');" @endif>
                                <button class="btn btn-outline-dark {{$option['class'] ?? ''}}">
                                    {{$option['label']}}
                                </button>
                            </a>
                        @endforeach
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>