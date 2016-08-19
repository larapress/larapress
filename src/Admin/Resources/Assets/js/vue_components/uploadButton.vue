<style lang="sass">
    .upload-container {
        display: inline-block;
        position: relative;

    .btn-upload {
        overflow: hidden;
    }

    input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        top: 0;
        left: 0;
    }

    }
</style>

<template>
    <div class="upload-container">
        <form action="/larapress/media/upload" method="post" enctype="multipart/form-data">
            <div v-bind:class="classes" class="btn-upload">
                <span v-show="uploading" class="fa fa-circle-o-notch fa-spin"></span> {{ uploadBtnText }}
                <input type="file" v-on:change="onFileChange" v-bind:name="uploadContext"
                       class="btn btn-primary"/>
            </div>
        </form>
    </div>
</template>

<script>
    module.exports = {
        props: {
            uploadBtnText: {default: 'Upload Image'},           // text on the upload button
            uploadDirectory: {default: '/media'},               // directory to upload file to
            uploadFilename: {default: false},                   // name the file could be called
            uploadContext: {},                                  // identifier to caller component
            modelName: {default: null},                         // model to be updated if required
            modelId: {default: null},                           // model id
            modelField: {default: null},                        // model field to update
            modelValue: {default: null},                        // model value
            classes: {default: 'btn btn-primary'}               // css classes
        },
        data: function () {
            return {
                uploading: false
            }
        },
        methods: {
            /**
             * When a file is selected from file selector, upload it and dispatch result up
             * @param e
             */
            onFileChange: function (e) {
                this.uploading = true;
                console.log(this.uploading);
                var files = e.target.files || e.dataTransfer.files;

                if (!files.length) return;
                var formData = new FormData();

                formData.append("directory", this.uploadDirectory);

                //if a filename was not selected, use original
                if (this.uploadFilename == false) this.uploadFilename = files[0].name;

                formData.append("filename", this.uploadFilename);

                formData.append("file", files[0]);

                if(this.modelName){
                    formData.append("model", JSON.stringify({
                        modelName: this.modelName,
                        modelId: this.modelId,
                        modelField: this.modelField,
                        modelValue: this.modelValue
                    }));
                }

                this.$http.post('/larapress/media/upload', formData)
                        .then(function (response) {
                            this.$dispatch('uploadSubmitted',
                                    {
                                        context: this.uploadContext,
                                        value: this.uploadDirectory + '/' + this.uploadFilename
                                    }
                            );
                            console.log(response);
                            this.$set('uploading', false);
                        });
            }
        }
    }

</script>