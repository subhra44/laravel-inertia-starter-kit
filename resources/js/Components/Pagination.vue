<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links" :key="key">
        <div
          v-if="link.url === null"
          class="
            mr-2
            mb-1
            px-2
            py-1
            leading-2
            text-gray-400
            border border-gray-300
            rounded
          "
          v-html="link.label"
        />
        <Link
          v-else
          :key="key"
          class="
            mr-2
            mb-1
            px-2
            py-1
            leading-2
            border border-gray-300
            rounded
            hover:border-indigo-500
            focus:border-indigo-500 focus:text-indigo-500
          "
          :class="{ 'border-indigo-500': link.active }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
};
</script>
