<template>
  <Head title="Confirm Password" />

  <div class="flex min-h-screen items-center justify-center bg-indigo-800 p-6">
    <div class="w-full max-w-md">
      <logo class="mx-auto block h-16 w-auto max-w-xs fill-white" height="50" />
      <form
        class="mt-8 overflow-hidden rounded-lg bg-white shadow-xl"
        @submit.prevent="submit"
      >
        <div class="px-10 py-8">
          <h1 class="text-center text-base font-bold">Confirm Password</h1>
          <div class="mx-auto mt-2 w-24 border-b-2" />
          <div class="mt-6 mb-4 text-gray-600">
            This is a secure area of the application. Please confirm your
            password before continuing.
          </div>
          <div v-if="status" class="mt-4 mb-4 font-medium text-green-600">
            {{ status }}
          </div>

          <text-input
            v-model="form.password"
            :error="form.errors.password"
            class="mt-4"
            label="Password"
            type="password"
            required
            autocomplete="current-password"
            autofocus
          />
        </div>
        <div class="flex border-t border-gray-100 bg-gray-100 px-10 py-4">
          <loading-button
            :loading="form.processing"
            class="btn-orange ml-auto font-semibold uppercase"
            type="submit"
          >
            Confirm
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
        password: "",
      }),
    };
  },
  methods: {
    submit() {
      this.form.post(this.route("password.confirm"), {
        onFinish: () => this.form.reset(),
      });
    },
  },
};
</script>
