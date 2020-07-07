@php
    $config = [
        'stepData' => $step->data(),
    ];
    if($step->data('paymentDueDate')){
        $config['stepData']['paymentDueDate'] = \Carbon\Carbon::parse($config['stepData']['paymentDueDate'])->format('Y-m-d');
    }
@endphp
<debt-component :config="{{ json_encode($config) }}"></debt-component>

{{--<div class="mainbox">--}}
{{--    <div class="form_box">--}}
{{--        <p>Zadajte dlžnú sumu (istiny) bez úrokov.</p>--}}
{{--        <br>--}}

{{--        <div class="group">--}}
{{--            <label for="suma">dlžná suma (istina) *</label>--}}
{{--            <input id="suma" name="amount" type="number" step="0.01" value="0" required="required">--}}
{{--            <span class="bar"></span>--}}
{{--        </div>--}}

{{--        <p>Zadajte dátum splatnosti dlhu (kedy mal byť dlh najneskôr vyrovnaný).</p>--}}

{{--        <div class="group">--}}
{{--            <label for="datum_splatnosti">dátum splatnosti *</label>--}}
{{--            <date-picker--}}
{{--                value="value"--}}
{{--                type="date"--}}
{{--                input-class=""--}}
{{--                :input-attr="{id: 'datum_splatnosti', name: 'paymentDueDate', required: 'required'}"--}}
{{--                placeholder="DD.MM.RRRR"--}}
{{--                :popup-style="{left: 0, top: '100%'}"--}}
{{--                :append-to-body="false"--}}
{{--            ></date-picker>--}}
{{--        </div>--}}

{{--        <div class="group description">--}}
{{--            <label for="datum_splatnosti">Popíšte prosím škodovú udalosť</label>--}}
{{--            <textarea name="description">xxx</textarea>--}}
{{--        </div>--}}

{{--        <p>Nahrajte dokumenty</p>--}}

{{--        <div class="group add-files">--}}
{{--            <button type="button" title="Pridať ďalší súbor"><i class="material-icons">playlist_add</i></button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
