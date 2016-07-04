<template>
    <div class="sidebar directoryPanel" style="background: #000">
        <ul class="nav sidebar-menu">
            <li v-for="directory in directories" class="treeview" v-bind:class="{ active : directory.active }">
                <a v-on:click="changeDirectory(directory)" href="#">
                    {{ directory.name }} <span v-show="directory.hasSubDirectories" class="fa fa-angle-right"></span>
                </a>
                <ul v-show="directory.show_sub_directories" class="nav treeview-menu">
                    <li v-for="sub_directory in directory.sub_directories"
                        v-bind:class="{ active : sub_directory.active }">
                        <a v-on:click="changeDirectory(sub_directory)" href="#"  v-bind:class="{ hasSubDirectories : sub_directory.hasSubDirectories}">
                            {{ sub_directory.name }} <span v-show="sub_directory.hasSubDirectories" class="fa fa-angle-right"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>



    <div class="sidebar" style="margin-top:1rem">
        <a href="#" v-on:click="showCreateDirectoryForm">Create Directory</a>

        <div v-show="showCreateDirectory">
            <div class="form-group">
                <label>New Directory Name</label>
                <input type="text" v-model="newDirectoryName" class="form-control" />
            </div>
            <div class="form-group">
                <div class="pull-right">
                    <button v-on:click="createDirectory()" type="button" class="btn btn-primary">
                        <span v-show="showLoadingIconButton" class="fa fa-circle-o-notch fa-spin"></span>&nbsp; Create Directory
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    module.exports = {
        props: ['workingDirectory'],

        data: function () {
            return {
                directories: [],
                showCreateDirectory: false,
                showLoadingIconButton:false,
                newDirectoryName: ''
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
            },
            showCreateDirectoryForm: function () {
                this.showCreateDirectory = true;
            },
            createDirectory: function () {
                this.showLoadingIconButton = true;
                var data = {
                    newDirectoryName: this.newDirectoryName,
                    path: this.workingDirectory
                }
                this.$http.post('/larapress/media/create-directory', data)
                        .then(function (response) {
                            this.$set('directories', response.data.directories);
                            this.showLoadingIconButton = false;
                            this.showCreateDirectory = false;
                            this.newDirectoryName = '';
                        }).catch(function (response) {
                            console.log(response);
                        });
            }
        }
    }
</script>
