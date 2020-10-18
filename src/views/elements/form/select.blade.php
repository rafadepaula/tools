<label for="{{$name}}">{{$label}} @if(!empty($required))* @endif</label>
<select class="form-control {{$atts['class'] ?? ''}}" id="{{$atts['id'] ?? $name}}"
        name="{{$name}}@if(isset($atts['multiple']))[] @endif"
        @foreach($atts as $att => $valAtt)
            @if($att != 'id' && $att != 'class')
                {{$att}}="{{$valAtt}}"
            @endif
        @endforeach >
    @foreach($options as $valueOpt => $label)
        <option
            value="{{$valueOpt}}"
            @if(is_array(old($name)) && in_array($valueOpt, old($name)))
                selected
            @else
                @if(is_array($value) && in_array($valueOpt, $value))
                    selected
                @else
                    @if(!empty(old($name)) && old($name) == $valueOpt)
                        selected
                    @else
                        @if($valueOpt == $value)
                            selected
                        @endif
                    @endif
                @endif
            @endif
        >
            {{$label}}
        </option>
    @endforeach
</select>
<div class="invalid-feedback">
    <!-- ver erros !-->
</div>