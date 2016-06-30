<template>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">{{ attachmentsTitle }}</h3>

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
                        <button type="button" class="btn btn-primary" v-on:click="changeLayout('grid')"
                                title="Show attachments in grid format, limited options but great for sorting the order out.">
                            <span class="fa fa-th"></span>
                        </button>
                        <button type="button" class="btn btn-primary" v-on:click="changeLayout('list')"
                                title="Show attachments in list format, ideal for filling the details">
                            <span class="fa fa-th-list"></span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12" id="sort">
                    <image-attachment v-for="attachment in attachments"
                                      data-index="{{ $index }}"
                                      v-bind:attachment-priority="attachment.priority"
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
                {{attachmentsButton}}
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
                    id: null,
                    priority: this.attachments.length
                })
                this.$dispatch('mediaManagerRequested')
            },
            /**
             * Gets the attachment data from server
             */
            retrieveData: function () {
                var data = {
                    model: this.attachmentModel,       // what sort of model ie App/Movie
                    model_id: this.attachmentModelId,  // the id of model App/Model currently ising
                    context: this.attachmentsPrefix    // the prefix of the attachment ie movie
                }

                this.$http.post('/larapress/attachments/getByModel', data)
                        .success(function (response) {
                            this.$set('attachments', response);
                            this.$set('loading', false);
                        });
            },
            changeLayout: function (layout) {
                this.attachmentsLayout = layout;
            },
            reorder: function (oldIndex, newIndex) {
                // move the item in the underlying array
                this.attachments.splice(newIndex, 0, this.attachments.splice(oldIndex, 1)[0]);
                // update order properties based on position in array
                this.attachments.forEach(function (item, index) {
                    item.order = index;
                    item.priority = index;
                });
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
            }
        },
        ready: function () {
            this.retrieveData();

            var vm = this;
            Sortable.create(document.getElementById('sort'), {
                animation: 180,
                onUpdate: function (evt) {
                    vm.reorder(evt.oldIndex, evt.newIndex);
                }
            });
        }
    }
</script>