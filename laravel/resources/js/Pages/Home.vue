<script setup>
import Layout from "../Layout/Layout.vue";
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Layout>
      <div class="container mx-auto mt-16 text-center">
        <h1 class="text-4xl font-bold mb-8 text-giesenBlue">Welcome to Our Blog Platform</h1>
        <p class="text-lg text-gray-700 mb-8">Discover and share amazing stories from our community of bloggers.</p>
        <Link href="/blogs">
          <button class="bg-giesenBlue text-giesenWhite px-6 py-3 rounded-full text-xl hover:bg-giesenDarkBlue">
            Explore Blogs
          </button>
        </Link>
      </div>
    </Layout>
  </template>

<style scoped></style>
