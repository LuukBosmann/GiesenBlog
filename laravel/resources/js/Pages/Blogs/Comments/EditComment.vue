<script setup>
import {Head, useForm} from '@inertiajs/vue3';

const props = defineProps(['comment']);

const form = useForm({
    id: props.comment.id,
    inhoud: props.comment.inhoud,
});

const updateComment = () => {
    form.patch("/updateComment");
}
</script>

<template>
    <Head title="Reactie bewerken"/>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
            <form @submit.prevent="updateComment()" class="bg-giesenWhite-100 shadow-md m-2 p-2 rounded">
                <div class="sm:col-span-6">
                    <label for="content" class="block mt-1 text-lg font-medium text-giesenBlack">Edit comment</label>
                    <textarea name="content" id="content" v-model="form.inhoud"
                              class="border border-giesenBlue rounded-md p-2 w-full mt-4"
                              rows="6"/>
                </div>
                <button type="submit"
                        class="px-4 py-2 bg-giesenBlue hover:bg-giesenDarkBlue text-giesenWhite-100 rounded mt-3">
                    Edit
                </button>
            </form>
        </div>
    </div>
</template>
