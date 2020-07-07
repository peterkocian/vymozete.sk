<div class="">
    <div class="form_box">
        <p>Vyberte zo zoznamu typ pohľadávky.</p>
        <div class="group">
{{--            <select name="claim_type" class="@error('claim_type') is-invalid @enderror">--}}
            <select name="claim_type">
                <option value="">vyberte...</option>
                @foreach ($step->getClaimTypes() as $option)
                    <option value="{{ $option['id'] }}" @if($step->data('claim_type') == $option['id'])selected="selected"@endif>{{ $option['name'] }}</option>
                @endforeach
            </select>
            @error('claim_type')
                <span class="validation-error">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
