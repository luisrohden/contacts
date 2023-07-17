
@component('components.form.area')
    <label class="form__label">
        <span>{{$label}}</span>
        <input
            type="{{$type}}"
            name="{{$name}}"
            @if(isset($placeholder))
                placeholder="{{$placeholder}}"
            @endif
            @if(isset($required) && $required)
                required
            @endif
            @if(isset($value))
                value="{{$value}}"
            @endif

        />
    </label>
@endcomponent
