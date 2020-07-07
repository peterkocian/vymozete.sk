<template>
    <div class="">
        <div class="form_box">
            <p>Zadajte dlžnú sumu (istiny) bez úrokov.</p>
            <br>

            <div class="group">
                <label for="suma">dlžná suma (istina) *</label>
                <input v-model="formData.amount" id="suma" name="amount" type="number" step="0.01" required>
                <span class="bar"></span>
            </div>

            <p>Zadajte dátum splatnosti dlhu (kedy mal byť dlh najneskôr vyrovnaný).</p>

            <div class="group">
                <input type="hidden" name="paymentDueDate" :value="formData.paymentDueDate">
                <label>dátum splatnosti *</label>
                <date-picker
                    v-model="formData.paymentDueDate"
                    :lang="lang"
                    format="DD.MM.YYYY"
                    value-type="YYYY-MM-DD"
                    type="date"
                    input-class=""
                    :input-attr="{name: '', required: 'required'}"
                    placeholder="DD.MM.RRRR"
                    :popup-style="{left: 0, top: '100%'}"
                    :append-to-body="false"
                ></date-picker>
            </div>

            <div class="group description">
                <label for="desc">Popíšte prosím škodovú udalosť</label>
                <textarea id="desc" v-model="formData.description" name="description"></textarea>
            </div>

            <p>Nahrajte dokumenty</p>

            <div class="group add-files">
                <button type="button" title="Pridať ďalší súbor"><i class="material-icons">playlist_add</i></button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['config'],
        mounted() {
            this.setDefaultFormData();
        },
        data() {
            let stepData = {...this.config.stepData};

            return {
                formData: {},
                stepData,
                lang: {
                    formatLocale: {
                        firstDayOfWeek: 1,
                    }
                },
            }
        },
        methods: {
            setDefaultFormData() {
                this.formData = {...this.stepData};
            },
        }
    };
</script>
