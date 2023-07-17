
@component('components.form.area')
    <label class="form__label">
        <span>{{$label}}</span>
        <select name="{{$name}}" {{ isset($required) && $required ? 'required' : ''}} >
            @if(isset($placeholder))
                <option value="">$placeholder</option>
            @endif
            @foreach ($Options as $optionValue => $optionLabel)
                <option value="{{$optionValue}}" {{isset($value) && $value == $optionValue ? 'selected' : '' }}>{{$optionLabel}}</option>
            @endforeach
        </select>



    </label>
@endcomponent
