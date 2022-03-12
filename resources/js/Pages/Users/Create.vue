<template>
  <Head title="Create User" />

  <div>
    <h1 class="mb-8 font-bold text-base">
      <Link class="text-indigo-400 hover:text-indigo-600" :href="route('users')"
        >Users</Link
      >
      <span class="text-indigo-400 font-medium"> /</span> Create
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input
            v-model="form.first_name"
            :error="form.errors.first_name"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="First name"
          />
          <text-input
            v-model="form.last_name"
            :error="form.errors.last_name"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Last name"
          />
          <text-input
            v-model="form.email"
            :error="form.errors.email"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Email"
          />
          <text-input
            v-model="form.password"
            :error="form.errors.password"
            class="pr-6 pb-8 w-full lg:w-1/2"
            type="password"
            autocomplete="new-password"
            label="Password"
          />
          <select-input
            v-model="form.role"
            :error="form.errors.role"
            class="pr-6 pb-8 w-full lg:w-1/2"
            label="Role"
          >
            <option :value="null" />
            <option v-for="(item, index) in roles" :key="index" :value="index">
              {{ item }}
            </option>
          </select-input>
        </div>
        <div
          class="
            px-8
            py-4
            bg-gray-50
            border-t border-gray-100
            flex
            justify-end
            items-center
          "
        >
          <loading-button
            :loading="form.processing"
            class="btn-orange"
            type="submit"
            >Create User</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/Layout";
import FileInput from "@/Components/FileInput";
import TextInput from "@/Components/TextInput";
import SelectInput from "@/Components/SelectInput";
import LoadingButton from "@/Components/LoadingButton";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
    Head,
    Link,
  },
  layout: Layout,
  props: {
    roles: Object,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        role: null,
      }),
    };
  },
  methods: {
    store() {
      this.form.post(this.route("users.store"));
    },
  },
};
</script>
