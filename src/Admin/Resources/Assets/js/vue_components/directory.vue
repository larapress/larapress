<template>
        <div class="sidebar" style="background: #000">
            <ul class="sidebar-menu">
                <li v-for="directory in directories">
                    <a v-on:click="changeDirectory(directory)" href="#">{{ directory.name }}</a>
                    <ul v-show="directory.show_sub_directories">
                        <li v-for="sub_directory in directory.sub_directories">
                            <a v-on:click="changeDirectory(sub_directory)" href="#">{{ sub_directory.name }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
</template>


<script>
    module.exports = {
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
                directory.show_sub_directories = true;
                this.$dispatch('changeOfDirectory', directory.path);
            }
        }
    }
</script>
