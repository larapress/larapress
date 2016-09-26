<style lang="sass">
    .featureImage {

    img {
        width: 100%;
        float: left;
        margin-bottom: 1rem;
    }

    }
</style>

<template>
    <div class="featureImage">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="col-xs-10">
                    <h3 class="box-title">{{featureTitle}}</h3>
                </div>

                <div class="col-xs-2">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->


            <div class="box-body">
                <img v-show="imageUrl" v-bind:src="imageUrl"/>

                <div class="pull-right">
                    <button type="button" class="btn" v-on:click="removeImage()">
                        Remove Image
                    </button>

                    <!-- If source of image should be from media source -->
                    <button v-if="imageSource == 'media'" type="button" class="btn btn-primary"
                            v-on:click="chooseImage()">
                        {{ btnText }}
                    </button>

                    <!-- If source of image should be from uploading -->
                    <div v-if="imageSource == 'upload'" class="upload-container">
                        <upload-button
                                v-bind:upload-btn-text="btnText"
                                v-bind:upload-directory="uploadDirectory"
                                v-bind:upload-filename="uploadFilename"
                                v-bind:upload-context="context">
                        </upload-button>
                    </div>
                </div>

                <input type="hidden" value="{{ imageUrl }}" v-bind:name="featureName"/>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
</template>

<script>
    import UploadButton from './uploadButton.vue';

    module.exports = {
        components: {
            UploadButton: UploadButton
        },

        props: {
            featureName: {required:true},                                    // name of the feature image
            featureTitle: {},                                   // title to show at top of box
            featureValue: {},                                   // existing url of image

            imageSource: {default: 'upload'},                   // where the image found, 'media' or 'upload'

            rootDirectory: {default: ''},                       // rootDirectory for media manager to load
            btnText: {default: 'Select Feature Image'},         // text on the button

            uploadDirectory: {default: '/media'},               // directory to upload file to
            uploadFilename: {}                                  // name the file could be called
        },
        data: function () {
            return {
                imageUrl: false,
                context: this.featureName, // this is a name that gets passed back once file has been selected from broadcast
                loading: false
            }
        },
        events: {
            /**
             * if a file was selected from media manager then update file name
             * @param result - object containing context,value
             */
            mediaSubmitted: function (result) {
                if (result.context == this.context) this.imageUrl = result.value;
            },
            uploadSubmitted: function(result){
                if (result.context == this.context) this.imageUrl = result.value;
            }
        },
        methods: {
            /**
             * If btn pressed to select the feature image
             */
            chooseImage: function () {
                var data = {
                    context: this.context,
                    rootDirectory: 'media/' + this.rootDirectory
                };
                this.$dispatch('mediaManagerRequested', data);
            },
            removeImage: function () {
                this.$set('imageUrl', '');
            }
        },

        ready: function () {
            this.$set('imageUrl', this.featureValue);
        }
    }

</script>