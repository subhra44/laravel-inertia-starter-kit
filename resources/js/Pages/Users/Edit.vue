<template>
  <Head :title="form.first_name + ' ' + form.last_name" />

  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-base">
        <Link
          class="text-indigo-400 hover:text-indigo-600"
          :href="route('users')"
          >Users</Link
        >
        <span class="text-indigo-400 font-medium"> /</span>
        {{ form.first_name }} {{ form.last_name }}
      </h1>
    </div>
    <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore">
      This user has been deleted.
    </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
      <form @submit.prevent="update">
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
            items-center
          "
        >
          <button
            v-if="!user.deleted_at"
            class="text-red-600 hover:underline"
            tabindex="-1"
            type="button"
            @click="destroy"
          >
            Delete User
          </button>
          <loading-button
            :loading="form.processing"
            class="btn-orange ml-auto"
            type="submit"
            >Update User</loading-button
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/Layout";
import TextInput from "@/Components/TextInput";
import FileInput from "@/Components/FileInput";
import SelectInput from "@/Components/SelectInput";
import LoadingButton from "@/Components/LoadingButton";
import TrashedMessage from "@/Components/TrashedMessage";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    Link,
    Head,
  },
  layout: Layout,
  props: {
    user: Object,
    roles: Object,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        _method: "put",
        first_name: this.user.first_name,
        last_name: this.user.last_name,
        email: this.user.email,
        password: null,
        role: this.user.role,
      }),
    };
  },
  methods: {
    update() {
      this.form.post(this.route("users.update", this.user.id), {
        onSuccess: () => this.form.reset("password"),
      });
    },
    destroy() {
      if (confirm("Are you sure you want to delete this user?")) {
        this.$inertia.delete(this.route("users.destroy", this.user.id));
      }
    },
    restore() {
      if (confirm("Are you sure you want to restore this user?")) {
        this.$inertia.put(this.route("users.restore", this.user.id));
      }
    },
  },
};
</script>
