var directoriesComponent = Vue.extend({
    template: '#directories',
    data: function () {
        return {
            directories: [
                {name: 'test'}
            ]
        }
    },
    ready: function () {
        this.refreshDirectories();
    },
    methods: {
        refreshDirectories: function () {
            this.$http.get('/larapress/media/directories').success(function (directories) {
                this.$set('directories', directories);
            }).error(function (error) {
                console.log(error);
            });
        },
        changeDirectory: function (directory) {
            this.$dispatch('changeOfDirectory', directory);
        }
    }
});
