<template>
    <div class="row">
        <div class="col-xs-12">

            <h3 class="box-title">Image Attachments</h3>

            <div class="row">
                <div class="col-xs-12">
                    <image-attachment v-for="attachment in attachments"></image-attachment>
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
        data: function () {
            return {
                attachments: [{
                    id: 1
                }, {id: 2}]
            }
        },
        methods: {
            createAttachment: function () {
                this.attachments.push({
                    id: 9
                })
            }
        }
    }
</script>