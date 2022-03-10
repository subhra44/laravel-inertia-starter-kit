<template>
  <Head title="Log in" />

  <div class="flex min-h-screen items-center justify-center bg-indigo-800 p-6">
    <div class="w-full max-w-md">
      <logo class="mx-auto block h-16 w-auto max-w-xs fill-white" height="50" />
      <form
        class="mt-8 overflow-hidden rounded-lg bg-white shadow-xl"
        @submit.prevent="login"
      >
        <div class="px-10 py-8">
          <h1 class="text-center text-base font-bold">Welcome Back!</h1>
          <div class="mx-auto mt-2 w-24 border-b-2" />
          <div v-if="status" class="mt-4 mb-4 font-medium text-green-600">
            {{ status }}
          </div>

          <div class="mt-6 mb-8 flex justify-center">
            <a :href="route('auth.microsoft')" class="mr-2 flex items-center">
              <img
                class="h-8 w-auto"
                src="/images/ms_signin_dark.svg"
                alt="Microsoft"
              />
            </a>
          </div>

          <div class="horizontal-line border-b border-gray-300 text-center">
            <span class="bg-white px-4 text-gray-600">or</span>
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
          />
          <label class="mt-4 flex select-none items-center" for="remember">
            <input
              id="remember"
              v-model="form.remember"
              class="mr-1"
              type="checkbox"
            />
            <span>Remember Me</span>
          </label>
        </div>
        <div class="flex border-t border-gray-100 bg-gray-100 px-10 py-4">
          <Link
            :href="route('password.request')"
            class="text-gray-600 underline hover:text-gray-900"
          >
            Forgot your password?
          </Link>
          <loading-button
            :loading="form.processing"
            class="btn-orange ml-auto font-semibold uppercase"
            type="submit"
          >
            Login
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
        password: "",
        remember: false,
      }),
    };
  },
  methods: {
    login() {
      this.form.post(this.route("login"));
    },
  },
};
</script>
