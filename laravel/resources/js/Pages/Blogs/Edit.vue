<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import {Inertia} from "@inertiajs/inertia";

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
        <Link href="/blogs" class="px-4 py-2 bg-giesenBlue hover:bg-giesenDarkBlue text-giesenWhite-100 rounded">Back
        </Link>
      </div>
      <div>
        <form @submit.prevent="updateBlog" action="" class="bg-giesenWhite-100 shadow-md m-2 p-2 rounded">
          <div class="sm:col-span-6">
            <label for="title" class="block text-lg font-medium text-giesenBlack">Title</label>
            <div class="mt-2">
              <input type="text" name="title" id="title" v-model="form.titel" autocomplete="title"
                class="shadow-sm focus:ring-giesenBlue focus:border-giesenBlue block w-full sm:text-sm border-giesenWhite-300 rounded-md">
            </div>
          </div>
          <div class="sm:col-span-6">
            <label for="content" class="block mt-1 text-lg font-medium text-giesenBlack">Content</label>
            <div class="mt-2">
              <textarea id="content" name="content" v-model="form.inhoud" rows="6"
                class="shadow-sm focus:ring-giesenBlue focus:border-giesenBlue mt-1 block w-full sm:text-sm border-giesenWhite-300 rounded-md"></textarea>
            </div>
          </div>
          <div class="m-2 p-2">
            <button type="submit"
              class="px-4 py-2 bg-giesenBlue hover:bg-giesenDarkBlue text-giesenWhite-100 rounded">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
