<style lang="sass">
    .featureImage {

    img {
        width: 100%;
        float: left;
        margin-bottom: 1rem;
    }

    }
</style>

<template>
    <div class="featureImage">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="col-xs-10">
                    <h3 class="box-title">{{featureTitle}}</h3>
                </div>

                <div class="col-xs-2">
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->


            <div class="box-body">
                <img v-show="imageUrl" v-bind:src="imageUrl"/>
                <button type="button" class="btn btn-primary pull-right" v-on:click="chooseImage()">
                    {{ btnText }}
                </button>
                <input type="hidden" value="{{ imageUrl }}" v-bind:name="featureName"/>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
</template>

<script>
    module.exports = {
        props: ['btnText', 'featureName', 'featureTitle'],

        data: function () {
            return {
                btnText: 'Select Feature Image',
                imageUrl: false,
                context: this.featureName // this is a name that gets passed back once file has been selected from broadcast
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
            }
        }
    }

</script>