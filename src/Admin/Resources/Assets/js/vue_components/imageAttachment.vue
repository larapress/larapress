<style lang="sass">
    .attachment {
    .list {
        width: 100%;
        float: left;
    .image {
        float: left;
        padding-right: 1rem;
        width: 20%;
    }
    .form {
        float: right;
        padding-left: 1rem;
        width: 80%;
    }
    }

    .grid {
        float: left;
        width: 19%;
        margin:0.5%;
    .image {
        float: left;
        width: 100%;
    }
    .form {
        display: none;
    }
    }

    }

</style>


<template>
    <div class="attachment">
        <div class="box box-default" v-bind:class="attachmentLayout">
            <div class="box-body">
                <div class="image">
                    <img v-bind:src="imageUrl" class="img-responsive" title="{{imageUrl}}"/>
                </div>

                <div class="form">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label v-bind:for="imageAltName" class="col-sm-3 control-label">Alt Tag</label>

                            <div class="col-sm-9">
                                <input type="text" v-bind:value="attachmentAlt" v-bind:name="imageAltName"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label v-bind:for="imageCaptionName" class="col-sm-3 control-label">Display Caption</label>

                            <div class="col-sm-9">
                                <input type="text" v-bind:value="attachmentCaption" v-bind:name="imageCaptionName"
                                       class="form-control"/>
                            </div>
                        </div>

                        <input type="hidden" v-bind:value="attachmentId" v-bind:name="imageIdName"/>
                        <input type="hidden" v-bind:value="imageUrl" v-bind:name="imageName"/>
                        <button type="button" class="btn btn-primary pull-right" v-on:click="chooseImage()">Select Image
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    module.exports = {
        props: ['attachmentPrefix', 'attachmentId', 'attachmentAlt', 'attachmentCaption', 'attachmentUrl', 'attachmentLayout'],
        data: function () {
            return {
                attachmentSuffix: this.generateUniqueSuffix(),
                attachmentName: '',

                imageUrl: '',

                imageName: '', //name tag attribute names for the fields
                imageAltName: '',
                imageCaptionName: '',
                imageIdName: '',

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
                this.imageName = this.attachmentName + '_url';
                this.imageAltName = this.attachmentName + '_alt';
                this.imageCaptionName = this.attachmentName + '_caption';
                this.imageIdName = this.attachmentName + '_id';
                this.context = 'attachment_' + this.attachmentName;
                this.imageUrl = this.attachmentUrl;
            }
        },

        ready: function () {
            this.updateAllFieldAttributes();
        }


    }
</script>