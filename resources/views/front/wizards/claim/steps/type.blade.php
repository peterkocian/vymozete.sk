<div class="">
    <div class="form_box">
        <p>Vyberte zo zoznamu typ pohľadávky.</p>
        <div class="group">
            <label>typ pohľadávky *</label>
            <select name="claim_type_id">
                <option value="">@lang('general.Choose')</option>
                @foreach ($step->getClaimTypes() as $option)
                    @if(request()->get('claim_type_id'))
                        <!-- ak su data z query params pri presmerovani z homepage s prednastavenou value -->
                        <option value="{{ $option['id'] }}" @if(request()->get('claim_type_id') == $option['id'])selected="selected"@endif>{{ $option['value'] }}</option>
                    @else
                        <!-- ak su data vramci cache form wizardu -->
                        <option value="{{ $option['id'] }}" @if($step->data('claim_type_id') == $option['id'])selected="selected"@endif>{{ $option['value'] }}</option>
                    @endif
                @endforeach
            </select>
            @error('claim_type_id')
                <span class="validation-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="group">
            <div class="row">
                <i>* označuje povinné údaje</i>
            </div>
        </div>
    </div>
</div>
