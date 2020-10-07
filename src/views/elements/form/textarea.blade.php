<label for="{{$name}}">{{$label}} @if(!empty($required))* @endif</label>
<textarea class="form-control {{$class ?? ''}}" id="{{$name}}"name="{{$name}}" rows="{{$rows ?? ''}}"
        {{$required ?? ''}}>{{old($name) ?? $value ?? ''}}</textarea>
<div class="invalid-feedback" style="display: block">
    @error($name)
        <b>{{$message}}</b>
    @enderror
</div>