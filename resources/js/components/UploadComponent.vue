<template>
    <div class="group add-files">
        <article v-if="config.files">
            <p>Zoznam uložených súborov</p>
            <div class="file-list">
                <div v-for="(file, key) in files" class="item">
                    <div class="name"><a :href="`/file/${file.id}/download`">{{ file.name }}</a></div>
                    <i class="material-icons" v-on:click="removeFile(file.id, key)">clear</i>
                </div>
            </div>
        </article>
        <p v-if="config.files">Pridať ďalšie súbory</p>
        <input
            v-for="i in counter"
            ref="files"
            type="file"
            :key="i"
            class="form-control form-control-sm"
            name="uploads[]"
        >
        <button v-if="config.multi" type="button" title="Pridať súbor" v-on:click="addFiles()"><i class="material-icons">playlist_add</i></button>
    </div>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            return {
                counter: 1,
                files: this.config.files ? this.config.files.data : [],
                errors: {}
            }
        },
        methods: {
            addFiles(){
                this.counter++;
            },
            removeFile(id,key){
                // this.files.splice(key, 1);
                axios.delete(`/file/${id}/delete`)
                    .then(res => {
                        flash({text: res.data.message, type:'success', timer:3000 });
                        this.files.splice(key, 1);
                    }).catch(e => {
                        flash({text: `${e.response.data.message}`, type:'error', timer:null });
                    });
            }
        },
    };
</script>
