<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import {truncateText, findUser} from "@/helperfunctions.js";
import {ref, onMounted} from 'vue';

const props = defineProps(['blogs', 'users']);
const form = useForm({
    titel: "",
});

const sortedBlogs = ref([]);

onMounted(() => {
    // Initialize sortedBlogs with the initial blogs data
    sortedBlogs.value = sortBlogs(props.blogs);
});

function sortBlogs(blogs) {
    return blogs.slice().sort((a, b) =>
        new Date(a.aangemaakt) - new Date(b.aangemaakt)
    );
}

function findBlog() {
    const searchTerm = form.titel.toLowerCase();
    const foundBlogs = props.blogs.filter(blog =>
        blog.titel.toLowerCase().includes(searchTerm) ||
        blog.inhoud.toLowerCase().includes(searchTerm)
    );
    sortedBlogs.value = sortBlogs(foundBlogs);
}
</script>

<template>
    <Head title="Blogs"/>
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-4 text-blue-500">Blogs</h1>
        <div class="flex justify-end space-x-4">

            <!-- Search Form -->
            <form @submit.prevent="findBlog" class="flex items-center">
                <input type="text" v-model="form.titel" placeholder="Search.." name="search"
                       class="inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                <button type="submit"
                        class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300">
                    <i class="fa fa-search"></i>
                </button>
            </form>

            <!-- New Blog Post Button -->
            <Link href="/blogs/create"
                  class="inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                New blog post
            </Link>
        </div>

        <div class="flex flex-wrap -mx-4">
            <div v-for="blog in sortedBlogs" :key="blog.id"
                 class="mb-6 w-full sm:w-1/2 md:w-1/2 lg:w-1/2 xl:w-1/2 px-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink pr-2">
                            <div class="rounded-full p-2 bg-gray-800">
                                <img class="h-20 w-auto rounded"
                                     :src="`/storage/uploads/${findUser(props.users, blog.gebruikersId).profielFoto}`"
                                     alt="ProfielFoto"/>
                            </div>
                        </div>
                        <div class="flex-1 text-gray-700">
                            <p class="font-semibold text-md text-blue-500">
                                {{ findUser(props.users, blog.gebruikersId).voornaam }}
                                {{ findUser(props.users, blog.gebruikersId).achternaam }}
                            </p>
                            <p class="text-gray-400 text-xs">{{ blog.aangemaakt }}</p>
                            <h2 class="text-xl font-semibold mb-2 text-blue-500">{{ blog.titel }}</h2>
                        </div>
                    </div>

                    <div class="mt-2 p-2">
                        <p class="text-gray-800 mb-4">{{ truncateText(blog.inhoud, 250) }}</p>
                    </div>

                    <div class="mt-4 p-2">
                        <Link :href="`/blogs/${blog.id}`"
                              class="inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                            Read more...
                        </Link>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
