<template id="files">
    <div v-show="display">
        <h5>Files</h5>
        <h5 v-show="files.length < 1">Directory is empty</h5>
        <ul>
            <li v-for="file in files">
                <a href="#" v-on:click="selectedFile(file.path)">@{{ file.name }}</a>
            </li>
        </ul>
    </div>
</template>

