<label for="{{$name}}">
    {{$label}} @if(!empty($atts['required']))* @endif
</label>
<input type="{{$type ?? 'text'}}" class="form-control {{$atts['class'] ?? ''}}" 
        id="{{$atts['id'] ?? $name}}" placeholder="{{$label}}" name="{{$name}}"
       @foreach($atts as $att => $valAtt)
            @if($att != 'id' && $att != 'class')
                {{$att}}="{{$valAtt}}"
            @endif
       @endforeach 
       value="{{old($name) ?? $value ?? ''}}">
<div class="invalid-feedback" style="display: block">
    @error($name)
        <b>{{$message}}</b>
    @enderror
</div>