<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {truncateText, findUser} from "@/helperfunctions.js";

const props = defineProps(['blogs', 'users']);

const sortedBlogs = () => {
    return props.blogs.slice().sort((a, b) =>
        new Date(a.aangemaakt) - new Date(b.aangemaakt)
    );
};

</script>

<template>
    <Head title="Blogs"/>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-4 text-giesenBlue">Blogs</h1>
        <div class="flex justify-end">
            <Link href="/blogs/create" class="px-4 py-2 text-giesenBlue">Nieuwe blog post</Link>
        </div>

        <div class="flex flex-wrap -mx-4">
            <div v-for="blog in sortedBlogs()" :key="blog.id" class="mb-6 w-1/2 px-4">
                <div class="container mx-auto">
                    <div class="flex">
                        <div class="p-3">
                            <div class="bg-giesenWhite-100 rounded-lg shadow p-6">
                                <div class="flex flex-row items-center">
                                    <div class="flex-shrink pr-2">
                                        <div class="rounded-full p-2 bg-gray-800">
                                            <img class="h-20 w-auto rounded"
                                                 :src="`/storage/uploads/${findUser(blog.gebruikersId).profielFoto}`"
                                                 alt="ProfielFoto"/>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-giesenWhite-300">
                                        <p class="font-semibold text-md text-giesenDarkBlue">
                                            {{ findUser(blog.gebruikersId).voornaam }} {{ findUser(blog.gebruikersId).achternaam }}
                                        </p>
                                        <p class="text-gray-400 text-xs">{{ blog.aangemaakt }}</p>
                                        <h2 class="text-xl font-semibold mb-2 text-giesenDarkBlue">{{ blog.titel }}</h2>
                                    </div>
                                </div>

                                <div class="mt-2 p-2">
                                    <p class="text-giesenBlack mb-4">{{ truncateText(blog.inhoud, 250) }}</p>
                                </div>

                                <div class="mt-2 p-2">
                                    <Link :href="`/blogs/${blog.id}`" class="bg-giesenBlue text-giesenWhite-400 rounded-2xl py-2 px-4 hover:bg-giesenDarkBlue">
                                        Lees meer...
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
