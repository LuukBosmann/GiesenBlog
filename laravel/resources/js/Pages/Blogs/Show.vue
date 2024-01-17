<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import {formatDate, findUser, truncateText} from "@/helperfunctions.js";
import {Icon} from "@iconify/vue";

const props = defineProps(['blog', 'user', 'users', 'comments', 'loggedInUserId']);

let user = props.user;
let users = props.users;

const form = useForm({
    inhoud: '',
    blogId: props.blog.id,
    gebruikersId: props.loggedInUserId
});

function storeComment() {
    form.post(`/comment`);
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
                                    <div class="ml-4 text-xs font-semibold leading-relaxed flex-col">
                                        <p>Geplaatst op: {{ formatDate(comment.created_at) }}</p>
                                        <p>Bijgewerkt: {{ formatDate(comment.updated_at) }}</p>
                                    </div>
                                    <div v-if="props.loggedInUserId && comment.gebruikersId === props.loggedInUserId" class="flex">
                                        <Link :href="`/comment/${comment.id}`" method="delete" class="text-lg mr-4" as="button">
                                            <Icon icon="mdi:trash"/>
                                        </Link>
                                        <Link :href="`/comment/${comment.id}/edit`" class="text-lg mr-4" as="button">
                                            <Icon icon="mdi:edit"/>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center flex-col items-center mb-5 border-t-[1px]">
                    <h1 class="text-lg pt-3">Write a comment</h1>
                    <form @submit.prevent="storeComment" class="flex flex-col items-center w-4/6">
                        <textarea name="content" id="content" v-model="form.inhoud"
                                  class="border border-giesenBlue rounded-md p-2 w-full resize-none"
                                  maxlength="255" rows="4"/>
                        <button type="submit"
                                class="bg-giesenBlue text-giesenWhite-400 rounded-lg py-2 px-4 mt-2 hover:bg-giesenDarkBlue w-1/5">
                            Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
