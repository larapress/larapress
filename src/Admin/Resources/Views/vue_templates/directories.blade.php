<template id="directories">
    <ul>
        <li v-for="directory in directories">
            <a v-on:click="changeDirectory(directory.path)" href="#">@{{ directory.name }}</a>
            <ul>
                <li v-for="sub_directory in directory.sub_directories">
                    <a v-on:click="changeDirectory(sub_directory.path)" href="#">@{{ sub_directory.name }}</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

