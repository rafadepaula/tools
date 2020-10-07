<label for="{{$name}}">{{$label}} @if(!empty($required))* @endif</label>
<select class="form-control {{$class ?? ''}}" id="{{$name}}"
        name="{{$name}}@if(!empty($multiple))[] @endif"
        {{$required ?? ''}}
        {{$multiple ?? ''}}>
    @foreach($options as $valueOpt => $label)
        <option
            value="{{$valueOpt}}"
            @if(is_array(old($name)) && in_array($valueOpt, old($name)))
                selected
            @else
                @if(is_array($value) && in_array($valueOpt, $value))
                    selected
                @else
                    @if(old($name) == $valueOpt)
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