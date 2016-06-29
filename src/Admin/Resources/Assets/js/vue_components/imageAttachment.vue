<style lang="sass">
    .attachment {

    .list {
        width: 100%;
        float: left;
        border: 1px solid #eeeeee;
        padding: 1rem;
        margin-bottom: 0.7rem;

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
        margin: 0.5%;
        border: 1px solid #eeeeee;
        padding: 0.3rem;

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
    <div class="attachment" v-show="display">
        <div v-bind:class="attachmentLayout">
            <div class="box-body">
                <div class="image">
                    <img v-bind:src="imageUrl" class="img-responsive" title="{{imageUrl}}" v-on:click="chooseImage()"/>
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

                        <div class="pull-right">
                            <button type="button" class="btn btn-default" v-on:click="removeImage()">
                                Remove Attachment
                            </button>
                            <button type="button" class="btn btn-primary" v-on:click="chooseImage()">
                                Select Image
                            </button>
                        </div>

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
                display: true,
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
            },
            confirmationResult: function (result) {
                if (result.context == this.context && result.proceed) {
                    this.attachmentCaption = '';
                    this.attachmentAlt = '';
                    this.imageUrl = '';
                    this.display = false;
                }
            }
        },
        methods: {
            /**
             * If btn pressed to select the feature image
             */
            chooseImage: function () {
                this.$dispatch('mediaManagerRequested', this.context);
            },

            removeImage: function () {
                data = {
                    title: 'Deletion Warning',
                    message: 'Are you sure you want to remove this attachment? The image will still be kept in your media catalog, just no longer attached to this model.',
                    context: this.context,
                    id: this.attachmentId
                }
                this.$dispatch('confirmationRequested', data);
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