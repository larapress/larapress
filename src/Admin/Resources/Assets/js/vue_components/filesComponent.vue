<template>
    <div v-show="display" class="filePanel">
        <h5 v-show="files.length < 1">Directory is empty</h5>
        <div class="row">
            <div v-for="file in files" class="col-xs-2">
                <a href="#" v-on:click="selectedFile(file)"
                   class="fileThumb"
                   v-bind:class="{active : file.active}"
                   v-bind:style="{background : file.backgroundImage}">
                    <div class="title">
                        <p>{{ file.name }}</p>
                    </div>
                </a>
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
                selected_file: ''
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
            }
        },
        methods: {
            /**
             * Reload all the information about a directory
             * @param directory - the required dir
             */
            refreshFiles: function (directory) {
                this.$http.post('/larapress/media/files', {directory: directory}).success(function (files) {
                    this.$set('files', files);
                }).error(function (error) {
                    console.log(error);
                });
            },
            /**
             * When a file is selected, send the filename to whatever needs it
             * @param selected_file - obj
             */
            selectedFile: function (selected_file) {
                //remove selected from all icons
                this.files.forEach(function(file){
                   file.active = false;
                });

                //toggle the active status
                selected_file.active = (selected_file.active != true);

                this.selected_file = selected_file.path;
                this.$dispatch('fileSelected', selected_file.path);
            }
        }
    }
</script>