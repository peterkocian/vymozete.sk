<template>
    <div>
        <div class="row">
            <div class="col">
                <div class="form-group row">
                    <label for="totalAmount" class="col-sm-2 col-form-label">Celková suma</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="totalAmount" id="totalAmount" :value="config.amount" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-2 col-form-label">Generovanie</label>
                    <div class="col-sm-10">
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
                        <label for="date" class="col-sm-2 col-form-label">Prvá splátka</label>
                        <div class="col-sm-10">
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
                        <label for="amount" class="col-sm-2 col-form-label">Výška splátky</label>
                        <div class="col-sm-10">
                            <input @focusin="blockSave(true)" @focusout="blockSave(false)" class="form-control" type="number" step="0.01" v-model="vyskaSplatky" name="amount" id="amount" min="1" :max="config.amount" @input="vypocitajPocetSplatok()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pocetSplatok" class="col-sm-2 col-form-label">Počet splátok</label>
                        <div class="col-sm-10">
                            <input @focusin="blockSave(true)" @focusout="blockSave(false)" class="form-control" type="number" v-model="pocetSplatok" name="pocetSplatok" id="pocetSplatok" min="1" @input="vypocitajVyskuSplatky()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <button type="button" class="btn btn-primary btn-sm col-form-label" @click="generujSplatky()">Prepočítať</button>
                    </div>
                </div>

                <div v-else-if="type === 'manual'" class="form-group row">
                    <label for="amountDynamic" class="col-sm-2 col-form-label">amount dynamic</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="amountDynamic" id="amountDynamic" :value="amountDynamic" disabled>
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
                                <th>Pc.</th>
                                <th>Datum</th>
                                <th>Splatka</th>
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
                                        :class="errors.hasOwnProperty('dates.'+i) ? 'is-invalid' : null"
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
                                        :class="errors.hasOwnProperty('amounts.'+i) ? 'is-invalid' : null"
                                        placeholder="Suma"
                                        name="amounts[]"
                                        min="0"
                                        step="0.01"
                                        :max="config.amount"
                                        v-model="splatka.amount"
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
                    <button v-if="type === 'manual'" type="button" class="btn btn-primary btn-sm" @click="addElement">Add</button>
                    <a
                        role="button"
                        class="btn btn-success btn-sm"
                        :class="this.disableSaveButton ? 'btn-disabled' : null"
                        v-on:click="handleSubmit()"
                        onclick="this.blur();"
                    >Save</a>
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
                amountDynamic: this.config.amount,
                vyskaSplatky:this.config.amount,
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
                if (this.amountDynamic > 0) {
                    this.splatky.push({});
                } else {
                    flash({text: 'uz sa neda', type:'error', timer:null});
                }
            },
            removeElement(index) {
                this.splatky.splice(index, 1);
            },
            recompute(){
                flash({text: 'Zmeny su zatial neulozene', type:'warning', timer:null })

                this.dates = [];
                this.amounts = [];

                let x = 0;
                this.splatky.forEach(el => {
                    this.dates.push(el.date);
                    this.amounts.push(el.amount);

                    if (el && el.amount) {

                        x +=  Number(el.amount);
                    }
                });
                this.amountDynamic = this.config.amount - x;
            },
            vypocitajVyskuSplatky(){
                this.vyskaSplatky = this.roundToTwo(this.config.amount / this.pocetSplatok)
            },
            vypocitajPocetSplatok(){
                this.pocetSplatok = Math.ceil(this.config.amount / this.vyskaSplatky);
            },
            generujSplatky(){
                this.splatky = [];

                let controla = Math.floor(this.config.amount / this.pocetSplatok);

                if(Number(controla*this.pocetSplatok) === Number(this.config.amount)){
                    for (let i = 0; i < this.pocetSplatok; i++) {
                        this.splatky.push({date:'2020-10-01',amount:this.vyskaSplatky});
                    }
                } else {
                    let last = this.config.amount - Number(this.vyskaSplatky*(this.pocetSplatok-1));

                    for (let i = 0; i < this.pocetSplatok-1; i++) {
                        this.splatky.push({date:'2020-10-01',amount:this.vyskaSplatky});
                    }
                    //posledna splatka custom
                    this.splatky.push({date:'2020-10-01',amount:this.roundToTwo(last)});
                }
            },
            roundToTwo(num) {
                return +(Math.round(num + "e+2")  + "e-2");
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
        },
        watch: {
            splatky() {
                this.recompute();
            }
        }
    }
</script>
