<script setup>
import { Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { formatDate } from "@/helperfunctions.js";

const props = defineProps(['comments', 'user']);
</script>

<template>
    <div class="flex justify-center flex-col items-center mb-5">
        <h1 class="text-lg my-6">Your comments</h1>
        <div class="flex flex-col w-4/6">
            <div v-for="comment in props.comments" :key="comment.id" class="mb-4">
                <div class="bg-giesenWhite-200 shadow-md rounded-md p-4">
                    <div class="border-b border-giesenWhite-300 pb-2">
                        <p class="text-lg font-semibold">
                            {{ props.user.voornaam }}
                            {{ props.user.achternaam }}
                        </p>
                    </div>
                    <p class="mt-3 leading-relaxed mb-4">{{ comment.inhoud }}</p>
                    <div
                        class="flex justify-between items-center text-xs text-gray-600 border-t border-giesenWhite-300 pt-2">
                        <div class="flex flex-col">
                            <p>Posted on: {{ formatDate(comment.created_at) }}</p>
                            <p>Updated at: {{ formatDate(comment.updated_at) }}</p>
                        </div>
                        <div v-if="props.loggedInUserId && comment.gebruikersId === props.loggedInUserId"
                            class="flex space-x-2">
                            <Link :href="`/reactieBewerken/${comment.id}`" class="text-blue-500">
                            <i class="fas fa-edit"></i> Edit
                            </Link>
                            <Link :href="`/deleteComment/${comment.id}`" method="delete" class="text-red-500" as="button">
                            <i class="fas fa-trash"></i> Delete
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
