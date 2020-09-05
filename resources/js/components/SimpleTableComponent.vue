<template>
    <div class="table-responsive">
        <form class="py-2" v-if="config.config.inlineNew">
            <div class="d-flex flex-wrap">
                <div v-for="field in config.config.inlineNew.fields" :key="field.id"
                     :class="field.settings.divClass"
                >
                    <!-- ak field je input type = text, number, file -->
                    <input
                        v-if="field.type === 'text' || field.type === 'number' || field.type === 'file' || field.type === 'textarea'"
                        class="form-control form-control-sm"
                        :class="errors.hasOwnProperty(field.key) ? 'is-invalid' : null"
                        :type="field.type"
                        :placeholder="field.label"
                        :name="field.key"
                        :id="field.key"
                        v-model="newEntry[field.key]"
                        @change="handleChange($event, field.type)"
                    >
                    <!-- ak field je select -->
                    <select
                        v-else-if="field.type === 'select'"
                        class="form-control form-control-sm"
                        :class="errors.hasOwnProperty(field.key) ? 'is-invalid' : null"
                        v-model="newEntry[field.key]"
                        :required="field.settings['required']"
                    >
                        <option v-for="item in field.options" v-bind:value="item.id">{{item.code}}</option>
                    </select>
                    <!-- ak field je input type checkbox -->
                    <div class="form-check" v-else-if="field.type === 'checkbox'">
                        <input
                            class="form-check-input"
                            :class="errors.hasOwnProperty(field.key) ? 'is-invalid' : null"
                            :type="field.type"
                            :name="field.key"
                            :id="field.key"
                            v-model="newEntry[field.key]"
                            @change="handleChange($event, field.type)"
                        >
                        <label class="form-check-label" :for="field.key">
                            {{ field.label }}
                        </label>
                    </div>
                    <!-- ak field je textarea -->
                    <!--                    <textarea v-else-if="field.type === 'textarea'" class="form-control" rows="3"></textarea>-->
                    <div v-if="errors.hasOwnProperty(field.key)" class="invalid-feedback">{{ errors[field.key][0] }}</div>
                </div>

                <a
                    class="btn btn-success btn-sm"
                    type="button"
                    href=""
                    v-if="config.config.inlineNew.action"
                    v-on:click="config.config.inlineNew.action ? handleActions(config.config.inlineNew.action, config.config.inlineNew.url) : null"
                    onclick="this.blur();"
                >{{config.config.inlineNew.label}}</a>
            </div>
        </form>
<!--        <table class="table table-borderless table-sm table-responsive-xl" v-if="config.config.inlineNew">-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <td class="align-middle text-center" v-for="field in config.config.inlineNew.fields" :key="field.id">-->
<!--                    &lt;!&ndash; ak field je input type = text, number, file &ndash;&gt;-->
<!--                    <input-->
<!--                        v-if="field.type === 'text' || field.type === 'number' || field.type === 'file' || field.type === 'textarea'"-->
<!--                        class="form-control form-control-sm"-->
<!--                        :class="errors.hasOwnProperty(field.key) ? 'is-invalid' : null"-->
<!--                        :type="field.type"-->
<!--                        :placeholder="field.label"-->
<!--                        :name="field.key"-->
<!--                        :id="field.key"-->
<!--                        v-model="newEntry[field.key]"-->
<!--                        @change="handleChange($event, field.type)"-->
<!--                    >-->
<!--                    &lt;!&ndash; ak field je select &ndash;&gt;-->
<!--                    <select-->
<!--                        v-else-if="field.type === 'select'"-->
<!--                        class="form-control form-control-sm"-->
<!--                        :class="errors.hasOwnProperty(field.key) ? 'is-invalid' : null"-->
<!--                        v-model="newEntry[field.key]"-->
<!--                        :required="field.settings['required']"-->
<!--                    >-->
<!--                        <option v-for="item in field.options" v-bind:value="item.id">{{item.code}}</option>-->
<!--                    </select>-->
<!--                    &lt;!&ndash; ak field je input type checkbox &ndash;&gt;-->
<!--                    <div class="form-check" v-else-if="field.type === 'checkbox'">-->
<!--                        <input-->
<!--                            class="form-check-input"-->
<!--                            :class="errors.hasOwnProperty(field.key) ? 'is-invalid' : null"-->
<!--                            :type="field.type"-->
<!--                            :name="field.key"-->
<!--                            :id="field.key"-->
<!--                            v-model="newEntry[field.key]"-->
<!--                            @change="handleChange($event, field.type)"-->
<!--                        >-->
<!--                        <label class="form-check-label" :for="field.key">-->
<!--                            {{ field.label }}-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    &lt;!&ndash; ak field je textarea &ndash;&gt;-->
<!--&lt;!&ndash;                    <textarea v-else-if="field.type === 'textarea'" class="form-control" rows="3"></textarea>&ndash;&gt;-->
<!--                    <div v-if="errors.hasOwnProperty(field.key)" class="invalid-feedback">{{ errors[field.key][0] }}</div>-->
<!--                </td>-->
<!--                <td class="align-middle" style="width: 150px">-->
<!--                    <div>-->
<!--                        <a-->

