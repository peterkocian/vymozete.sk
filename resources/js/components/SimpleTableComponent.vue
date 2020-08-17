<template>
    <div class="table-responsive">
        <table class="table table-borderless table-sm table-responsive-xl" v-if="config.config.inlineNew">
            <tbody>
            <tr>
                <td class="align-middle text-center" v-for="field in config.config.inlineNew.fields" :key="field.id">
                    {{field.label}}
                    <input
                        v-if="field.type !== 'select'"
                        class="form-control form-control-sm"
                        :type="field.type"
                        :placeholder="field.label"
                        :name="field.key"
                        :id="field.key"
                        v-model="newEntry[field.key]"
                        @change="handleChange($event, field.type)"
                    >
                    <select
                        v-else
                        class="form-control form-control-sm"
                        v-model="newEntry[field.key]"
                        :required="field.settings['required']"
                    >
                        <option v-for="item in field.options" v-bind:value="item.id">{{item.name}}</option>
                    </select>
                </td>
                <td class="align-middle" style="width: 150px">
                    <div>
                        <a
                            class="btn btn-success btn-sm"
                            type="button"
                            href=""
                            v-if="config.config.inlineNew.action"
                            v-on:click="config.config.inlineNew.action ? handleActions(config.config.inlineNew.action, config.config.inlineNew.url) : null"
                            onclick="this.blur();"
                        >{{config.config.inlineNew.label}}</a>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th v-for="column in config.columns" :key="column.key"
                        style="cursor:pointer;">{{column.label}}
                    </th>
                    <th style="width: 140px" v-if="config.actions.length > 0">{{config.actionColumnLabel}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in config.data" :key="item.id">
                    <td class="align-middle" v-for="column in config.columns">{{ item[column.key] }}</td>
                    <td v-if="config.actions.length > 0" class="align-middle" style="width: 150px">
                        <a
                            role="button"
                            v-for="action in config.actions"
                            :title=action.title
                            v-bind:href=buildUrl(action.url,item)
                            :class=action.class
                            v-html=action.label
                            :data-toggle="action.dataToggle || null"
                            :data-target="action.dataTarget || null"
                            v-on:click="action.dataToggle ? showModal(buildUrl(action.url,item),action.modalText) : null"
                        ></a>
                    </td>
                </tr>
            </tbody>
        </table>
        <modal-component :config="{modalText, url:modalUrl}"></modal-component>
    </div>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            return {
                file: null,
                newEntry: {},
                modalText: '',
                modalUrl: ''
            }
        },
        methods: {
            buildUrl(urlTemplate, data) {
                let resolvedUrl;
                let params = urlTemplate.match(/[^{\}]+(?=})/g);
                params.forEach(param => {
                    resolvedUrl = urlTemplate.replace(`{${param}}`,data[param]);
                });

                return resolvedUrl;
            },
            showModal(url,text) {
                this.modalUrl = url;
                this.modalText = text;
            },
            handleActions(action, url) {
                event.preventDefault();
                event.stopPropagation();
                switch (action) {
                    case 'createItem':
                        this.createItem(url);
                        break;
                };
            },
            createItem(url) {
                // const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                this.newEntry.file = this.file;
                let formData = new FormData();
                // formData.append('test', JSON.stringify(this.newEntry));
                this.newEntry.filename ? formData.append('filename', this.newEntry.filename) : null;
                this.newEntry.file_type_id ? formData.append('file_type_id', this.newEntry.file_type_id) : null;
                this.newEntry.show_to_customer ? formData.append('show_to_customer', this.newEntry.show_to_customer) : null;
                formData.append('file', this.file);
                // console.log('formData: ', formData);
                // console.log('this.newEntry: ', this.newEntry);
                axios.post(url, formData)
                    .then(res => {
                        this.$root.$emit('reloadData');
                        // this.$root.$emit('flash', this.setFlashMessage(res, 4000));
                        console.log('success');
                    }).catch(e => {
                    // this.$root.$emit('flash', this.setFlashMessage({data:e}));
                    console.log('error');
                });

                this.setDefaultValue();
            },
            setDefaultValue() {
                this.newEntry = {};
            },
            handleChange(e, type) {
                if (type === 'file') {
                    // console.log(e.target.files[0])
                    this.file = e.target.files[0];
                }
            }
        },
    };
</script>
