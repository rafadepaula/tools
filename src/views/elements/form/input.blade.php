<label for="{{$name}}">{{$label}} @if(!empty($required))* @endif</label>
<input type="{{$type ?? 'text'}}" class="form-control {{$class ?? ''}}" id="{{$name}}"
       placeholder="{{$label}}" name="{{$name}}" {{$multiple ?? ''}}
       {{$required ?? ''}}
       value="{{old($name) ?? $value ?? ''}}">
<div class="invalid-feedback" style="display: block">
    @error($name)
        <b>{{$message}}</b>
    @enderror
</div>