<template>
        <div class="sidebar" style="background: #000">
            <ul class="nav sidebar-menu">
                <li v-for="directory in directories" class="treeview" v-bind:class="{ active : directory.active }">
                    <a v-on:click="changeDirectory(directory)" href="#">{{ directory.name }}</a>
                    <ul v-show="directory.show_sub_directories" class="nav treeview-menu">
                        <li v-for="sub_directory in directory.sub_directories" v-bind:class="{ active : sub_directory.active }">
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
                directories: []
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
            changeDirectory: function (selected_directory) {
                selected_directory.show_sub_directories = true;

                selected_directory.active = true;

                this.$dispatch('changeOfDirectory', selected_directory.path);
            }
        }
    }
</script>
