<div class="mainbox">
    <div class="form_box">
        <p>Zadajte dlžnú sumu (istiny) bez úrokov.</p>
        <br>

        <div class="group">
            <label for="suma">dlžná suma (istina) *</label>
            <input id="suma" name="amount" type="number" step="0.01" value="0" required="required">
            <span class="bar"></span>
        </div>

        <p>Zadajte dátum splatnosti dlhu (kedy mal byť dlh najneskôr vyrovnaný).</p>

        <div class="group">
            <div class="label">dátum splatnosti *</div>
            <input id="datum_splatnosti" name="paymentDueDate" required="required" type="date" value=""
                   pattern="^\d{2}\.\d{2}\.\d{4}$" oninvalid="this.setCustomValidity('Zadajte dátum vo formáte DD-MM-YYYY')">
{{--            <div class="datepicker-here"></div>--}}
        </div>

        <div class="group description">
            <div>Popíšte prosím škodovú udalosť:</div>
            <textarea name="description">xxx</textarea>
        </div>

        <p>Nahrajte dokumenty</p>

        <div class="group add-files">
            <button type="button" title="Pridať ďalší súbor"><i class="material-icons">playlist_add</i></button>
        </div>
    </div>
</div>
