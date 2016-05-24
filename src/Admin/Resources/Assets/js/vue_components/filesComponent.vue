<template>
    <div v-show="display">
        <h5>Files</h5>
        <h5 v-show="files.length < 1">Directory is empty</h5>
        <ul>
            <li v-for="file in files">
                <a href="#" v-on:click="selectedFile(file.path)">{{ file.name }}</a>
            </li>
        </ul>
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
             * @param filename
             */
            selectedFile: function (file) {
                this.selected_file = file;
                this.$dispatch('fileSelected', file);
            }
        }
    }

</script>