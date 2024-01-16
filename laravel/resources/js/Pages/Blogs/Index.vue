<script setup>
import Layout from "../../Layout/Layout.vue";
import {Icon} from '@iconify/vue';
import {Head, Link} from '@inertiajs/vue3';

</script>


<template>

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-4 text-giesenBlue">Blogs</h1>
        <div class="flex flex-wrap -mx-4">
            <div v-for="blog in sortedBlogs" :key="blog.id" class="mb-6 w-1/2 px-4">
                <div class="bg-giesenWhite-100 border-2 border-giesenWhite-300 rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-2 text-giesenDarkBlue">{{ blog.titel }}</h2>
                    <p class="text-giesenBlack mb-4">{{ truncateText(blog.inhoud, 250) }}</p>
                    <p class="text-giesenBlue">{{ blog.aangemaakt }}</p>
                    <!-- Add a button to edit the blog post -->
                    <Link :href="`/blogs/${blog.id}/edit`">
                        <button type="button"
                                class="float-right inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Edit
                        </button>
                    </Link>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="w-full h-full bg-giesenWhite-300">
    <div class="grid grid-cols-3 gap-10 justify-between mx-20">

    <div class="container mx-auto">
        <div class="flex">
            <div class="p-3">
                <div class="bg-giesenBlue rounded shadow">
                    <div class="flex flex-row items-center">
                        <div class="flex-shrink pr-2">
                            <div class="rounded-full p-2 bg-gray-800">
                                <img class="w-12 h-12" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200" />
                            </div>
                        </div>
                        <div class="flex-1 text-giesenWhite-300">
                            <a href="#" class="font-semibold text-lg">John Doe</a>
                            <p class="text-gray-400 text-xs">Sat, 10 Oct 2020 12:00 PM</p>
                        </div>
                    </div>

                    <div class="mt-2 p-2">
                        <p class="text-giesenWhite-100">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vel mi ut felis tempus commodo nec id erat. Suspendisse consectetur dapibus velit ut lacinia. </p>
                    </div>
                    <div class="flex flex-row items-center bg-giesenDarkBlue h-10 rounded">
                        <div class="flex-1 text-sm">
                            <a href="#" class="text-giesenWhite-300 hover:text-gray-200 flex justify-center">
                                <span class="iconify"><Icon icon="mdi:comment-outline" /></span>
                                <span class="ml-1">2 comments</span>

                            </a>
                        </div>
                        <div class="flex-1 text-sm">
                            <a href="#" class="text-giesenWhite-300 hover:text-gray-200 flex justify-center">
                                <span class="iconify"><Icon icon="mdi:share-outline" /></span>
                                <span class="ml-1">Share</span>
                            </a>
                        </div>
                        <div class="flex-1 text-sm">
                            <a href="#" class="text-giesenWhite-300 hover:text-gray-200 flex justify-center">
                                <span class="iconify"><Icon icon="mdi:bookmark-outline" /></span>
                                <span class="ml-1">Save</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->
</template>

<script>
export default {
    props: {
        blogs: Array, // Make sure to specify the correct prop type
    },
    computed: {
        sortedBlogs() {
            // Sort the blogs array by 'aangemaakt' property in descending order
            return this.blogs.slice().sort((a, b) => new Date(b.aangemaakt) - new Date(a.aangemaakt));
        },
    },
    methods: {
        truncateText(text, maxLength) {
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        },
    },
};
</script>
