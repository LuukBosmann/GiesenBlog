<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {formatDate, truncateText} from "@/helperfunctions.js";
import Comments from "@/Pages/Blogs/Comments/Comments.vue";

const props = defineProps(['blog', 'user', 'users', 'comments', 'loggedInUserId']);

let user = props.user;
let users = props.users;

</script>

<template>
    <Head :title="`Blogs | ${truncateText(props.blog.titel, 25)}`"/>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <Link href="/blogs" class="px-4 py-2 bg-indigo-500 hover:bg-indico-600 text-white rounded">Back</Link>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
                <div class="mt-3" v-if="props.loggedInUserId && props.blog.gebruikersId === props.loggedInUserId">
                    <Link :href="`/blogs/${props.blog.id}`" method="delete" as="button"
                          class="float-right mr-3 inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700  sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </Link>
                    <Link :href="`/blogs/${props.blog.id}/edit`"
                          class="float-right inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700  sm:ml-3 sm:w-auto sm:text-sm">
                        Edit
                    </Link>
                </div>
                <div class="container mx-auto flex flex-wrap pt-6">
                    <div class="w-full md:w-1/2 flex flex-col flex-grow flex-shrink">
                        <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                            <div class="w-full flex flex-col items-center">
                                <p class="w-10/12 text-gray-600 text-sm md:text-base">Posted by {{ user.voornaam }}
                                    {{ user.achternaam }} on
                                    {{ formatDate(props.blog.aangemaakt) }}</p>
                                <div class="w-10/12 font-bold text-3xl text-gray-900 mb-6">{{ props.blog.titel }}</div>
                            </div>
                            <div class="w-10/12 py-4 flex flex-row m-auto">
                                <div class="text-gray-800 font-serif text-base mb-5 mt-5 w-6/12 whitespace-pre-wrap">
                                    {{ props.blog.inhoud }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <Comments :blog="props.blog" :loggedInUserId="props.loggedInUserId"
                          :comments="props.comments" :users="props.users"/>
            </div>
        </div>
    </div>
</template>
