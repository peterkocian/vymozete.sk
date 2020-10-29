<template>
    <div class="">
        <div class="form_box">
            <p>Zadajte dlžnú sumu (istiny) bez úrokov.</p>
            <br>

            <div class="group currency">
                <label for="suma">dlžná suma (istina) *</label>
                <input v-model="formData.amount" class="c-input" id="suma" name="amount" type="number" step="0.01">
                <select class="c-selectbox" name="currency_id" v-model="formData.currency_id">
                    <option v-for="currency in config.currencies" :value="currency.id">{{currency.code}}</option>
                </select>
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('amount')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.amount">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>typ pohľadávky *</label>
                <select class="c-selectbox" name="claim_type_id" v-model="formData.claim_type_id">
                    <option v-for="claimType in config.claimTypes" :value="claimType.id" :for="claimType.id">{{claimType.value}}</option>
                </select>
                <span v-if="this.config.validationErrors.hasOwnProperty('claim_type_id')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.claim_type_id">{{ message }}</div>
                </span>
            </div>

            <p>Zadajte dátum splatnosti dlhu (kedy mal byť dlh najneskôr uhradený).</p>

            <div class="group">
                <input type="hidden" name="payment_due_date" :value="formData.payment_due_date">
                <label>dátum splatnosti *</label>
                <date-picker
                    v-model="formData.payment_due_date"
                    :lang="lang"
                    format="DD.MM.YYYY"
                    value-type="YYYY-MM-DD"
                    type="date"
                    input-class=""
                    :input-attr="{name: ''}"
                    placeholder="DD.MM.RRRR"
                    :popup-style="{left: 0, top: '100%'}"
                    :append-to-body="false"
                ></date-picker>
                <span v-if="this.config.validationErrors.hasOwnProperty('payment_due_date')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.payment_due_date">{{ message }}</div>
                </span>
            </div>

            <div class="group description">
                <label for="desc">popíšte prosím vznik pohľadávky</label>
                <textarea id="desc" v-model="formData.description" name="description"></textarea>
            </div>

            <div class="group">
                <div class="row">
                    <i>* označuje povinné údaje</i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import * as lang from "../datepicker_language";

    export default {
        props: ['config'],
        mounted() {
            this.setDefaultFormData();
        },
        data() {
            let stepData = this.config.stepData;

            return {
                formData: { currency_id:1 },
                stepData,
                lang: lang.slovak(),
            }
        },
        methods: {
            setDefaultFormData() {
                if (this.stepData instanceof Object) {
                    this.formData = {...this.stepData};
                }
            },
        }
    };
</script>
