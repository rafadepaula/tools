<ul class="vertical-nav-menu">
    @foreach($menus as $text => $menu)
        <li class="{{$headClass}}">{{$text}}</li>
        @foreach($menu as $item)
            <li>
                <a href="{{route($item['route'])}}">
                    <i class="{{$iconClass}} {{$item['icon']}}"></i>
                    {{$item['text']}}
                </a>
            </li>
        @endforeach
    @endforeach
</ul>