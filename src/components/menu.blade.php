<ul class="vertical-nav-menu">
    @foreach($menus as $text => $menu)
        <li class="{{$headClass}}">{{$text}}</li>
        @foreach($menu as $item)
            @if(isset($item['verification']) && !$item['verification'])
                @continue
            @endif
            <li>
                <a href="@if($item['route']) {{route($item['route'])}} @endif">
                    <i class="{{$iconClass}} {{$item['icon']}}"></i>
                    {{$item['text']}}
                    @if(isset($item['submenus']))
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    @endif
                </a>
                @if(isset($item['submenus']))
                    @foreach($item['submenus'] as $submenu)
                        @if(isset($submenu['verification']) && !$submenu['verification'])
                            @continue
                        @endif
                        <ul>
                            <li>
                                <a href="{{route($submenu['route'])}}">
                                    <i class="{{$iconClass}} {{$submenu['icon'] ?? ''}}"></i>
                                    {{$submenu['text']}}
                                </a>
                            </li>
                        </ul>
                    @endforeach
                @endif
            </li>
        @endforeach
    @endforeach
</ul>