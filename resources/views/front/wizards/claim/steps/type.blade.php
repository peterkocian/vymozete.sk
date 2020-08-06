<div class="">
    <div class="form_box">
        <p>Vyberte zo zoznamu typ pohľadávky.</p>
        <div class="group">
            <label>typ pohľadávky *</label>
            <select name="claim_type">
                <option value="">vyberte...</option>
                @foreach ($step->getClaimTypes() as $option)
                    <option value="{{ $option->id }}" @if($step->data('claim_type') == $option->id)selected="selected"@endif>{{ $option->translation(\Illuminate\Support\Facades\Auth::user()->language_id)->firstOrFail()->name }}</option>
                @endforeach
            </select>
            @error('claim_type')
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
