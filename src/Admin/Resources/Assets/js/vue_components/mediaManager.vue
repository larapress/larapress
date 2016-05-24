<template>
    <div v-show="display" class="col-xs-6 col-xs-offset-3" style="margin-top: 10rem">
        <h1>Media Manager</h1>

        <h2 v-on:click="closeMediaManager()" class="pull-right">&times;</h2>
        <a href="#" v-on:click="setUpload()" v-show="showing_files">Upload</a>
        <a href="#" v-else v-on:click="setToShowFiles()">Show Files</a>

        <div class="col-xs-4">
            <h5>Directories</h5>
            <directories-component></directories-component>
        </div>

        <div class="col-xs-4">
            <files-component></files-component>
        </div>

        <div class="col-xs-4">
            <upload-component></upload-component>
        </div>

        <div class="col-xs-12">
            <a href="#" class="btn btn-primary" v-on:click="mediaSubmit()">
                Confirm
            </a>
        </div>
    </div>
</template>

<script>
    import DirectoriesComponent from './directory.vue';
    import FilesComponent from './filesComponent.vue';
    import UploadComponent from './uploadComponent.vue';

    module.exports = {
        components: {
            DirectoriesComponent: DirectoriesComponent,
            FilesComponent: FilesComponent,
            UploadComponent: UploadComponent
        },

        data: function () {
            return {
                working_directory: 'media/images',  // the current selected directory
                selected_file: '',                  // the file that has been selected
                working_context: '',                // this will be to identify which el/template called media manager to send back result
                showing_files: true,                // default to show files not upload
                display: false                      // default to hide the media manager
            }
        },
        //change the directory/refresh on load
        ready: function () {
            this.$broadcast('changeOfDirectory', this.working_directory);
        },
        events: {
            changeOfDirectory: function (directory) {
                this.working_directory = directory;
                this.$broadcast('changeOfDirectory', directory);
            },
            /**
             * When a el/template requests the media manager
             * @param context - Identifier of the calling el/template
             */
            mediaManagerRequested: function (context) {
                this.display = true;
                this.working_context = context;
            },
            /**
             * When a file is selected
             * @param filename - string url name for the file
             */
            fileSelected: function (file) {
                this.selected_file = file;
            }
        },
        methods: {
            /**
             * if upload btn pressed to show upload screen
             */
            setUpload: function () {
                this.showing_files = false;
                this.$broadcast('changeToUpload');
            },
            /**
             * if files btn pressed to show files and hide upload
             */
            setToShowFiles: function () {
                this.showing_files = true;
                this.$broadcast('changeToShowFiles');
            },
            /**
             * if the close btn has been pressed
             */
            closeMediaManager: function () {
                this.display = false;
            },
            /**
             * when the user submits the media manager
             */
            mediaSubmit: function () {
                this.closeMediaManager();
                this.$dispatch('mediaSubmitted',
                        {
                            context: this.working_context,
                            value: this.selected_file
                        }
                );
            }
        }
    }
</script>