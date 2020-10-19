<template>
    <div class="">
        <div class="form_box">
            <p>{{ config.subtitle }}</p>
            <br>

<!--            nacitanie dlznika z predoslych pohladavok-->
<!--            <div class="group" style="<?= count($participantsList) == 0 ? 'display: none;' : '' ?>">-->
<!--                <select class="subjekt" name="debtor[id]">-->
<!--                    <option value="0">nový</option>-->
<!--                    <? foreach ($participantsList as $id => $name): ?>-->
<!--                    <option value="<?= $id ?>" <?= $idDebtor == $id ? 'selected' : '' ?>><?= $name ?></option>-->
<!--                    <? endforeach; ?>-->
<!--                </select>-->
<!--                <span class="highlight"></span>-->
<!--                <span class="bar"></span>-->
<!--                <label>vyberte dlžníka</label>-->
<!--                <span class="arrow">&#x25BC;</span>-->
<!--            </div>-->

            <div class="group">
                <label>typ osoby *</label>
                <select name="person_type" v-model="formData.person_type">
                    <option v-for="person_type in config.person_type" v-bind:value="person_type.id">
                        {{ person_type.value }}
                    </option>
                </select>
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('person_type')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.person_type">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 0" class="group">
                <label>meno *</label>
                <input v-model="formData.name" name="name" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('name')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.name">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 0" class="group">
                <label>priezvisko *</label>
                <input v-model="formData.surname" name="surname" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('surname')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.surname">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 0" class="group">
                <label>dátum narodenia *</label>
                <input v-model="formData.birthday" name="birthday" type="hidden">
                <date-picker
                    v-model="formData.birthday"
                    :lang="lang"
                    format="DD.MM.YYYY"
                    value-type="YYYY-MM-DD"
                    input-class=""
                    :input-attr="{name: ''}"
                    placeholder="DD.MM.RRRR"
                    :popupStyle="{left: 0, top: '100%'}"
                    :append-to-body="false"
                ></date-picker>
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('birthday')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.birthday">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 0" class="group">
                <label>rodné číslo</label>
                <input
                    v-model="formData.id_number"
                    name="id_number"
                    type="text"
                    pattern="^\d{6}\/\d{3,4}$"
                    placeholder="rodné číslo zadajte aj so znakom /"
                    oninvalid="this.setCustomValidity('Zadajte RČ vo formáte 123456/1234')">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('id_number')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.id_number">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 0" class="group">
                <label>občianstvo</label>
                <input v-model="formData.citizenship" name="citizenship" type="text">
                <span class="bar"></span>
            </div>

            <div v-if="formData.person_type == 1" class="group">
                <input type="hidden" name="name" :value="formData.name">
                <label>názov *</label>
                <multiselect
                    v-model="selectedCompany"
                    :options="companies"
                    label="name"
                    track-by="id"

                    :loading="isLoading.includes('name')"
                    :searchable="true"
                    :internal-search="false"
                    :clear-on-select="false"
                    :close-on-select="true"
                    placeholder="Začnite písať"
                    open-direction="bottom"
                    :showNoOptions="false"
                    :show-labels="false"
                    @search-change="query => debounceSearch(query, 'name')"
                    @select="setCompanyFormData"
                >
                    <template slot="singleLabel" slot-scope="props">
                        <span class="option__title">{{ props.option.name }}</span>
                    </template>
                    <template slot="option" slot-scope="props">
                        <div class="option__desc">
                            <span class="option__title">{{ props.option.name }}</span>
                            <span class="option__small"> ({{ props.option.ico }})</span>
                        </div>
                    </template>
                    <span slot="noResult">Žiadne výsledky</span>
                </multiselect>
                <span v-if="this.config.validationErrors.hasOwnProperty('name')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.name">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 1" class="group">
                <input type="hidden" name="ico" :value="formData.ico" hidden>
                <label>IČO *</label>
                <multiselect
                    v-model="selectedCompany"
                    :options="companies"
                    label="ico"
                    track-by="id"
                    :loading="isLoading.includes('cin')"
                    :searchable="true"
                    :internal-search="false"
                    :clear-on-select="false"
                    :close-on-select="true"
                    placeholder="Začnite písať"
                    open-direction="bottom"
                    :showNoOptions="false"
                    :showCaret="true"
                    :show-labels="false"
                    @search-change="query => debounceSearch(query, 'cin')"
                    @select="setCompanyFormData"
                >
                    <template slot="singleLabel" slot-scope="props">
                        <span class="option__title">{{ props.option.ico }}</span>
                    </template>
                    <template slot="option" slot-scope="props">
                        <div class="option__desc">
                            <span class="option__title">{{ props.option.ico }}</span>
                            <span class="option__small"> ({{ props.option.name }})</span>
                        </div>
                    </template>
                    <span slot="noResult">Zadajte celé IČO</span>
                </multiselect>
                <span v-if="this.config.validationErrors.hasOwnProperty('ico')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.ico">{{ message }}</div>
                </span>
            </div>

            <div v-if="formData.person_type == 1" class="group">
                <label>IČ DPH</label>
                <input v-model="formData.vat" name="vat" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('vat')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.vat">{{ message }}</div>
                </span>
            </div>

            <div v-if="this.config.slug === 'creditor'" class="group">
                <label>IBAN *</label>
                <input v-model="formData.iban" name="iban" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('iban')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.iban">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>ulica *</label>
                <input v-model="formData.street" name="street" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('street')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.street">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>číslo *</label>
                <input v-model="formData.house_number" name="house_number" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('house_number')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.house_number">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>obec *</label>
                <input v-model="formData.town" name="town" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('town')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.town">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>PSČ *</label>
                <input
                    v-model="formData.zip"
                    name="zip"
                    type="text"
                    oninvalid="this.setCustomValidity('Zadajte PSČ vo formáte 12345')"
                >
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('zip')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.zip">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>štát *</label>
                <input v-model="formData.country" name="country" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('country')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.country">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>telefón</label>
                <input v-model="formData.phone" name="phone" type="text">
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('phone')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.phone">{{ message }}</div>
                </span>
            </div>

            <div class="group">
                <label>e-mail</label>
                <input
                    v-model="formData.email"
                    name="email" type="email"
                >
                <span class="bar"></span>
                <span v-if="this.config.validationErrors.hasOwnProperty('email')" class="validation-error">
                    <div v-for="message in this.config.validationErrors.email">{{ message }}</div>
                </span>
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

            // prepisanie defaultnych hodnot vue-multiselect komponenty. by default je autocomplete = nope
            let el = document.querySelectorAll('.multiselect__input');
            el.forEach(e => e.autocomplete = "off");
        },
        data() {
            return {
                isLoading: [],
                debounce:null,
                companies: [],
                formData: { person_type: 1 },
                selectedCompany: null,
                lang: lang.slovak(),
            }
        },
        methods: {
            setDefaultFormData() {
                if (this.config.stepData instanceof Object) {
                    this.selectedCompany = this.formData = {...this.config.stepData};
                }
            },
            getCompanyData(query, param) {
                this.isLoading.push(param);
                let queryString = param + ':' + query;
                axios.get(`/api/company-data`, {
                        params: {
                            search: queryString
                        }
                    })
                    .then((response) => {
                        this.removeFilterLoading(param);
                        this.companies = response.data;
                    }).catch(function (error) {
                    console.log(error);
                });
            },
            debounceSearch(query, param) {
                clearTimeout(this.debounce);
                this.debounce = setTimeout(() => {
                    if (query !== "") {
                        this.getCompanyData(query, param);
                    }
                }, 400);
            },
            setCompanyFormData(data) {
                this.formData = {...this.formData, ...data};
            },
            removeFilterLoading(value) {
                let index = this.isLoading.indexOf(value);

                if (index > -1) {
                    this.isLoading.splice(index,1);
                }
            }
        },
    };
</script>
