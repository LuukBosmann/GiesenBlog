<script setup>
import {Head, Link, useForm, usePage} from '@inertiajs/vue3';
import {formatDate, findUser, truncateText} from "@/helperfunctions.js";
import {Icon} from "@iconify/vue";
import {computed} from "vue";

const props = defineProps(['blog', 'user', 'users', 'comments']);

let user = props.user;
let users = props.users;

const page = usePage();
const loggedInUser = computed(() => page.props.auth.user);

const form = useForm({
    content: null,
});

function storeComment() {
    form.post(`/blog/${props.blog.id}/comment`);
    form.reset();
}
</script>

<template>
    <Head :title="`Blogs | ${truncateText(props.blog.titel, 25)}`"/>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <Link href="/blogs" class="px-4 py-2 bg-indigo-500 hover:bg-indico-600 text-white rounded">Back</Link>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
                <div class="mt-3" v-if="loggedInUser && props.blog.gebruikersId === loggedInUser.id">
                    <Link :href="`/blogs/${props.blog.id}`" method="delete" type="button"
                          class=" float-right mr-3 inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700  sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </Link>
                    <Link :href="`/blogs/${props.blog.id}/edit`">
                        <button type="button"
                                class=" float-right inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Edit
                        </button>
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
                <div class="flex justify-center flex-col items-center mb-5">
                    <h1 class="text-lg mt-6">Comments</h1>
                    <div class="flex flex-col w-4/6">
                        <div v-for="comment in comments" :key="comment.id" class="flex flex-col w-full">
                            <div class="flex flex-col w-full border shadow rounded my-2">
                                <div class="border-b-[1px]">
                                    <p class="ml-4 my-1 font-semibold">
                                        {{ findUser(users, comment.gebruikersId).voornaam }}
                                        {{ findUser(users, comment.gebruikersId).achternaam }} </p>
                                </div>
                                <p class="mx-4 mt-3 leading-relaxed mb-5"> {{ comment.inhoud }} </p>
                                <div class="flex justify-between border-t-[1px] py-1">
                                    <p class="ml-4 text-sm leading-relaxed">
                                        Geplaatst op: {{ formatDate(comment.created_at) }}
                                    </p>
                                    <div v-if="loggedInUser && comment.gebruikersId === loggedInUser.id" class="flex">
                                        <Link :href="`/comment/${comment.id}`" method="delete" class="text-lg mr-4">
                                            <Icon icon="mdi:trash"/>
                                        </Link>
                                        <Link :href="`/comment/${comment.id}/edit`" class="text-lg mr-4">
                                            <Icon icon="mdi:edit"/>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center flex-col items-center mb-5">
                    <h1 class="text-lg">Write a comment</h1>
                    <form @submit.prevent="storeComment" class="flex flex-col items-center w-4/6">
                        <textarea name="content" id="content" v-model="form.content"
                                  class="mb-5 w-full rounded resize-none" maxlength="255" rows="4"></textarea>
                        <button type="submit"
                                class="inline-flex w-2/6 justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700 sm:ml-3 sm:text-sm">
                            Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
