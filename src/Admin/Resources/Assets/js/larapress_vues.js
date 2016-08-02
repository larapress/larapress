var Vue = require('vue');

Vue.use(require('vue-resource'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf_token').getAttribute('content');

import MediaManager from './vue_components/mediaManager.vue';
import FeatureImage from './vue_components/featureImage.vue';
import ImageAttachments from './vue_components/imageAttachments.vue';
import ConfirmModal from './vue_components/confirmModal.vue';
import PostCategories from './vue_components/postCategories.vue';

new Vue({
    el: 'body',

    components: {
        MediaManager: MediaManager,
        FeatureImage: FeatureImage,
        ImageAttachments: ImageAttachments,
        ConfirmModal: ConfirmModal,
        PostCategories: PostCategories
    },
    ready: function () {
        console.log(Vue.http.headers.common['X-CSRF-TOKEN']);
    },
    events: {
        /**
         * if an event occurs anywhere requesting the media manager
         * @param data - obj
         */
        mediaManagerRequested: function (data) {
            this.$broadcast('mediaManagerRequested', data);
        },
        /**
         * if the media manager has had the submit btn pressed
         * @param result - object with the files,context.
         */
        mediaSubmitted: function (result) {
            this.$broadcast('mediaSubmitted', result);
        },


        /**
         * Broadcast to say confirmation modal is requested
         * @param data
         */
        confirmationRequested: function(data){
            this.$broadcast('confirmationRequested', data);
        },
        /**
         * Broadcast confirmation was selected
         * @param result
         */
        confirmationResult: function(result){
            this.$broadcast('confirmationResult', result);
        }

    },
    methods: {
        /**
         * if an el directly requests for media manager, show it
         */
        requestMediaManager: function () {
            this.$broadcast('mediaManagerRequested');
        }
    }
});

