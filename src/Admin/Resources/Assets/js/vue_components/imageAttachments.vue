<template>
    <div class="row">
        <div class="col-xs-12">

            <h3 class="box-title">{{listTitle}}</h3>

            <div class="row">
                <div class="col-xs-12">
                    <image-attachment v-for="attachment in attachments"
                                      v-bind:attachment-prefix="attachmentsPrefix"
                                      v-bind:attachment-id="attachment.id"
                                      v-bind:attachment-alt="attachment.alt"
                                      v-bind:attachment-url="attachment.url"
                                      v-bind:attachment-caption="attachment.caption">
                    </image-attachment>
                </div>
            </div>

            <button type="button" class="btn btn-primary" v-on:click="createAttachment()">Add Another Attachment
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
        props: ['listTitle', 'attachmentsPrefix', 'attachmentModel', 'attachmentModelId'],
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
            }
        },
        ready: function () {
            this.retrieveData();
        }
    }
</script>