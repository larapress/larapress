<template>
    <div class="row">
        <div class="col-xs-12">

            <div class="row">
                <div class="col-xs-6">
                    <h3 class="box-title">{{listTitle}}</h3>
                </div>
                <div class="col-xs-6">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" v-on:click="changeLayout('list')">
                            <span class="fa fa-th-list"></span>
                        </button>
                        <button type="button" class="btn btn-primary"  v-on:click="changeLayout('grid')">
                            <span class="fa fa-th"></span>
                        </button>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12">
                    <image-attachment v-for="attachment in attachments"
                                      v-bind:attachment-prefix="attachmentsPrefix"
                                      v-bind:attachment-id="attachment.id"
                                      v-bind:attachment-alt="attachment.alt"
                                      v-bind:attachment-url="attachment.url"
                                      v-bind:attachment-layout="attachmentLayout"
                                      v-bind:attachment-caption="attachment.caption">
                    </image-attachment>
                </div>
            </div>

            <button type="button" class="btn btn-primary" v-on:click="createAttachment()">
                {{attachmentButton}}
            </button>

        </div>
    </div>
</template>

<script>
    import ImageAttachment from './imageAttachment.vue';

    module.exports = {
        components: {
            ImageAttachment: ImageAttachment
        },
        props: {
            listTitle: {
                type: String
            },
            attachmentsPrefix: {type: String},
            attachmentModel: {type: String},
            attachmentModelId: {type: Number},
            attachmentButton: {type: String, default: 'New one'},
            attachmentLayout: {type:String}
        },
        data: function () {
            return {
                attachments: []
            }
        },
        methods: {
            /**
             * Creates a new attachment dynamically
             */
            createAttachment: function () {
                this.attachments.push({
                    id: null
                })
            },
            /**
             * Gets the attachment data from server
             */
            retrieveData: function () {
                var data = {
                    model: this.attachmentModel,
                    model_id: this.attachmentModelId,
                    context: this.attachmentsPrefix
                }

                this.$http.post('/larapress/attachments/getByModel', data)
                        .success(function (response) {
                            this.$set('attachments', response);
                        });
            },
            changeLayout: function(layout){
                console.log(layout);
                this.attachmentLayout = layout;
            }
        },
        ready: function () {
            this.retrieveData();
        }
    }
</script>