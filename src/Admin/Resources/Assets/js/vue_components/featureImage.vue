<template>
    <div>
        <button class="btn btn-primary pull-right" v-on:click="chooseImage()">Select Feature image</button>
        <input type="hidden" value="{{ image_url }}" name="feature_image"/>
    </div>
</template>

<script>
    module.exports = {

        data: function () {
            return {
                image_url: 'None Selected',
                context: 'featureImage' // this is a name that gets passed back once file has been selected from broadcast
            }
        },
        events: {
            /**
             * if a file was selected then update file name
             * @param result - object containing context,value
             */
            mediaSubmitted: function (result) {
                if (result.context == 'featureImage') this.image_url = result.value;
            }
        },
        methods: {
            /**
             * If btn pressed to select the feature image
             */
            chooseImage: function () {
                this.$dispatch('mediaManagerRequested', this.context);
            }
        }
    }

</script>