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
                        <div class="col-xs-3">
                            <directories-component v-bind:working-Directory="working_directory">
                            </directories-component>
                        </div>

                        <div class="col-xs-9">
                            <div class="box box-solid box-default">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-xs-10">
                                            <p>Dir: {{ working_directory }}</p>
                                        </div>
                                        <div class="col-xs-2 pull-right">
                                            <upload-button upload-btn-text="Upload"
                                                           v-bind:upload-directory="working_directory"
                                                           upload-context="mediaManager"
                                                           classes="btn btn-primary pull-right">
                                            </upload-button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <files-component></files-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            v-on:click="closeMediaManager()">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" v-on:click="mediaSubmit()">
                        Confirm
                    </button>
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
    import UploadButton from './uploadButton.vue';

    module.exports = {
        components: {
            DirectoriesComponent: DirectoriesComponent,
            FilesComponent: FilesComponent,
            UploadButton: UploadButton
        },

        data: function () {
            return {
                working_directory: '/media',        // the current selected directory
                selected_file: '',                  // the file that has been selected
                working_context: '',                // this will be to identify which el/template called media manager to send back result
                showing_files: true,                // default to show files not upload
                display: 'none'                     // default to hide the media manager
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
             * @param data =  {context,rootDirectory}
             */
            mediaManagerRequested: function (data) {
                this.display = 'block';
                this.working_context = data.context;
                this.working_directory = 'media/' + data.rootDirectory;

                //pass on down the call to refresh directories
                this.$broadcast('mediaManagerRequested', data);
            },
            /**
             * When a file is selected
             * @param filename - string url name for the file
             */
            fileSelected: function (response) {
                this.selected_file = response.selectedFile;

                if (response.proceed) this.mediaSubmit();
            },
            /**
             * When a file is uploaded
             */
            uploadSubmitted: function (response) {
                if (response.context == 'mediaManager') {
                    this.$broadcast('fileUploaded', response.data);
                }
            }
        },
        methods: {
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