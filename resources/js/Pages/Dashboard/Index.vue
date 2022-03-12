<template>
  <Head title="Dashboard" />

  <div>
    <h1 class="mb-5 font-bold text-base">Dashboard</h1>
    <p class="mb-5 leading-normal">
      Hey there! Welcome to Laravel Inertia Starter Kit.
    </p>
  </div>
</template>

<script>
import Layout from "@/Layouts/Layout";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  metaInfo: { title: "Dashboard" },
  components: {
    Head,
  },
  layout: Layout,
};
</script>
