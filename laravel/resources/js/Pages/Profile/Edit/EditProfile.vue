<script setup>
import Layout from "../../../Layout/Layout.vue";
import {reactive} from "vue";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps(['user']);

let form = reactive(props.user);

let submit = () => {
    Inertia.patch(`/wijzigProfiel/${props.user['id']}`, form);
};
</script>

<template>
    <Head title="Profiel Wijzigen"/>
    <Layout>
        <div class="max-w-md mx-auto mt-4 text-center">
            <h5 class="text-center font-semibold mb-6">Uw profiel wijzigen</h5>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label class="block giesenWhite-400" for="voornaam">Voornaam</label>

                    <input v-model="form.voornaam" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="text" name="voornaam" id="voornaam" required>
                </div>

                <div class="mb-3">
                    <label class="block giesenWhite-400" for="achternaam">Achternaam</label>

                    <input v-model="form.achternaam" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="text" name="achternaam" id="achternaam" required>
                </div>

                <div class="mb-3">
                    <label class="block giesenWhite-400" for="email">Email</label>

                    <input v-model="form.email" class="border border-giesenBlue rounded-3xl p-2 w-full"
                           type="email" name="email" id="email" required>
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
