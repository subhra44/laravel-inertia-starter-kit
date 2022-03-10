<template>
  <div>
    <div class="mb-2">
      <Link class="flex items-center group py-2" :href="route('dashboard')">
        <icon
          name="dashboard"
          class="w-4 h-4 mr-2"
          :class="
            isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'
          "
        >
          Dashboard
        </div>
      </Link>
    </div>
    <!-- <div class="mb-2">
      <Link class="flex items-center group py-2" :href="route('users')">
        <icon
          name="users"
          class="w-4 h-4 mr-2"
          :class="
            isUrl('users')
              ? 'fill-white'
              : 'fill-indigo-400 group-hover:fill-white'
          "
        />
        <div
          :class="
            isUrl('users')
              ? 'text-white'
              : 'text-indigo-300 group-hover:text-white'
          "
        >
          Users
        </div>
      </Link>
    </div> -->
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  },
};
</script>
