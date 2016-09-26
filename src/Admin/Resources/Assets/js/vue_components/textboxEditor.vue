<style lang="sass">
    iframe {
        height: 40rem !important;
    }
</style>

<template>
            <textarea v-bind:id="textboxId"
                      v-bind:name="textboxName"
                      class="HTMLeditor"
                      v-bind:class="textboxClass">
                {{ textboxValue }}
            </textarea>
</template>

<script>
    module.exports = {
        props: {
            textboxClass: {default: 'form-control'},        // the additional classes to add
            textboxValue: {default: ''},                    // value of the text box
            textboxName: {default: 'body'},                 // textbox name
            textboxId: {default: 'textbox1'}                // textbox ID

        },
        methods: {}
    }

</script>