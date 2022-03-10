<template>
  <Head title="Reset Password" />

  <div class="flex min-h-screen items-center justify-center bg-indigo-800 p-6">
    <div class="w-full max-w-md">
      <logo class="mx-auto block h-16 w-auto max-w-xs fill-white" height="50" />
      <form
        class="mt-8 overflow-hidden rounded-lg bg-white shadow-xl"
        @submit.prevent="submit"
      >
        <div class="px-10 py-8">
          <h1 class="text-center text-base font-bold">Reset Password</h1>
          <div class="mx-auto mt-2 w-24 border-b-2" />
          <div v-if="status" class="mt-4 mb-4 font-medium text-green-600">
            {{ status }}
          </div>

          <text-input
            v-model="form.email"
            :error="form.errors.email"
            class="mt-4"
            label="Email"
            type="email"
            required
            autofocus
            autocapitalize="off"
            autocomplete="username"
          />
          <text-input
            v-model="form.password"
            :error="form.errors.password"
            class="mt-4"
            label="Password"
            type="password"
            required
            autocomplete="new-password"
          />

          <text-input
            v-model="form.password_confirmation"
            :error="form.errors.password_confirmation"
            class="mt-4"
            label="Confirm Password"
            type="password"
            required
            autocomplete="new-password"
          />
        </div>
        <div class="flex border-t border-gray-100 bg-gray-100 px-10 py-4">
          <loading-button
            :loading="form.processing"
            class="btn-orange ml-auto font-semibold uppercase"
            type="submit"
          >
            Reset Password
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Logo from "@/Components/Logo";
import TextInput from "@/Components/TextInput";
import LoadingButton from "@/Components/LoadingButton";
import { Link, Head } from "@inertiajs/inertia-vue3";

export default {
  // metaInfo: { title: 'Login' },
  components: {
    LoadingButton,
    Logo,
    TextInput,
    Link,
    Head,
  },
  props: {
    status: String,
    email: String,
    token: String,
  },
  data() {
    return {
      form: this.$inertia.form({
        token: this.token,
        email: this.email,
        password: "",
        password_confirmation: "",
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("password.update"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
