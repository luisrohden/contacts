
@component('components.form.area')
    <label class="form__label">
        <span>{{$label}}</span>
        <textarea
            name="{{$name}}"
            @if(isset($placeholder))
                placeholder="{{$placeholder}}"
            @endif
            @if(isset($required) && $required)
                required
            @endif
        >{{isset($value) ? $value : ''}}</textarea>
    </label>
@endcomponent
