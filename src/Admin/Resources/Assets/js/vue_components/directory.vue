<template>
    <div class="sidebar directoryPanel" style="background: #000">
        <ul class="nav sidebar-menu">
            <li v-for="directory in directories" class="treeview" v-bind:class="{ active : directory.active }">
                <a v-on:click.prevent="changeDirectory(directory)" href="#">
                    {{ directory.name }} <span v-show="directory.hasSubDirectories" class="fa fa-angle-right"></span>
                </a>
                <ul v-show="directory.show_sub_directories" class="nav treeview-menu">
                    <li v-for="sub_directory in directory.sub_directories"
                        v-bind:class="{ active : sub_directory.active }">
                        <a v-on:click.prevent="changeDirectory(sub_directory)" href="#">
                            {{ sub_directory.name }} <span v-show="sub_directory.hasSubDirectories"
                                                           class="fa fa-angle-right"></span>
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
                <input type="text" v-model="newDirectoryName" class="form-control"/>
            </div>
            <div class="form-group">
                <div class="pull-right">
                    <button v-on:click="createDirectory()" type="button" class="btn btn-primary">
                        <span v-show="showLoadingIconButton" class="fa fa-circle-o-notch fa-spin"></span>&nbsp; Create
                        Directory
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    module.exports = {
        props:{
            workingDirectory: {type: String}
        },
        data: function () {
            return {
                directories: [],              // array of dirs in hierachal
                showCreateDirectory: false,   // show the create dir form
                showLoadingIconButton: false, // show the spinner on create dir form
                newDirectoryName: '',         // default folder name for createing dir
                rootDirectory: ''             // the root directory
            }
        },

        ready: function () {
            this.refreshDirectories();
        },

        events:{
            /**
             * data =  {context,rootDirectory}
             */
            mediaManagerRequested: function(data){
                console.log('media.js');
                console.log(data);
                console.log(this.rootDirectory);
                if(this.rootDirectory != data.rootDirectory){
                    this.rootDirectory = data.rootDirectory;
                    console.log('refreshing dirs');
                    this.refreshDirectories();
                }
            }
        },
        methods: {
            refreshDirectories: function () {
                console.log(this.rootDirectory);
                this.$dispatch('changeOfDirectory', this.rootDirectory);
                var data = {
                    rootDirectory: this.rootDirectory
                };
                this.$http.post('/larapress/media/directories', data).success(function (directories) {
                    this.$set('directories', directories);
                }).error(function (error) {
                    console.log(error);
                });
            },
            /**
             *  When a directory is selected, dispatch to change
             */
            changeDirectory: function (selected_directory) {
                selected_directory.show_sub_directories = true;

                selected_directory.active = true;

                this.$dispatch('changeOfDirectory', selected_directory.path);
            },
            /**
             *  Show the form to create a new directory
             */
            showCreateDirectoryForm: function () {
                this.showCreateDirectory = true;
            },
            /**
             * Changes the current directory, loads files etc
             */
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
