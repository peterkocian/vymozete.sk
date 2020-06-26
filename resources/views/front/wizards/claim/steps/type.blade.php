<div class="">
    <div class="form_box">
        <p>Vyberte zo zoznamu typ pohľadávky.</p>
        <div class="group">
            <select name="claim_type">
                <option value="">Select...</option>
                @foreach ($step->getClaimTypes() as $option)
                    <option value="{{ $option['id'] }}" @if($step->data('claim_type') == $option['id'])selected="selected"@endif>{{ $option['name'] }}</option>
                @endforeach
            </select>
            <b-form-datepicker id="datepicker-placeholder" placeholder="Choose a date" local="en"></b-form-datepicker>
        </div>
    </div>
</div>
