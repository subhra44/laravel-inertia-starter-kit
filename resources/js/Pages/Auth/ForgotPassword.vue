<template>
  <Head title="Forgot Password" />

  <div class="flex min-h-screen items-center justify-center bg-indigo-800 p-6">
    <div class="w-full max-w-md">
      <logo class="mx-auto block h-16 w-auto max-w-xs fill-white" height="50" />
      <form
        class="mt-8 overflow-hidden rounded-lg bg-white shadow-xl"
        @submit.prevent="submit"
      >
        <div class="px-10 py-8">
          <h1 class="text-center text-base font-bold">Forgot Password</h1>
          <div class="mx-auto mt-2 w-24 border-b-2" />
          <div class="mt-6 mb-4 text-gray-600">
            Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.
          </div>
          <div
            v-if="status"
            class="mt-4 mb-4 text-sm font-medium text-green-600"
          >
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
        </div>
        <div class="flex border-t border-gray-100 bg-gray-100 px-10 py-4">
          <loading-button
            :loading="form.processing"
            class="btn-orange ml-auto font-semibold uppercase"
            type="submit"
          >
            Email Password Reset Link
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
  },
  data() {
    return {
      form: this.$inertia.form({
        email: "",
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("password.email"));
    },
  },
};
</script>
