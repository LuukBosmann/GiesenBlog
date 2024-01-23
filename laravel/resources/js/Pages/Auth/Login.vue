<script setup>
import {Link, Head, useForm} from "@inertiajs/vue3";

const props = defineProps(['errors'])

let form = useForm({
    email: '',
    password: '',
    remember: false
});

let submit = () => {
    form.post("/login");
}
</script>

<template>
    <Head title="Login"/>
    <div class="max-w-md mx-auto mt-4 text-center">
        <h5 class="text-center font-semibold mb-6">Fill in your information to continue</h5>

        <form @submit.prevent="submit">
            <div class="mb-6">
                <label class="block mb-2 giesenWhite-400" for="email">Email</label>

                <input v-model="form.email" class="border border-giesenBlue rounded-3xl p-2 w-full" type="email"
                       name="email" id="email" required>
                <div class="text-red-600" v-if="errors.email">
                    {{ errors.email }}
                </div>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-gray-700" for="password">Password</label>

                <input v-model="form.password" class="border border-giesenBlue rounded-3xl p-2 w-full" type="password"
                       name="password" id="password" required>
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-gray-700" for="remember">Remember me</label>

                <input v-model="form.remember" class="border border-giesenBlue rounded-3xl p-2 w-full" type="checkbox"
                       name="remember" id="remember">
            </div>

            <div class="mb-6">
                <button type="submit"
                        class="w-1/2 inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
                    Login
                </button>
            </div>
        </form>

        <div class="w-1/3 mx-auto border border-gray-800"/>

        <div class="mt-4">
            <p>Don't have an account yet?</p>
            <Link class="no-underline text-blue-600 hover:underline" href="/register">Sign up here.</Link>
        </div>
    </div>
</template>
