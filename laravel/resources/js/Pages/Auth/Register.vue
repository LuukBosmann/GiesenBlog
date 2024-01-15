<script setup>
import Layout from "../../Layout/Layout.vue";
import {Link, Head} from "@inertiajs/vue3";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

let form = reactive({
    voornaam: '',
    achternaam: '',
    email: '',
    password: '',
    profielFoto: '',
});

let submit = () => {
    Inertia.post('/registreer', form);
}
</script>

<template>
    <Head title="Registreer"/>
    <Layout>
        <div class="max-w-md mx-auto mt-4 text-center">
            <h5 class="text-center font-semibold mb-6">Een nieuw profiel registreren</h5>

            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label class="block mb-2 giesenWhite-400" for="voornaam">Voornaam</label>

                    <input v-model="form.voornaam" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="text"
                           name="voornaam"
                           id="voornaam" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 giesenWhite-400" for="achternaam">Achternaam</label>

                    <input v-model="form.achternaam" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="text"
                           name="achternaam"
                           id="achternaam" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 giesenWhite-400" for="email">Email</label>

                    <input v-model="form.email" class="border border-giesenBlue rounded-3xl p-2 w-full" type="email"
                           name="email"
                           id="email" required>
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-gray-700"
                           for="wachtwoord">Wachtwoord</label>

                    <input v-model="form.password" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="password"
                           name="wachtwoord" id="wachtwoord"
                           required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-gray-700"
                           for="profielFoto">Profiel foto</label>

                    <input @input="form.profielFoto = $event.target.files[0]" class="text-center p-2 w-full"
                           type="file"
                           name="profielFoto" id="profielFoto"
                           required>
                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-giesenBlue text-giesenWhite-400 rounded-3xl py-2 px-4 mt-2 hover:bg-giesenDarkBlue w-1/2">
                        Registreer
                    </button>
                </div>
            </form>

            <div class="w-1/3 mx-auto border border-gray-800"/>

            <div class="mt-4">
                <p>Heeft u al een account?</p>
                <Link class="no-underline hover:underline" href="/login">Login.</Link>
            </div>
        </div>
    </Layout>
</template>

<style scoped>

</style>
