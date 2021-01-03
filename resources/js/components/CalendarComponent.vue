<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="form-group row">
                    <label for="totalAmount" class="col-sm-4 col-md-3 col-form-label">Celková suma ({{config.currency}})</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="totalAmount" id="totalAmount" :value="config.amount" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-4 col-md-3 col-form-label">Generovanie</label>
                    <div class="col-sm-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="automatic" value="automatic" v-model="type">
                            <label class="form-check-label" for="automatic">automatické</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="manual" value="manual" v-model="type">
                            <label class="form-check-label" for="manual">manuálne</label>
                        </div>
                    </div>
                </div>
                <div v-if="type === 'automatic'">
                    <div class="form-group row">
                        <label for="date" class="col-sm-4 col-md-3 col-form-label">Prvá splátka</label>
                        <div class="col-sm-4">
                            <date-picker
                                v-model="startDate"
                                :lang="lang"
                                format="DD.MM.YYYY"
                                value-type="YYYY-MM-DD"
                                type="date"
                                name="date"
                                id="date"
                                input-class="form-control"
                                :input-attr="{name: ''}"
                                placeholder="DD.MM.RRRR"
                            ></date-picker>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-4 col-md-3 col-form-label">Výška splátky ({{config.currency}})</label>
                        <div class="col-sm-4">
                            <input @focusin="blockSave(true)" @focusout="blockSave(false)" class="form-control" type="number" step="0.01" v-model.number="vyskaSplatky" name="amount" id="amount" min="1" :max="config.amount" @input="vypocitajPocetSplatok()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pocetSplatok" class="col-sm-4 col-md-3 col-form-label">Počet splátok</label>
                        <div class="col-sm-4">
                            <input @focusin="blockSave(true)" @focusout="blockSave(false)" class="form-control" type="number" v-model.number="pocetSplatok" name="pocetSplatok" id="pocetSplatok" min="1" @input="vypocitajVyskuSplatky()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <button
                            type="button"
                            class="btn btn-primary btn-sm col-form-label"
                            @click="generujSplatky()"
                        >Prepočítať</button>
                    </div>
                </div>

                <div v-else-if="type === 'manual'" class="form-group row">
                    <label for="amountCheckSum" class="col-sm-4 col-md-3 col-form-label">Zostatok</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="amountCheckSum" id="amountCheckSum" :value="amountCheckSum" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form>
                    <table class="table table-striped table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Pč.</th>
                                <th>Dátum</th>
                                <th>Splátka ({{config.currency}})</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(splatka,i) in splatky" :key="splatka.id">
                                <td class="align-middle">{{i+1}}.</td>
                                <td class="align-middle">
                                    <date-picker
                                        v-model="splatka.date"
                                        :lang="lang"
                                        format="DD.MM.YYYY"
                                        value-type="YYYY-MM-DD"
                                        :key="i"
                                        type="date"
                                        name="dates[]"
                                        :class="{'is-invalid': errors.hasOwnProperty('dates.'+i)}"
                                        input-class="form-control"
                                        :input-attr="{name: ''}"
                                        placeholder="DD.MM.RRRR"
                                        :disabled="type==='automatic'"
                                        @change="recompute()"
                                    ></date-picker>
                                    <div v-if="errors.hasOwnProperty('dates.'+i)" class="invalid-feedback">
                                        <div v-for="message in errors['dates.'+i]">{{ message }}</div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input
                                        :key="i"
                                        type="number"
                                        class="form-control"
                                        :class="{'is-invalid': errors.hasOwnProperty('amounts.'+i)}"
                                        placeholder="Suma"
                                        name="amounts[]"
                                        min="0"
                                        step="0.01"
                                        :max="config.amount"
                                        v-model.number="splatka.amount"
                                        @change="recompute()"
                                        :disabled="type==='automatic'"
                                    >
                                    <div v-if="errors.hasOwnProperty('amounts.'+i)" class="invalid-feedback">
                                        <div v-for="message in errors['amounts.'+i]">{{ message }}</div>
                                    </div>
                                </td>
                                <td>
                                    <a v-if="type === 'manual'" role="button" title="Vymazať" class="btn btn-sm btn-outline-danger" @click="removeElement(i)">
                                        <span class="material-icons">delete</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button v-if="type === 'manual'" type="button" class="btn btn-primary btn-sm" @click="addElement">Pridať</button>
                    <a
                        role="button"
                        class="btn btn-success btn-sm"
                        :class="{'btn-disabled': this.disableSaveButton || this.amountCheckSum >= 1 }"
                        v-on:click="handleSubmit()"
                        onclick="this.blur();"
                    >Uložiť</a>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import * as lang from "../datepicker_language";

    export default {
        props: ['config'],
        mounted() {
            this.dates = [];
            this.amounts = [];

            this.config.splatky.forEach(el => {
                this.dates.push(el.date);
                this.amounts.push(el.amount);
            });
        },
        data() {
            return {
                type: 'automatic',
                disableSaveButton: null,
                amountCheckSum: this.setCheckSum(),
                vyskaSplatky: this.config.amount,
                pocetSplatok:1,
                startDate: null,
                lang: lang.slovak(),
                splatky: this.config.splatky,
                dates: [],
                amounts: [],
                errors: {}
            }
        },
        methods: {
            blockSave(state) {
                this.disableSaveButton = state;
            },
            addElement() {
                if (this.amountCheckSum > 0) {
                    this.splatky.push({});
                } else {
                    flash({text: 'Zostatok je 0. Už sa nedá pridať splátku.', type:'error', timer:null});
                }
            },
            removeElement(index) {
                this.splatky.splice(index, 1);
            },
            recompute(){
                flash({text: 'Zmeny zatiaľ nie sú uložené', type:'warning', timer:null})

                this.dates = [];
                this.amounts = [];

                let checkSum = 0;
                this.splatky.forEach(el => {
                    this.dates.push(el.date);
                    this.amounts.push(el.amount);

                    if (el && el.amount) {
                        checkSum +=  Number(el.amount);
                    }
                });
                this.amountCheckSum = this.config.amount - checkSum;
            },
            vypocitajVyskuSplatky(){
                this.vyskaSplatky = this.roundToTwo(this.config.amount / this.pocetSplatok);
            },
            vypocitajPocetSplatok(){
                this.pocetSplatok = Math.ceil(this.config.amount / this.vyskaSplatky);
            },
            vypocitajDatumSplatky(cisloSplatky) {
                const start = new Date(this.startDate);
                const month = start.getMonth();
                start.setMonth(start.getMonth() + Number(cisloSplatky));

                cisloSplatky = cisloSplatky % 12; // osetrenie, aby kazde cislo splatky malo poradove cislo mesiaca v roku...aby to neboli cisla 23 a podobne

                let newMonth = this.checkOverTheYear(start.getMonth(), month, cisloSplatky);
                while (newMonth - (month + Number(cisloSplatky)) >= 1 ) {
                    start.setDate(start.getDate() - 1);
                    newMonth = this.checkOverTheYear(start.getMonth(), month, cisloSplatky);
                }

                if(start.getUTCHours() === 23) {
                    start.setHours(start.getHours() + 1);
                }

                return start.toISOString();
            },
            checkOverTheYear(newMonth, originMonth, cisloSplatky) {
                if(newMonth < (originMonth + Number(cisloSplatky))) {
                    return newMonth + 12;
                } else {
                    return newMonth;
                }
            },
            generujSplatky(){
                if (this.startDate === null) {
                    return flash({text: 'Nedá sa generovať. Nie je nastavený dátum prvej splátky.', type:'error', timer:null});
                }
                this.splatky = [];
                let remainder = this.config.amount % this.vyskaSplatky;

                if(remainder === 0){
                    for (let i = 0; i < this.pocetSplatok; i++) {
                        this.pridajSplatku(i,this.vyskaSplatky)
                    }
                } else {
                    for (let i = 0; i < this.pocetSplatok-1; i++) {
                        this.pridajSplatku(i,this.vyskaSplatky)
                    }
                    //posledna splatka custom. inak sa pocita posledna pre n-tu splatku a inak pre 2-hu splatku
                    if (remainder < 1 && this.splatky.length > 1) {
                        remainder = this.vyskaSplatky+remainder;
                    }
                    this.pridajSplatku(this.pocetSplatok-1,remainder)
                }
            },
            pridajSplatku(i, amount) {
                this.splatky.push({
                    date:this.vypocitajDatumSplatky(i),
                    amount:this.roundToTwo(amount)
                });
            },
            roundToTwo(num) {
                // return +(Math.round(num + "e+2")  + "e-2");
                return parseFloat(num.toFixed(2));
            },
            handleSubmit() {
                axios.post(`/admin/claims/${this.config.claim_id}/calendar`, {
                    'dates': this.dates,
                    'amounts': this.amounts
                })
                    .then(res => {
                        this.errors = {};
                        flash({text: res.data.message, type:'success', timer:3000 });
                    }).catch(e => {
                        this.errors = e.response.data.errors;
                        flash({text: e.response.data.message, type:'error', timer:null });
                    });
            },
            setCheckSum(){
                return this.config.sum ? (this.config.amount-this.config.sum) : this.config.amount;
            },
        },
        watch: {
            splatky() {
                this.recompute();
                if (this.amountCheckSum < 0) {
                    this.amountCheckSum = 0;
                } else {
                    this.amountCheckSum = this.amountCheckSum.toFixed(2);
                }
            }
        }
    }
</script>
