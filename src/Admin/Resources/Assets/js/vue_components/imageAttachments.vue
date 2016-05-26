<template>
    <div class="row">
        <div class="col-xs-12">

            <h3 class="box-title">Image Attachments</h3>

            <div class="row">
                <div class="col-xs-12">
                    <image-attachment></image-attachment>
                </div>
            </div>

            <button class="btn btn-primary">Add Another Attachment</button>

        </div>
    </div>
</template>

<script>
    import ImageAttachment from './imageAttachment.vue';

    module.exports = {
        components: {
            ImageAttachment: ImageAttachment
        }
    }
</script>