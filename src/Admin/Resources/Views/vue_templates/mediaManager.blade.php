<template id="mediaManager">
    <div v-show="display" class="col-xs-6 col-xs-offset-3" style="margin-top: 10rem">
        <h1>Media Manager</h1>
        <h2 v-on:click="closeMediaManager()" class="pull-right">&times;</h2>
        <a href="#" v-on:click="setUpload()" v-show="showing_files">Upload</a>
        <a href="#" v-else v-on:click="setToShowFiles()">Show Files</a>

        <div class="col-xs-4">
            <h5>Directories</h5>
            <directories-component></directories-component>
        </div>

        <div class="col-xs-4">
            <files-component></files-component>
        </div>

        <div class="col-xs-4">
            <upload-component></upload-component>
        </div>

        <div class="col-xs-12">
            <a href="#" class="btn btn-primary" v-on:click="mediaSubmit()">
                Confirm
            </a>
        </div>
    </div>
</template>
