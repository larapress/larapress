<template>
    <div class="row">
        <div class="col-xs-12">
            <div v-show="display" class="box filePanel" style="margin-bottom: 0;">
                <h3 v-show="files.length < 1" class="text-center" style="margin-top: 3rem">Directory is empty</h3>

                <div class="row">
                    <div v-for="file in files" class="col-xs-2">
                        <a href="#"
                           class="fileThumb"
                           v-on:dblclick.prevent="selectedFile(file, true)"
                           v-on:click.prevent="selectedFile(file, false)"
                           v-bind:class="{active : file.active}"
                           v-bind:style="{backgroundImage : file.backgroundImage}">
                            <div class="title">
                                <p>{{ file.name }}</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="overlay" v-show="loading">
                    <i class="fa fa-refresh fa-spin"></i>
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
                display: true,
                selected_file: '',
                loading: false
            }
        },
        events: {
            changeOfDirectory: function (directory) {
                this.refreshFiles(directory)
            },
            changeToUpload: function () {
                this.display = false;
            },
            changeToShowFiles: function () {
                this.display = true;
            },
            changeOfDirectory: function(directory){
                this.loading = true;
                this.refreshFiles(directory);
            }
        },
        methods: {
            /**
             * Reload all the information about a directory
             * @param directory - the required dir
             */
            refreshFiles: function (directory) {
                this.loading = true;
                this.$http.post('/larapress/media/files', {directory: directory}).success(function (files) {
                    this.$set('files', files);
                    this.loading = false;
                }).error(function (error) {
                    console.log(error);
                });
            },
            /**
             * When a file is selected, send the filename to whatever needs it
             * @param selected_file - obj
             */
            selectedFile: function (selected_file, proceed) {
                //remove selected from all icons
                this.files.forEach(function (file) {
                    file.active = false;
                });

                //toggle the active status
                selected_file.active = (selected_file.active != true);

                this.selected_file = selected_file.path;

                this.$dispatch('fileSelected', {selectedFile: selected_file.path, proceed: proceed});
            }
        }
    }
</script>