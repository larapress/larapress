<style lang="sass">
    .fileThumb {
        border-color: #aaaaaa !important;
    }
</style>

<template>
    <div v-show="display" class="box filePanel" style="margin-bottom: 0;">
        <div class="row">
            <div class="col-xs-12">
                <form action="/larapress/media/upload" method="post" enctype="multipart/form-data">
                    <input type="file" v-on:change="onFileChange" name="media_file"/>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h4>Recently uploaded files</h4>

                <div v-for="file in files" class="col-xs-2">
                    <a href="#"
                       class="fileThumb"
                       v-bind:style="{backgroundImage : file.backgroundImage}">
                        <div class="title">
                            <p>{{ file.name }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    module.exports = {
        data: function () {
            return {
                files: [],
                display: false,
                working_directory: 'media/images'
            }
        },
        events: {
            changeOfDirectory: function (directory) {
                this.working_directory = directory;
            },
            changeToUpload: function () {
                this.display = true;
            },
            changeToShowFiles: function () {
                this.display = false;
            }
        },
        methods: {
            onFileChange: function (e) {
                var files = e.target.files || e.dataTransfer.files;

                if (!files.length) return;

                var formData = new FormData();

                formData.append("directory", this.working_directory);

                formData.append("file", files[0]);

                this.files.push({});

                var indexPointer = this.files.length - 1;

                this.$http.post('/larapress/media/upload', formData)
                        .then(function (response) {
                            this.files[indexPointer] = response.data;
                        });
            }
        }
    }
</script>