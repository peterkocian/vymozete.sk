<template>
    <div class="group add-files">
        <input
            class="form-control form-control-sm"
            type="file"
            placeholder="placeholder"
            name="file-upload-front"
            id="xxcv1"
            @change="handleChange($event, field.type)"
        >
        <button type="button" title="Pridať ďalší súbor"><i class="material-icons">playlist_add</i></button>
    </div>
</template>

<script>
    export default {
        props: ['config'],
        data() {
            return {
                file: null,
                newEntry: {},
                errors: {}
            }
        },
        methods: {
            handleActions(action, url) {
                event.preventDefault();
                event.stopPropagation();
                switch (action) {
                    case 'uploadFile':
                        this.uploadFile(url);
                        break;
                };
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
                        flash({text: `Something went wrong in reloadData: ${e}`, type:'error', timer:null });
                    });

                this.setDefaultValue();
            },
            setDefaultValue() {
                this.newEntry = {};
            },
            handleChange(e, type) {
                if (type === 'file') {
                    this.file = e.target.files[0];
                }
            }
        },
    };
</script>
