<template>
    <div id="mediaManager" class="modal" tabindex="-1" role="dialog" v-bind:style="{display: display}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                     <button type="button" class="close" v-on:click="closeMediaManager()" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Media Manager</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-3">
                                <directories-component v-bind:working-Directory="working_directory"></directories-component>
                            </div>

                            <div class="col-xs-9">
                                <files-component></files-component>
                            </div>

                            <div class="col-xs-9">
                                <upload-component></upload-component>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button v-on:click="setUpload()" v-show="showing_files" class="btn btn-primary pull-left">Upload</button>
                    <button v-else v-on:click="setToShowFiles()" class="btn btn-default pull-left">Show Files</button>

                    <button type="button" class="btn btn-default" v-on:click="closeMediaManager()">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="mediaSubmit()">Confirm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
                working_directory: 'media',         // the current selected directory
                selected_file: '',                  // the file that has been selected
                working_context: '',                // this will be to identify which el/template called media manager to send back result
                showing_files: true,                // default to show files not upload
                display: 'none'                      // default to hide the media manager
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
                console.log('Working Directory: ' + this.working_directory);
            },
            /**
             * When a el/template requests the media manager
             * @param context - Identifier of the calling el/template
             */
            mediaManagerRequested: function (context) {
                this.display = 'block';
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
                this.display = 'none';
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