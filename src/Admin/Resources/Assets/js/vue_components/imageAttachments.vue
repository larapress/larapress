<template>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{attachmentsTitle}}</h3>

            <div class="box-tools pull-right">

                <button class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row" style="margin-bottom: 0.6rem">
                <div class="col-xs-8">
                    <p>{{ attachmentsText }}</p>
                </div>
                <div class="col-xs-4">
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" v-on:click="changeLayout('grid')">
                            <span class="fa fa-th"></span>
                        </button>
                        <button type="button" class="btn btn-primary" v-on:click="changeLayout('list')">
                            <span class="fa fa-th-list"></span>
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
                                      v-bind:attachment-layout="attachmentsLayout"
                                      v-bind:attachment-caption="attachment.caption">
                    </image-attachment>
                </div>
            </div>

            <button type="button" class="btn btn-primary" v-on:click="createAttachment()">
                {{attachmentButton}}
            </button>

        </div>
        <!-- /.box-body -->

        <div class="overlay" v-show="loading">
            <i class="fa fa-refresh fa-spin"></i>
        </div>

    </div>
    <!-- /.box -->
</template>

<script>
    import ImageAttachment from './imageAttachment.vue';

    module.exports = {
        components: {
            ImageAttachment: ImageAttachment
        },
        props: {
            attachmentsTitle: {type: String},
            attachmentsPrefix: {type: String},
            attachmentsButton: {type: String, default: 'Add Another Attachment'},
            attachmentsLayout: {type: String, default: 'list'},
            attachmentsText: {type: String},

            attachmentModel: {type: String},
            attachmentModelId: {type: Number}
        },
        data: function () {
            return {
                loading: true,
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
                            this.$set('loading', false);
                        });
            },
            changeLayout: function (layout) {
                console.log(layout);
                this.attachmentsLayout = layout;
            }
        },
        ready: function () {
            this.retrieveData();
        }
    }
</script>