<script setup>
import {Head, Link} from '@inertiajs/vue3';
import axios from "axios";
import {computed, onMounted, ref} from "vue";
import {truncateText} from "@/helperfunctions.js";

const props = defineProps(['blogs']);

const blogs = ref([]);

const sortedBlogs = computed(() => {
    return blogs.value.slice().sort((a, b) =>
        new Date(a.aangemaakt) - new Date(b.aangemaakt)
    );
});

onMounted(async () => {
    blogs.value = await Promise.all(
        props.blogs.map(async (blog) => {
            const gebruiker = (await axios.get(`/getUser/${blog.gebruikersId}`)).data;
            return {...blog, gebruiker};
        })
    );
});
</script>

<template>
    <Head title="Blogs"/>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-4 text-giesenBlue">Blogs</h1>
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
                                            <img class="h-20 w-auto rounded"
                                                 :src="`/storage/uploads/${blog.gebruiker.profielFoto}`"
                                                 alt="ProfielFoto"/>
                                        </div>
                                    </div>
                                    <div class="flex-1 text-giesenWhite-300">
                                        <p class="font-semibold text-lg text-giesenDarkBlue">
                                            {{ blog.gebruiker.voornaam }} {{ blog.gebruiker.achternaam }}
                                        </p>
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
