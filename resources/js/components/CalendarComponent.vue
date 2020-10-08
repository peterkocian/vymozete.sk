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
                            <input type="date" class="form-control" name="date" id="date">
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

<!--        <installments-component-->
<!--            :splatkyPreset="config.splatky"-->
<!--            :vyskaSplatky="vyskaSplatky"-->
<!--            :pocetSplatok="pocetSplatok"-->
<!--            :formPost = "`/admin/claims/${config.claim_id}/calendar`"-->
<!--            :suma = "config.amount"-->
<!--            :variant = "type"-->
<!--        ></installments-component>-->

        <div class="row">
            <div class="col">
                <form :action="`/admin/claims/${config.claim_id}/calendar`" method="POST">
                    <input type="hidden" name="_token" :value="csrf">

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
                                    <input
                                        :key="i"
                                        type="date"
                                        class="form-control"
                                        :class="config.validationErrors.hasOwnProperty('dates.'+i) ? 'is-invalid' : null"
                                        name="dates[]"
                                        v-model="splatka.date">
<!--                                        :disabled="type==='automatic'"-->
<!--                                    >-->
                                    <div v-if="config.validationErrors.hasOwnProperty('dates.'+i)" class="invalid-feedback">
                                        <div v-for="message in config.validationErrors['dates.1']">{{ message }}</div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <input
                                        :key="i"
                                        type="number"
                                        class="form-control"
                                        :class="config.validationErrors.hasOwnProperty('amounts.'+i) ? 'is-invalid' : null"
                                        placeholder="Suma"
                                        name="amounts[]"
                                        min="0"
                                        step="0.01"
                                        :max="config.amount"
                                        v-model="splatka.amount"
                                        @change="recompute()">
<!--                                        :disabled="type==='automatic'"-->
<!--                                    >-->
                                    <div v-if="config.validationErrors.hasOwnProperty('amounts.'+i)" class="invalid-feedback">
                                        <div v-for="message in config.validationErrors['amounts.'+i]">{{ message }}</div>
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
                    <button
                        type="submit"
                        class="btn btn-success btn-sm"
                        :class="this.disableSaveButton ? 'btn-disabled' : null"
                    >Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                type: 'automatic',
                // elements: [{}],
                // elements: this.config.splatky,
                disableSaveButton: null,
                amountDynamic: this.config.amount,
                vyskaSplatky:this.config.amount,
                pocetSplatok:1,
                splatky: this.config.splatky,
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
                let x = 0;
                this.splatky.forEach(el => {
                    if (el && el.amount) {

                        x +=  Number(el.amount);
                    }
                });
                // console.log(x);
                this.amountDynamic = this.config.amount - x;
            },
            vypocitajVyskuSplatky(){
                this.vyskaSplatky = this.roundToTwo(this.config.amount / this.pocetSplatok)
                // let result = this.config.amount / this.pocetSplatok;
                // this.vyskaSplatky = result.toFixed(2);
                // this.vyskaSplatky = Math.round(this.config.amount / this.pocetSplatok * 100) / 100;
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
                    // console.log('last',last.toFixed(2));

                    for (let i = 0; i < this.pocetSplatok-1; i++) {
                        this.splatky.push({date:'2020-10-01',amount:this.vyskaSplatky});
                    }
                    //posledna splatka custom
                    this.splatky.push({date:'2020-10-01',amount:this.roundToTwo(last)});
                }
            },
            roundToTwo(num) {
                return +(Math.round(num + "e+2")  + "e-2");
            }
        },
        watch: {
            splatky() {
                this.recompute();
            }
        }
    }
</script>
