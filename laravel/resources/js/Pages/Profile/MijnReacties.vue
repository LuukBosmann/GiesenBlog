<script setup>
import {Link} from "@inertiajs/vue3";
import {Icon} from "@iconify/vue";
import {formatDate} from "@/helperfunctions.js";

const props = defineProps(['comments', 'user']);
</script>

<template>
    <div class="flex justify-center flex-col items-center mb-5">
        <h1 class="text-lg mt-6">Uw reacties</h1>
        <div class="flex flex-col w-4/6">
            <div v-for="comment in props.comments" :key="comment.id" class="flex flex-col w-full">
                <div class="flex flex-col w-full border shadow rounded my-2">
                    <div class="border-b-[1px]">
                        <p class="ml-4 my-1 font-semibold">
                            {{ props.user.voornaam }}
                            {{ props.user.achternaam }}
                        </p>
                    </div>
                    <p class="mx-4 mt-3 leading-relaxed mb-5"> {{ comment.inhoud }} </p>
                    <div class="flex justify-between border-t-[1px] py-1">
                        <div class="ml-4 text-xs font-semibold leading-relaxed flex-col">
                            <p>Geplaatst op: {{ formatDate(comment.created_at) }}</p>
                            <p>Bijgewerkt: {{ formatDate(comment.updated_at) }}</p>
                        </div>
                        <div v-if="props.user && comment.gebruikersId === props.user.id"
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
</template>

<style scoped>

</style>
