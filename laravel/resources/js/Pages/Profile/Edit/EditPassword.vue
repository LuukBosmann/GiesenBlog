<script setup>
import {Head, useForm} from "@inertiajs/vue3"
import Layout from "@/Layout/Layout.vue";

let props = defineProps(['user'])

let form = useForm({
    huidigWachtwoord: '',
    nieuwWachtwoord: ''
});

let submit = () => {
    if(form.nieuwWachtwoord !== validator) {
        console.log("Wachtwoorden komen niet overeen");
        return;
    }

    form.patch(`/wachtwoordwijzigen`);
};

let validator;
</script>

<template>
    <Head title="Wachtwoord wijzigen"/>
    <Layout>
        <div class="max-w-md mx-auto mt-4 text-center">
            <h5 class="text-center font-semibold mb-6">Uw wachtwoord wijzigen</h5>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label class="block giesenWhite-400" for="huidigWachtwoord">Huidig wachtwoord</label>

                    <input v-model="form.huidigWachtwoord" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="password" name="huidigWachtwoord" id="huidigWachtwoord" required>
                </div>

                <div class="mb-3">
                    <label class="block giesenWhite-400" for="nieuwWachtwoord">Nieuw wachtwoord</label>

                    <input v-model="form.nieuwWachtwoord" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="password" name="nieuwWachtwoord" id="nieuwWachtwoord" required>
                </div>

                <div class="mb-3">
                    <label class="block giesenWhite-400" for="herhaalWachtwoord">Herhaal wachtwoord</label>

                    <input v-model="validator" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="password" name="herhaalWachtwoord" id="herhaalWachtwoord" required>
                </div>

                <div class="mb-3">
                    <button type="submit"
                            class="bg-giesenBlue text-giesenWhite-400 rounded-3xl py-2 px-4 mt-2 hover:bg-giesenDarkBlue w-1/2">
                        Wijzigen
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<style scoped>

</style>
