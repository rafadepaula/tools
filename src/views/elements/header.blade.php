<div class="page-title-heading">
    @if(!empty($icon))
        <div class="page-title-icon">
            <i class="{{$icon}} icon-gradient bg-mean-fruit">
            </i>
        </div>
    @endif
    <div>
        {{$title}}
        <div class="page-title-subheading">
            {{$description ?? null}}
        </div>
    </div>
</div>
@if(!empty($options))
    <div class="page-title-actions">
        @if(isset($options['url']))
            <a href="{{$options['url']}}">
                <button type="button" data-toggle="tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    {{$options['title']}}
                </button>
            </a>
        @else
            <div class="d-inline-block dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Opções
                </button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                    <ul class="nav flex-column">
                        @foreach($options as $option)
                            <li class="nav-item">
                                <a href="{{$option['url']}}" class="nav-link">
                                    <i class="nav-link-icon lnr-inbox"></i>
                                    <span>{{$option['title']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endif