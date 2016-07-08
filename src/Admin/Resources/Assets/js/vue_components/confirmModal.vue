<template>
    <div id="confirmModal" class="modal" tabindex="-1" role="dialog" v-bind:style="{display: display}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" v-on:click="cancel()" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">{{ title }}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {{ message }}
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default" v-on:click="cancel()">Cancel</button>
                        <button type="button" class="btn btn-primary" v-on:click="proceed()">Confirm</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</template>

<script>
    module.exports = {
        data: function () {
            return {
                display: 'none',                     // default to hide modal
                message: 'Do you wish to proceed?',
                title: 'Confirmation',
                context: ''                             //to be able to send identifier back
            }
        },
        methods: {
            /**
             * Cancel/Deny confirmation
             */
            cancel: function () {
                this.sendResult(false);
            },
            /**
             * Proceed with affirmition
             */
            proceed: function () {
                this.sendResult(true);
            },
            /**
             * Send the result up to the root
             */
            sendResult: function (answer) {
                this.display = 'none';
                this.$dispatch('confirmationResult', {context: this.context, id: this.id, proceed: answer});
            }
        },
        events: {
            /**
             * When a el/template requests show the modal for an answer
             * @param context - Identifier of the calling el/template
             */
            confirmationRequested: function (data) {
                this.display = 'block';
                this.message = data.message;
                this.title = data.title;
                this.context = data.context;
                this.id = data.id;
            }
        }
    }
</script>