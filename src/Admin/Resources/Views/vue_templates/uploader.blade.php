<template id="uploader">
    <div v-show="display">
        <h5>Upload files to @{{ working_directory }} </h5>
        <form action="/larapress/media/upload" method="post" enctype="multipart/form-data">
            <input type="file" v-on:change="onFileChange" name="media_file"/>
        </form>
    </div>
</template>
