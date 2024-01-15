<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {computed} from 'vue';
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue';
import {ChevronDownIcon} from '@heroicons/vue/20/solid'

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>

<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-4" aria-label="Global">
            <div class="flex flex-1">
                <Link href="/" class="-m-1.5 p-1.5">
                    <img class="h-12 w-auto" src="../../images/Giesen-Coffee-Roasters.png" alt="">
                </Link>
            </div>

            <div class="flex gap-x-12">
                <Link href="/" class=" font-semibold leading-6 text-gray-900">Home</Link>
                <Link href="#" class=" font-semibold leading-6 text-gray-900">Marketplace</Link>
                <Link href="#" class=" font-semibold leading-6 text-gray-900">Company</Link>
            </div>

            <div v-if="user == null" class="flex flex-1 justify-end gap-5">
                <Link href="/login" class=" font-semibold leading-6 text-gray-900">Inloggen</Link>
                <Link href="/registreer" class=" font-semibold leading-6 text-gray-900"> Registreren</Link>
            </div>

            <div v-else class="flex flex-1 justify-end gap-5">
                <Menu as="div" class="relative inline-block text-left">
                    <MenuButton
                        class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-giesenBlue">
                        <img class="h-12 w-auto rounded-full" :src="`/storage/uploads/${user.profielFoto}`"
                             alt="Profiel Foto">
                        <p class="font-semibold text-gray-900">{{ user.voornaam }} {{ user.achternaam }} <br>
                            <small>{{ user.email }}</small>
                        </p>
                        <ChevronDownIcon class="mr-1 pt-2 h-8 w-8" aria-hidden="true"/>
                    </MenuButton>

                    <MenuItems
                        class="absolute right-0 z-10 mt-2 w-56  rounded bg-white shadow-lg ring-1 ring-giesenBlue">
                        <div class="py-1">
                            <MenuItem v-slot="{ active }">
                                <Link href="/profiel"
                                   :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Profiel</Link>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <a href="#"
                                   :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Mijn blogs</a>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <a href="#"
                                   :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Mijn reacties</a>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <Link href="/logout" method="post"
                                   :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Uitloggen</Link>
                            </MenuItem>
                        </div>
                    </MenuItems>
                </Menu>
            </div>
        </nav>
    </header>
</template>

<style scoped>

</style>
