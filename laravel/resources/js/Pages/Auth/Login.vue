<script setup>
import {Link, Head, useForm} from "@inertiajs/vue3";

const props = defineProps(['errors'])

let form = useForm({
    email: '',
    password: ''
});

let submit = () => {
    form.post("/login");
}
</script>

<template>
    <Head title="Login"/>
    <div class="max-w-md mx-auto mt-4 text-center">
        <h5 class="text-center font-semibold mb-6">Log in met uw gegevens</h5>

        <form @submit.prevent="submit">
            <div class="mb-6">
                <label class="block mb-2 giesenWhite-400" for="email">Email</label>

                <input v-model="form.email" class="border border-giesenBlue rounded-3xl p-2 w-full" type="email"
                       name="email"
                       id="email" required>
                <div class="text-red-600" v-if="errors.email">
                    {{ errors.email }}
                </div>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-gray-700"
                       for="password">Wachtwoord</label>

                <input v-model="form.password" class="border border-giesenBlue rounded-3xl p-2 w-full"
                       type="password"
                       name="password" id="password"
                       required>
            </div>

            <div class="mb-6">
                <button type="submit"
                        class="bg-giesenBlue text-giesenWhite-400 rounded-3xl py-2 px-4 mt-2 hover:bg-giesenDarkBlue w-1/2">
                    Inloggen
                </button>
            </div>
        </form>

        <div class="w-1/3 mx-auto border border-gray-800"/>

        <div class="mt-4">
            <p>Heeft u nog geen account?</p>
            <Link class="no-underline hover:underline" href="/registreer">Registreer hier.</Link>
        </div>
    </div>
</template>

<style scoped>

</style>
