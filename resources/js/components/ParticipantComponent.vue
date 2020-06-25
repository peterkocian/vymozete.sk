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
                <label>druh</label>
                <select name="personType" v-model="selected">
                    <option v-for="type in personType" v-bind:value="type.id">
                        {{ type.value }}
                    </option>
                </select>
                <span class="bar"></span>
            </div>

            <div v-if="selected == 0" class="group">
                <label>meno *</label>
                <input v-model="buffer.name" name="name" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div v-if="selected == 0" class="group">
                <label>priezvisko *</label>
                <input v-model="buffer.surname" name="surname" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div v-if="selected == 0" class="group">
                <label>dátum narodenia *</label>
                <input v-model="buffer.birthday" name="birthday" type="date" required="required" pattern="^\d{2}\.\d{2}\.\d{4}$" oninvalid="this.setCustomValidity('Zadajte dátum vo formáte DD.MM.YYYY')" oninput="this.setCustomValidity('')">
                <span class="bar"></span>
            </div>

            <div v-if="selected == 0" class="group">
                <label>rodné číslo</label>
                <input v-model="buffer.id_number" name="id_number" type="text" pattern="^\d{6}\/\d{3,4}$" placeholder="rodné číslo zadajte aj s /" oninvalid="this.setCustomValidity('Zadajte RČ vo formáte 123456/1234')">
                <span class="bar"></span>
            </div>

            <div v-if="selected == 0" class="group">
                <label>občianstvo</label>
                <input v-model="buffer.citizenship" name="citizenship" type="text">
                <span class="bar"></span>
            </div>

            <div v-if="selected == 1" class="group">
                <label>názov *</label>
                <input v-model="buffer.name" class="cname" name="name" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div v-if="selected == 1" class="group">
                <label>IČO *</label>
                <input v-model="buffer.ico" class="ico" name="ico" type="text" pattern="^\d{8}$" required="required" oninvalid="this.setCustomValidity('Zadajte IČO vo formáte 12345678')">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>ulica *</label>
                <input v-model="buffer.street" class="street" name="street" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>číslo *</label>
                <input v-model="buffer.house_number" class="number" name="house_number" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>obec *</label>
                <input v-model="buffer.town" class="city" name="town" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>PSČ *</label>
                <input v-model="buffer.zip" class="psc" name="zip" type="text" pattern="^\d{5}$" required="required" oninvalid="this.setCustomValidity('Zadajte PSČ vo formáte 12345')">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>štát *</label>
                <input v-model="buffer.country" class="country" name="country" type="text" required="required">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>telefón</label>
                <input v-model="buffer.phone" name="phone" type="text">
                <span class="bar"></span>
            </div>

            <div class="group">
                <label>e-mail</label>
                <input
                    v-model="buffer.email"
                    name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="this.setCustomValidity('Nesprávna mailová adresa')">
                <span class="bar"></span>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['config'],
        mounted() {
            this.mapStepDataToBuffer();
        },
        data() {
            let stepData = {...this.config.stepData};
            let personType = [
                {
                    id: 0,
                    value: 'fyzická osoba (nepodnikateľ)'
                },
                {
                    id: 1,
                    value: 'podnikateľ (živnostník, s.r.o., ...)'
                }
            ];

            return {
                buffer: {},
                stepData,
                selected: stepData.personType || 0,
                personType,
            }
        },
        methods: {
            mapStepDataToBuffer() {
                this.buffer = {...this.stepData};
            }
        }
    };
</script>
