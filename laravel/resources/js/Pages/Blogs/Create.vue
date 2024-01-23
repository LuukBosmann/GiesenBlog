<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';

const props = defineProps(['user']);

const form = useForm({
    titel: '',
    inhoud: '',
    gebruikersId: props.user.id,
});

function storeBlog() {
    form.post('/blogs');
}
</script>

<template>
    <Head title="Nieuwe blog"/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <Link href="/blogs" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded">Back</Link>
            </div>
            <div>
                <div class="place-content-center mt-10">
                    <form @submit.prevent="storeBlog" class="bg-white shadow-md m-2 p-2 rounded">
                        <div class="sm:col-span-6">
                            <label for="title" class="block text-lg font-medium text-gray-700">Titel</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" v-model="form.titel" autocomplete="title"
                                       :class="{ 'border-red-500': form.errors.titel }"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p v-if="form.errors.titel" class="mt-2 text-sm text-red-500">Titel is verplicht.</p>
                        </div>
                        <div class="sm:col-span-6">
                            <label for="content" class="block mt-1 text-lg font-medium text-gray-700">Inhoud</label>
                            <div class="mt-2">
                                <textarea id="content" name="content" v-model="form.inhoud" rows="3"
                                          :class="{ 'border-red-500': form.errors.inhoud }"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                            <p v-if="form.errors.inhoud" class="mt-2 text-sm text-red-500">Inhoud is verplicht.</p>
                        </div>
                        <div class="m-2 p-2">
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded">Posten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
