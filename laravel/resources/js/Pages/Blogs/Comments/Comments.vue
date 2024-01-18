<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import {Icon} from "@iconify/vue";
import {findUser, formatDate} from "@/helperfunctions.js";

const props = defineProps(['blog', 'loggedInUserId', 'comments', 'users'])

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
    <div class="flex justify-center flex-col items-center mb-5">
        <h1 class="text-lg mt-6">Comments</h1>
        <div class="flex flex-col w-4/6">
            <div v-for="comment in props.comments" :key="comment.id" class="flex flex-col w-full">
                <div class="flex flex-col w-full border shadow rounded my-2">
                    <div class="border-b-[1px]">
                        <p class="ml-4 my-1 font-semibold">
                            {{ findUser(props.users, comment.gebruikersId).voornaam }}
                            {{ findUser(props.users, comment.gebruikersId).achternaam }}
                        </p>
                    </div>
                    <p class="mx-4 mt-3 leading-relaxed mb-5"> {{ comment.inhoud }} </p>
                    <div class="flex justify-between border-t-[1px] py-1">
                        <div class="ml-4 text-xs font-semibold leading-relaxed flex-col">
                            <p>Geplaatst op: {{ formatDate(comment.created_at) }}</p>
                            <p>Bijgewerkt: {{ formatDate(comment.updated_at) }}</p>
                        </div>
                        <div v-if="props.loggedInUserId && comment.gebruikersId === props.loggedInUserId"
                             class="flex">
                            <Link :href="`/reactieBewerken/${comment.id}`" class="text-lg mr-2 pt-[0.7rem]">
                                <Icon icon="mdi:edit"/>
                            </Link>
                            <Link :href="`/deleteComment/${comment.id}`" method="delete" class="text-lg mr-4"
                                  as="button">
                                <Icon icon="mdi:trash"/>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="props.loggedInUserId" class="flex justify-center flex-col items-center mb-5 border-t-[1px]">
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
    <div v-else class="flex justify-center flex-col items-center mb-5 border-t-[1px]">
        <h1 class="text-lg pt-3">U bent nog niet ingelogd</h1>
        <p class="pt-3">Graag eerst inloggen voordat u een reactie plaatst.</p>
        <Link href="/login" class="font-semibold hover:underline">Inloggen</Link>
    </div>
</template>

<style scoped>

</style>
