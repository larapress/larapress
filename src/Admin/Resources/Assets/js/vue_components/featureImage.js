var featureImage = Vue.extend({
    template: '#featureImage',
    data: function () {
        return {
            image_url: 'None Selected',
            context: 'featureImage' // this is a name that gets passed back once file has been selected from broadcast
        }
    },
    events:{
        /**
         * if a file was selected then update file name
         * @param result - object containing context,value
         */
        mediaSubmitted: function(result){
            if(result.context == 'featureImage') this.image_url = result.value;
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
});

