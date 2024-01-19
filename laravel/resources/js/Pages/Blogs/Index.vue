<script setup>
import Layout from "../../Layout/Layout.vue";
import {Icon} from '@iconify/vue';
import {Head, Link} from '@inertiajs/vue3';

</script>


<template>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-4 text-giesenBlue">Blogs</h1>
        <!-- button to create new blog post -->
        <div class="flex justify-end">
            <Link href="/blogs/create" class="px-4 py-2 text-giesenBlue">Nieuwe blog post</Link>
        </div>


        <div class="flex flex-wrap -mx-4">
            <div v-for="blog in sortedBlogs" :key="blog.id" class="mb-6 w-1/2 px-4">
                <div class="container mx-auto">
                    <div class="flex">
                        <div class="p-3">
                            <div class="bg-giesenWhite-100 rounded-lg shadow p-6">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-2">
                                        <div class="rounded-full p-2 bg-gray-800">
                                            <img class="w-16 h-16"
                                                 src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=200"/>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-giesenWhite-300">
                                        <a href="#" class="font-semibold text-lg text-giesenDarkBlue">
                                            {{ getUserInfo(blog.gebruikersId) }}


                                        </a>
                                        <p class="text-gray-400 text-xs">{{ blog.aangemaakt }}</p>
                                        <h2 class="text-xl font-semibold mb-2 text-giesenDarkBlue">{{ blog.titel }}</h2>
                                    </div>
                                </div>

                                <div class="mt-2 p-2">
                                    <p class="text-giesenBlack mb-4">{{ truncateText(blog.inhoud, 250) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        getUserInfo(userId) {

            // hier moet een functie komen die de voornaam en achternaam ophaalt uit de database

            // voor nu return ik alleen de userId
            return userId;

        },
        getUserImage(userId) {

            // hier moet een functie komen die de profielfoto ophaalt uit de database

        }
    },
};
</script>
