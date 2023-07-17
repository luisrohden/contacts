@component('components.form.area')
    <div class="repeater">
        <div class="repeater__content">
            {{$slot}}
        </div>
        {{isset($more)?$more:''}}
        <div class="repeater_actions">
            <div class="repeater__add">
                {{ isset($label) ? $label : 'Adicionar Linha'  }}
            </div>
        </div>
    </div>
@endcomponent
