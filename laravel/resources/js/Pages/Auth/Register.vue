<script setup>
import {Link, Head, useForm} from "@inertiajs/vue3";

let form = useForm({
    voornaam: '',
    achternaam: '',
    email: '',
    password: '',
    profielFoto: '',
});

let submit = () => {
    form.post('/register');
}
</script>

<template>
    <Head title="Register"/>
    <div class="max-w-md mx-auto mt-4 text-center">
        <h5 class="text-center font-semibold mb-6">Register a new profile</h5>

        <form @submit.prevent="submit">
            <div class="mb-6">
                <label class="block mb-2 giesenWhite-400" for="voornaam">First name</label>

                <input v-model="form.voornaam" class="border border-giesenBlue rounded-3xl p-2 w-full" type="text"
                       name="voornaam" id="voornaam" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 giesenWhite-400" for="achternaam">Last name</label>

                <input v-model="form.achternaam" class="border border-giesenBlue rounded-3xl p-2 w-full" type="text"
                       name="achternaam" id="achternaam" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 giesenWhite-400" for="email">Email</label>

                <input v-model="form.email" class="border border-giesenBlue rounded-3xl p-2 w-full" type="email"
                       name="email" id="email" required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-gray-700" for="wachtwoord">Password</label>

                <input v-model="form.password" class="border border-giesenBlue rounded-3xl p-2 w-full" type="password"
                       name="wachtwoord" id="wachtwoord" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-gray-700" for="profielFoto">Profile Picture</label>

                <input @input="form.profielFoto = $event.target.files[0]" class="text-center p-2 w-full" type="file"
                       name="profielFoto" id="profielFoto" required>
            </div>

            <div class="mb-6">
                <button type="submit"
                        class="w-1/2 inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                    Sign up
                </button>
            </div>
        </form>

        <div class="w-1/3 mx-auto border border-gray-800"/>

        <div class="mt-4">
            <p>Already know your way around?</p>
            <Link class="no-underline text-blue-600 hover:underline" href="/login">Login.</Link>
        </div>
    </div>
</template>
