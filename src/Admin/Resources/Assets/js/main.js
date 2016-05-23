Vue.component('directories-component', directoriesComponent);
Vue.component('files-component', filesComponent);
Vue.component('upload-component', uploadComponent);
Vue.component('media-manager', mediaManager);
Vue.component('feature-image', featureImage);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf_token"]').attr('content');

new Vue({
    el: 'body',
    events: {
        /**
         * if an event occurs anywhere requesting the media manager
         * @param context - hook name to identify request element/template
         */
        mediaManagerRequested: function(context){
            this.$broadcast('mediaManagerRequested', context);
        },
        /**
         * if the media manager has had the submit btn pressed
         * @param result - object with the files,context.
         */
        mediaSubmitted: function(result){
            this.$broadcast('mediaSubmitted', result);
        }
    },
    methods: {
        /**
         * if an el directly requests for media manager, show it
         */
        requestMediaManager:function(){
            this.$broadcast('mediaManagerRequested');
        }
    }
});



