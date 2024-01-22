<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  blog: Object,
});

const form = useForm({
  titel: props.blog.titel,
  inhoud: props.blog.inhoud,
});

function updateBlog() {
  Inertia.post(window.location.href, form);
}
</script>

<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="flex m-2 p-2">
        <Link href="/blogs"
          class="inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">
        Back
        </Link>
      </div>
      <div>
        <form @submit.prevent="updateBlog" action="" class="bg-giesenWhite-100 shadow-md m-2 p-4 rounded">
          <div class="sm:col-span-6">
            <label for="title" class="block text-lg font-medium text-giesenBlack mb-1">Title</label>
            <div class="mt-2">
              <input type="text" name="title" id="title" v-model="form.titel" autocomplete="title"
                class="shadow bg-giesenWhite-100 focus:ring-giesenBlue focus:border-giesenBlue block w-full sm:text-sm border-giesenWhite-300 rounded-md p-2">
            </div>
          </div>
          <div class="sm:col-span-6">
            <label for="content" class="block mt-4 text-lg font-medium text-giesenBlack mb-1">Content</label>
            <div class="mt-2">
              <textarea id="content" name="content" v-model="form.inhoud" rows="6"
                class="shadow-lg bg-giesenWhite-100 focus:ring-giesenBlue focus:border-giesenBlue mt-1 block w-full sm:text-sm border-giesenWhite-300 rounded-md p-2 h-52"></textarea>
            </div>
          </div>
          <div class="m-2 p-2">
            <button type="submit"
              class="inline-block bg-giesenWhite-200 text-giesenBlack drop-shadow-md rounded-full py-2 px-6 transition duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105 focus:outline-none focus:ring focus:border-blue-300">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

