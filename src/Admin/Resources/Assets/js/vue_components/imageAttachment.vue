<template>
    <div>
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="col-xs-2">
                    <img v-bind:src="imageUrl" class="img-responsive"/>
                </div>
                <div class="col-xs-8">
                    <h3 class="box-title">Image: {{imageUrl}}</h3>
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
                <div class="form-horizontal">
                    <div class="form-group">
                        <label v-bind:for="imageAltName" class="col-sm-3 control-label">Alt Tag</label>

                        <div class="col-sm-9">
                            <input type="text" v-bind:value="imageAlt" v-bind:name="imageAltName" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label v-bind:for="imageAltCaption" class="col-sm-3 control-label">Display Caption</label>

                        <div class="col-sm-9">
                            <input type="text" v-bind:value="imageCaption" v-bind:name="imageCaptionName"
                                   class="form-control"/>
                        </div>
                    </div>

                    <input type="hidden" v-bind:value="imageUrl" v-bind:name="imageName"/>
                    <button type="button" class="btn btn-primary pull-right" v-on:click="chooseImage()">Select Image
                    </button>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</template>

<script>

    module.exports = {
        props: ['attachmentPrefix'],
        data: function () {
            return {
                attachmentSuffix: this.generateUniqueSuffix(),
                attachmentName: '',

                imageName: '',
                imageUrl: '',

                imageAlt: '',
                imageAltName: '',

                imageCaption: '',
                imageCaptionName: '',

                context: '' // this is a name that gets passed back once file has been selected from broadcast
            }
        },
        events: {
            /**
             * if a file was selected then update file name
             * @param result - object containing context,value
             */
            mediaSubmitted: function (result) {
                if (result.context == this.context) this.imageUrl = result.value;
            }
        },
        methods: {
            /**
             * If btn pressed to select the feature image
             */
            chooseImage: function () {
                this.$dispatch('mediaManagerRequested', this.context);
            },

            /**
             * Generate a suffix to make attachment unique by timestamp
             */
            generateUniqueSuffix: function () {
                if (!Date.now) {
                    Date.now = function () {
                        return new Date().getTime();
                    }
                }

                return '_' + Math.floor(Date.now());
            },

            /**
             * Updates the attributes of the template form
             */
            updateAllFieldAttributes: function () {
                this.attachmentName = this.attachmentPrefix + this.attachmentSuffix;
                this.imageName = this.attachmentName + '_image';
                this.imageAltName = this.attachmentName + '_alt';
                this.imageCaptionName = this.attachmentName + '_caption';
                this.context = 'attachment_' + this.attachmentName;
            }
        },

        ready: function () {
            this.updateAllFieldAttributes();
        }


    }
</script>