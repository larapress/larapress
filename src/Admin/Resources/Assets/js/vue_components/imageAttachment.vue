<template>
    <div>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Image: {{image_url}}</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <input type="text" value="{{ image_url }}" name="feature_image"/>
                <button type="button" class="btn btn-primary" v-on:click="chooseImage()">Select Image</button>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</template>

<script>

    module.exports = {

        data: function () {
            return {
                image_url: 'None Selected',
                context: 'attachment' // this is a name that gets passed back once file has been selected from broadcast
            }
        },
        events: {
            /**
             * if a file was selected then update file name
             * @param result - object containing context,value
             */
            mediaSubmitted: function (result) {
                if (result.context == this.context) this.image_url = result.value;
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