<!--                            class="btn btn-success btn-sm"-->
<!--                            type="button"-->
<!--                            href=""-->
<!--                            v-if="config.config.inlineNew.action"-->
<!--                            v-on:click="config.config.inlineNew.action ? handleActions(config.config.inlineNew.action, config.config.inlineNew.url) : null"-->
<!--                            onclick="this.blur();"-->
<!--                        >{{config.config.inlineNew.label}}</a>-->
<!--                    </div>-->
<!--                </td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->

        <b-overlay :show="overlay" rounded="sm" class="h-100">
            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th
                            v-for="column in config.columns"
                            :key="column.key"
                            :class="sortKey === column.key ? (sortDirection === 'asc' ? 'fa-sort-asc' : 'fa-sort-desc') : 'fa-sort-desc'"
                            @click="sortBy(column.key)"
                            style="cursor:pointer;"
                        >{{column.label}}
                            <b-icon icon="sort-alpha-down" v-if=" ( column.key === sortKey && sortDirection === 'asc')"></b-icon>
                            <b-icon icon="sort-alpha-down-alt" v-if=" ( column.key === sortKey && sortDirection === 'desc') "></b-icon>
    <!--                        <div v-if=" ( column.key === sortKey && sortDirection === 'asc') ">asc</div>-->
    <!--                        <div v-if=" ( column.key === sortKey && sortDirection === 'desc') ">desc</div>-->
                        </th>
                        <th style="width: 140px" v-if="config.actions.length > 0">{{config.actionColumnLabel}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in source" :key="item.id">
                        <td class="align-middle" v-for="column in config.columns">{{ item[column.key] }}</td>
                        <td v-if="config.actions.length > 0" class="align-middle" style="width: 150px">
                            <a
                                role="button"
                                v-for="action in config.actions"
                                :title=action.title
                                v-bind:href=buildUrl(action.url,item)
                                :class=action.class
                                :data-toggle="action.dataToggle || null"
                                :data-target="action.dataTarget || null"
                                v-on:click="action.dataToggle ? showModal(
                                        buildUrl(action.url,item),
                                        action.modalText,
                                        action.ajax,
                                        action.requestMethod,
                                        action.key,
                                        item
                                    ) : null"
                            ><span class="material-icons">{{action.label}}</span></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </b-overlay>
        <modal-component
            :config="{...modal}"
            v-on:ajaxModalSubmit="handleAjaxModalSubmit(modal.url)"
        ></modal-component>
    </div>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            return {
                source: [],
                file: null,
                newEntry: {},
                overlay: false,
                modal: {
                    text: '',
                    url: '',
                    ajax: false,
                    requestMethod: '',
                },
                queryParams: {
                    rows: '',
                    sortKey: '',
                    sortDirection: '',
                    search: ''
                },
                sortKey: this.config.config.sortKey || null,
                sortDirection: this.config.config.sortDirection || null,
                errors: {}
            }
        },
        mounted() {
            this.loadSourceData(this.config.data);
        },
        methods: {
            buildUrl(urlTemplate, data) {
                let resolvedUrl;
                let params = urlTemplate.match(/[^{\}]+(?=})/g);
                if (params) {
                    params.forEach(param => {
                        resolvedUrl = urlTemplate.replace(`{${param}}`,data[param]);
                    });
                } else {
                    resolvedUrl = urlTemplate;
                }

                return resolvedUrl;
            },
            showModal(url, text, ajax, requestMethod, key, item) {
                if (key === 'passwordReset') {
                    this.modal.email = item['email'];
                }
                this.modal = Object.assign(this.modal, {url, text, ajax, requestMethod});
            },
            handleActions(action, url) {
                event.preventDefault();
                event.stopPropagation();
                switch (action) {
                    case 'createItem':
                        this.createItem(url);
                        break;
                    case 'uploadFile':
                        this.uploadFile(url);
                        break;
                };
            },
            createItem(url) {
                axios.post(url, this.newEntry)
                    .then(res => {
                        this.reloadData(this.config.config.reloadUrl);
                        flash({text: 'Item succesfully created', type:'success', timer:3000 });
                    }).catch(e => {
                        console.log(e.response.data.errors);
                        this.errors = e.response.data.errors;
                        flash({text: `${e.response.data.message}`, type:'error', timer:null });
                    });

                this.setDefaultValue();
            },
            uploadFile(url) {
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
                        this.reloadData(this.config.config.reloadUrl);
                        flash({text: 'File successfully uploaded', type:'success', timer:3000 });
                    }).catch(e => {
                        this.errors = e.response.data.errors;
                        flash({text: `Something went wrong in uploadFile: ${e}`, type:'error', timer:null });
                    });

                this.setDefaultValue();
            },
            loadSourceData(data){
                if (this.config.config.showPagination) {
                    this.source = data.data;
                } else {
                    this.source = data;
                }
            },
            reloadData(url) {
                this.showOverlay();
                axios.get(url, {
                    params: this.queryParams,
                    paramsSerializer: function (params) {
                        return decodeURIComponent( $.param(params))
                    }
                }).then(res => {
                    this.loadSourceData(res.data);
                    this.hideOverlay();
                }).catch(e => {
                    this.hideOverlay();
                    flash({text: `Something went wrong in reloadData: ${e}`, type:'error', timer:null });
                });
            },
            setDefaultValue() {
                this.newEntry = {};
            },
            handleAjaxModalSubmit(url) {
                axios.delete(url, {
                    // params: this.queryParams,
                    // paramsSerializer: function (params) {
                    //     return decodeURIComponent( $.param(params))
                    // }
                }).then(res => {
                    this.reloadData(this.config.config.reloadUrl);
                    flash({text: 'Deleted successfully', type:'success', timer:3000 });
                }).catch(e => {
                    flash({text: `Something went wrong in handleAjaxDelete: ${e}`, type:'error', timer:null });
                });
            },
            handleChange(e, type) {
                if (type === 'file') {
                    this.file = e.target.files[0];
                }
            },
            sortBy(key) {
                // this.resetPagination();
                this.sortKey = key;
                this.sortDirection === 'asc' ? this.sortDirection = 'desc' : this.sortDirection = 'asc';

                this.queryParams.sortKey = this.sortKey;
                this.queryParams.sortDirection = this.sortDirection;
                this.reloadData(this.config.config.reloadUrl);
            },
            showOverlay: function() {
                this.overlay = true;
            },
            hideOverlay: function() {
                this.overlay = false;
            },
        },
    };
</script>
