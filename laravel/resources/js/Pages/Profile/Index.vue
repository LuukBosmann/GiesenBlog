<script setup>
import {Head, Link} from "@inertiajs/vue3";
import {formatDate} from "@/helperfunctions.js";

const props = defineProps(['user', 'profielFoto']);
</script>

<template>
    <Head title="Profile"/>
    <div class="w-1/2 shadow-md rounded-md grid grid-cols-2 gap-4 bg-giesenBlue mx-auto">
        <div class="p-5">
            <h2 class="text-2xl font-semibold text-center">Profile</h2>
            <div class="flex justify-between">
                <span>First name</span>
                <span>{{ props.user['voornaam'] }}</span>
            </div>
            <div class="mt-4 flex justify-between">
                <span>Last name</span>
                <span>{{ props.user['achternaam'] }}</span>
            </div>
            <div class="mt-4 flex justify-between">
                <span>Email</span>
                <span>{{ props.user['email'] }}</span>
            </div>
            <div class="mt-4 flex  justify-between">
                <span>Joined</span>
                <span>{{ formatDate(props.user['created_at']) }}</span>
            </div>
            <div class="mt-4 flex justify-between">
                <span>Last edit</span>
                <span>{{ formatDate(props.user['updated_at']) }}</span>
            </div>
            <div class="mt-8 flex flex-col gap-4">
                <Link href="/editProfile"
                      class="bg-giesenDarkBlue rounded py-1.5 hover:bg-giesenBlack text-center shadow-md">
                    Edit profile
                </Link>
                <Link class="bg-giesenDarkBlue rounded py-1.5 hover:bg-giesenBlack text-center shadow-md"
                      href="/editPassword">
                    Edit password
                </Link>
            </div>
        </div>
        <div class="flex flex-col items-center">
            <h2 class="text-2xl font-semibold text-center mt-4 ">{{ props.user['voornaam'] }}
                {{ props.user['achternaam'] }}</h2>
            <p class="text-sm text-center mt-2 mb-2">{{ props.user['email'] }}</p>
            <div class="w-1/2">
                <img :src="props.profielFoto" alt="Profiel Foto" class="rounded-3xl">
            </div>
        </div>
    </div>
</template>

<style scoped>
* {
    color: #EEEEF0;
}
</style>
