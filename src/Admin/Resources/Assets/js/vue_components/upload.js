var uploadComponent = Vue.extend({
    template: '#uploader',
    data: function () {
        return {
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
        changeToShowFiles:function(){
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

            this.$http.post('/larapress/media/upload', formData)
                .then(function (response) {
                    console.log(response)
                });
        }
    }
});

