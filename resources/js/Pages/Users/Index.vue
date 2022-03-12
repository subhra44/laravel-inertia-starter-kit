<template>
  <Head title="Users" />
  <div>
    <h1 class="mb-6 font-bold text-base">Users</h1>
    <div class="mb-4 flex justify-between items-center">
      <search-filter
        v-model="form.search"
        class="w-full max-w-md mr-4"
        @reset="reset"
      >
        <label class="block text-gray-700">Role:</label>
        <select v-model="form.role" class="mt-1 w-full form-select">
          <option :value="null">All</option>
          <option v-for="(item, index) in roles" :key="index" :value="index">
            {{ item }}
          </option>
        </select>
        <label class="mt-4 block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="mt-1 w-full form-select">
          <option :value="null">All</option>
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-orange" :href="route('users.create')">
        <span>Create</span>
        <span class="hidden md:inline"> User</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-3 pt-3 pb-2">Name</th>
          <th class="px-3 pt-3 pb-2">Email</th>
          <th class="px-3 pt-3 pb-2" colspan="2">Role</th>
        </tr>
        <tr
          v-for="user in users.data"
          :key="user.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td class="border-t">
            <Link
              class="px-3 py-2 flex items-center focus:text-indigo-500"
              :href="route('users.edit', user.id)"
            >
              <img
                v-if="user.photo"
                class="block w-5 h-5 rounded-full mr-2 -my-2"
                :src="user.photo"
              />
              {{ user.name }}
              <icon
                v-if="user.deleted_at"
                name="trash"
                class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
              />
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="px-3 py-2 flex items-center"
              :href="route('users.edit', user.id)"
              tabindex="-1"
            >
              {{ user.email }}
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="px-3 py-2 flex items-center"
              :href="route('users.edit', user.id)"
              tabindex="-1"
            >
              {{ user.role }}
            </Link>
          </td>
          <td class="border-t w-px">
            <Link
              class="px-3 flex items-center"
              :href="route('users.edit', user.id)"
              tabindex="-1"
            >
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="users.length === 0">
          <td class="border-t px-3 py-2" colspan="4">No users found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-4" :links="users.links" />
  </div>
</template>

<script>
import Icon from "@/Components/Icon";
import pickBy from "lodash/pickBy";
import Layout from "@/Layouts/Layout";
import throttle from "lodash/throttle";
import mapValues from "lodash/mapValues";
import Pagination from "@/Components/Pagination";
import SearchFilter from "@/Components/SearchFilter";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  metaInfo: { title: "Users" },
  components: {
    Icon,
    Pagination,
    SearchFilter,
    Head,
    Link,
  },
  layout: Layout,
  props: {
    filters: Object,
    users: Object,
    roles: Array,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        role: this.filters.role,
        trashed: this.filters.trashed,
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get(this.route("users"), pickBy(this.form), {
          preserveState: true,
        });
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
};
</script>
