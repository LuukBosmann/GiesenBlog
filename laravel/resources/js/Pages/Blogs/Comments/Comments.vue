<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import {findUser, formatDate} from "@/helperfunctions.js";

const props = defineProps(['blog', 'loggedInUserId', 'comments', 'users'])

const form = useForm({
    inhoud: '',
    blogs_id: props.blog.id,
    gebruikersId: props.loggedInUserId
});

function storeComment() {
    form.post(`/comment`);
    form.reset();
}
</script>

<template>
    <div class="flex justify-center flex-col items-center mb-5 border-t-[5px] border-giesenWhite-200">
        <h1 class="text-lg my-3">Comments</h1>
        <div class="flex flex-col w-4/6">
            <div v-for="comment in props.comments" :key="comment.id" class="mb-4">
                <div class="bg-giesenWhite-200 shadow-md rounded-md p-4">
                    <div class="border-b border-giesenWhite-300 pb-2">
                        <p class="text-lg font-semibold">
                            {{ findUser(props.users, comment.gebruikersId).voornaam }}
                            {{ findUser(props.users, comment.gebruikersId).achternaam }}
                        </p>
                    </div>
                    <p class="mt-3 leading-relaxed mb-4">{{ comment.inhoud }}</p>
                    <div
                        class="flex justify-between items-center text-xs text-gray-600 border-t border-giesenWhite-300 pt-2">
                        <div class="flex flex-col">
                            <p>Geplaatst op: {{ formatDate(comment.created_at) }}</p>
                            <p>Bijgewerkt: {{ formatDate(comment.updated_at) }}</p>
                        </div>
                        <div v-if="props.loggedInUserId && comment.gebruikersId === props.loggedInUserId"
                             class="flex space-x-2">
                            <Link :href="`/editComment/${comment.id}`" class="text-blue-500">
                                <i class="fas fa-edit"></i> Edit
                            </Link>
                            <Link :href="`/deleteComment/${comment.id}`" method="delete" class="text-red-500"
                                  as="button">
                                <i class="fas fa-trash"></i> Delete
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="props.loggedInUserId"
         class="flex justify-center flex-col items-center mb-5 border-t-[5px] border-giesenWhite-200">
        <h1 class="text-lg py-3">Write a comment</h1>
        <form @submit.prevent="storeComment" class="flex flex-col items-center w-4/6">
            <textarea name="content" id="content" v-model="form.inhoud"
                      class="bg-giesenWhite-200 shadow-md rounded-md p-4 w-full focus:outline-none focus:ring focus:border-giesenWhite-300"
                      maxlength="255" rows="4"></textarea>

            <button type="submit"
                    class="my-2 inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                Comment
            </button>
        </form>
    </div>
    <div v-else class="flex justify-center flex-col items-center mb-5 border-t-[1px]">
        <h1 class="text-lg pt-3">You are not logged in.</h1>
        <p class="pt-3">Please, log in before posting a comment.</p>
        <Link href="/login" class="font-semibold hover:underline">Login</Link>
    </div>
</template>
