var filesComponent = Vue.extend({
    template: '#files',
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
});
