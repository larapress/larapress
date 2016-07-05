<template>
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-default" style="margin-top:1rem">
                <div class="box-header with-border">
                    <a href="#" v-on:click="showCreateDirectoryForm" title="Create directory"><span
                            class="fa fa-plus"></span></a>&nbsp;&nbsp;
                    <a href="#" v-on:click="changeDirectoryUpLevel" title="Move up a directory"><span
                            class="fa fa-level-up"></span></a>&nbsp;&nbsp;
                    <a href="#" v-on:click="changeDirectoryToHome" title="Move to root directory"><span
                            class="fa fa-home"></span></a>&nbsp;&nbsp;
                </div>

                <div class="box-body">
                    <div v-show="showCreateDirectory" style="padding-bottom: 1rem">
                        <div class="form-group">
                            <label>New Directory Name</label>
                            <input type="text" v-model="newDirectoryName" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <div class="pull-right">
                                <button v-on:click="createDirectory()" type="button" class="btn btn-primary">
                                    <span v-show="showLoadingIconButton" class="fa fa-circle-o-notch fa-spin"></span>&nbsp;
                                    Create
                                    Directory
                                </button>
                            </div>
                        </div>
                    </div>


                    <div class="directoryPanel">
                        <ul class="nav sidebar-menu">
                            <li v-for="directory in directories" class="treeview"
                                v-bind:class="{ active : directory.active }">
                                <a v-on:click.prevent="changeDirectory(directory)" href="#">
                                    {{ directory.name }} <span v-show="directory.hasSubDirectories"
                                                               class="fa fa-angle-right"></span>
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
                </div>

                <div class="overlay" v-show="loading">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>

            </div>
        </div>
    </div>
</template>


<script>
    module.exports = {
        props: {
            workingDirectory: {type: String}
        },
        data: function () {
            return {
                directories: [],              // array of dirs in hierachal
                showCreateDirectory: false,   // show the create dir form
                showLoadingIconButton: false, // show the spinner on create dir form
                newDirectoryName: '',         // default folder name for createing dir
                rootDirectory: 'media',       // the root directory
                rootParentDirectory: '',      // the roots parent directory
                homeDirectory: 'media',        // default home root, not to change
                loading: true
            }
        },

        ready: function () {
            this.refreshDirectories();
        },

        events: {
            /**
             * data =  {context,rootDirectory}
             */
            mediaManagerRequested: function (data) {
                console.log('media.js');
                console.log(data);
                console.log(this.rootDirectory);
                if (this.rootDirectory != data.rootDirectory) {
                    this.rootDirectory = data.rootDirectory;
                    console.log('refreshing dirs');
                    this.refreshDirectories();
                }
            }
        },
        methods: {
            /**
             * Retrieves the directory list from the server
             **/
            refreshDirectories: function () {
                this.loading = true;
                this.$dispatch('changeOfDirectory', this.rootDirectory);
                var data = {
                    rootDirectory: this.rootDirectory
                };
                this.$http.post('/larapress/media/directories', data).success(function (response) {
                    this.$set('directories', response.directories);
                    this.$set('rootParentDirectory', response.parent_directory);
                    this.$set('loading', false);
                }).error(function (error) {
                    console.log(error);
                });
            },

            /**
             * Changes to the directory above the current one
             */
            changeDirectoryUpLevel: function () {
                this.rootDirectory = this.rootParentDirectory;
                this.refreshDirectories();
            },

            /**
             *  Changes to the home directory
             */
            changeDirectoryToHome: function () {
                this.rootDirectory = this.homeDirectory;
                this.refreshDirectories();
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
                this.showCreateDirectory = (this.showCreateDirectory) ? false : true;
            },
            /**
             * Changes the current directory, loads files etc
             */
            createDirectory: function () {
                this.showLoadingIconButton = true;
                var data = {
                    newDirectoryName: this.newDirectoryName,
                    path: this.workingDirectory
                };
                this.$http.post('/larapress/media/create-directory', data)
                        .then(function (response) {
                            this.$set('directories', response.data.directories);
                            this.$set('showLoadingIconButton', false);
                            this.$set('showCreateDirectory', false);
                            this.$set('newDirectoryName', '');
                        }).catch(function (response) {
                            console.log(response);
                        });
            }
        }
    }
</script>
