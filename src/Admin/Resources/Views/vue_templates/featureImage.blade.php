<template id="featureImage">
    <div>
        <a href="#" class="btn btn-primary" v-on:click="chooseImage()">Select Feature image</a>
        <input type="text" value="@{{ image_url }}" name="feature_image"/>
    </div>
</template>
