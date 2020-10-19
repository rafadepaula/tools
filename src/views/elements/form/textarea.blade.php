<label for="{{$name}}">{{$label}} @if(!empty($atts['required']))* @endif</label>
<textarea class="form-control {{$atts['class'] ?? ''}}" id="{{$atts['id'] ?? $name}}"
          name="{{$name}}"
        @foreach($atts as $att => $valAtt)
                @if($att != 'id' && $att != 'class')
                        {{$att}}="{{$valAtt}}"
                @endif
        @endforeach>{{old($name) ?? $value ?? ''}}</textarea>
<div class="invalid-feedback" style="display: block">
    @error($name)
        <b>{{$message}}</b>
    @enderror
</div>