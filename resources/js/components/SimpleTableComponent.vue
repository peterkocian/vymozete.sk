<template>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-dark">
            <tr>
                <th v-for="column in columns" :key="column.key"
                    style="cursor:pointer;">{{column.label}}
                </th>
                <th style="width: 140px" v-if="actions.length > 0">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in data" :key="item.id">
                <td class="align-middle" v-for="column in columns">{{ item[column.key] }}</td>
                <td v-if="actions.length > 0" class="align-middle" style="width: 150px">
                    <a
                        role="button"
                        v-for="action in actions"
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
            let conf = this.loadConfig(this.config);

            if (conf) {
                return {
                    data:    conf.data || {},
                    columns: conf.columns || {},
                    actions: conf.actions || {},
                    modalText: '',
                    modalUrl: ''
                }
            }
        },
        methods: {
            loadConfig(conf) {
                return JSON.parse(conf);
            },
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
            }
        }
    };
</script>
