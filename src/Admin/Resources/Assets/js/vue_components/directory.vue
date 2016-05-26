<template>
        <div class="sidebar" style="background: #000">
            <ul class="sidebar-menu">
                <li v-for="directory in directories">
                    <a v-on:click="changeDirectory(directory.path)" href="#">{{ directory.name }}</a>
                    <ul class="treeview">
                        <li v-for="sub_directory in directory.sub_directories">
                            <a v-on:click="changeDirectory(sub_directory.path)" href="#">{{ sub_directory.name }}</a>
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
                this.$dispatch('changeOfDirectory', directory);
            }
        }
    }
</script>
