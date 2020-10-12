<template>
    <div class="group add-files">
        <input
            v-for="i in counter"
            ref="files"
            type="file"
            :key="i"
            class="form-control form-control-sm"
            name="uploads[]"
        >
<!--        <input-->
<!--            id="files"-->
<!--            ref="files"-->
<!--            type="file"-->
<!--            class="form-control form-control-sm"-->
<!--            name="uploads[]"-->
<!--            :style="config.multi ? {display:'none'} : null"-->
<!--            :placeholder="config.placeholder"-->
<!--            :multiple="config.multi ? 'multiple' : null"-->
<!--            @change="handleChange($event, 'file')"-->
<!--        >-->
<!--        <div v-if="config.multi" class="file-list">-->
<!--            <div v-for="(file, key) in files" class="item">-->
<!--                <div class="name">{{ file.name }}</div>-->
<!--                <i class="material-icons" v-on:click="removeFile( key )">clear</i>-->
<!--            </div>-->
<!--        </div>-->
        <button v-if="config.multi" type="button" title="Pridať súbor" v-on:click="addFiles()"><i class="material-icons">playlist_add</i></button>
    </div>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            return {
                counter: 1,
                files: [],
                errors: {}
            }
        },
        methods: {
            addFiles(){
                this.counter++;
            },
            // handleChange(e, type) {
            //     if (type === 'file') {
            //         let uploadedFiles = this.$refs.files.files;
            //
            //         for(let i = 0; i < uploadedFiles.length; i++){
            //             this.files.push( uploadedFiles[i] );
            //         }
            //     }
            // },
            // removeFile( key ){
            //     this.files.splice(key, 1);
            // }
        },
    };
</script>
