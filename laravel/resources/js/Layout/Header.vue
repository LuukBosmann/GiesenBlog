<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {computed, ref} from 'vue';
import {Icon} from "@iconify/vue";

let isOpen = ref(false);

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <header class="bg-giesenWhite-100 shadow-md mb-6">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-4">
            <button v-if="isOpen" @click="isOpen = false"
                    class="fixed top-0 bottom-0 right-0 left-0 w-full h-full cursor-default"/>
            <div class="flex flex-1">
                <Link href="/" class="-m-1.5 p-1.5">
                    <img class="h-12 w-auto" src="../../images/Giesen-Coffee-Roasters.png" alt="">
                </Link>
            </div>

            <div class="flex gap-x-12">
                <Link href="/" class="font-semibold leading-6 text-gray-900 hover:underline">Home</Link>
                <Link href="/blogs" class="font-semibold leading-6 text-gray-900 hover:underline">Blogs</Link>

            </div>

            <div v-if="user == null" class="flex flex-1 justify-end gap-5">
                <Link href="/login" class="font-semibold">Login</Link>
                <Link href="/register" class="font-semibold"> Sign up</Link>
            </div>

            <div @click="isOpen = !isOpen" v-else class="flex flex-1 justify-end gap-5 relative">
                <img class="h-12 w-auto" :src="`/storage/uploads/${user.profielFoto}`" alt="Profiel Foto">
                <p class="font-semibold text-gray-900">{{ user.voornaam }} {{ user.achternaam }} <br>
                    <small>{{ user.email }}</small>
                </p>
                <Icon icon="mdi:chevron-down" width="25" class="mt-[1.0rem] -ml-[1rem]"/>

                <div v-if="isOpen" id="dropdown"
                     class="absolute bg-giesenWhite-100 -right-5 z-10 top-[4.5rem] w-56 rounded shadow-lg border border-giesenWhite-200 transition-transform transform origin-top">
                    <Link href="/profile"
                          class="block px-4 py-2 hover:bg-giesenWhite-400 rounded-t transition-colors duration-300">
                        Profile
                    </Link>
                    <Link href="/myBlogs"
                          class="block px-4 py-2 hover:bg-giesenWhite-400 transition-colors duration-300">
                        My blogs
                    </Link>
                    <Link href="/myComments"
                          class="block px-4 py-2 hover:bg-giesenWhite-400 transition-colors duration-300">My comments
                    </Link>
                    <Link href="/logout" method="post"
                          class="block px-4 py-2 hover:bg-giesenWhite-400 rounded-b transition-colors duration-300">
                        Logout
                    </Link>
                </div>

            </div>
        </nav>
    </header>
</template>
