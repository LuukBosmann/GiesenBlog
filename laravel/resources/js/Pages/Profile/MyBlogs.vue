<script setup>
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { truncateText, findUser } from "@/helperfunctions.js";

const props = defineProps(['blogs', 'user']);
</script>

<template>
    <div class="flex justify-center flex-col items-center mb-5">
        <h1 class="text-lg mt-6">Your posts</h1>
        <div class="flex flex-col w-4/6">
            <div v-for="blog in props.blogs" :key="blog.id" class="flex flex-col w-full">
                <div class="container mx-auto flex p-3">
                    <div class="bg-giesenWhite-100 rounded-lg shadow p-6">
                        <div class="flex flex-row items-center">
                            <div class="flex-1 text-giesenWhite-300">
                                <p class="text-gray-400 text-xs">{{ blog.aangemaakt }}</p>
                                <h2 class="text-xl font-semibold mb-2 text-giesenDarkBlue">{{ blog.titel }}</h2>
                            </div>
                        </div>

                        <div class="mt-2 p-2">
                            <p class="text-giesenBlack mb-4">{{ truncateText(blog.inhoud, 250) }}</p>
                        </div>

                        <div class="mt-2 p-2">
                            <Link :href="`/blogs/${blog.id}`"
                                class="inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                            Read more...
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
