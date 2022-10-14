
<template>
    <breeze-authenticated-layout>
      <template #header>
        <breeze-heading>Employees</breeze-heading>
      </template>

      <div class="flex items-center justify-between mb-6">

        <breeze-select
            id="department_id"
            class="mt-1 block w-1/3"
            v-model="department_id"
            :options="departments"
          ></breeze-select>

        <Link :href="route('employees.create')">New Employee </Link>
      </div>
      <breeze-table>
        <template #header>
          <breeze-tc>ID</breeze-tc>
          <breeze-tc>Name</breeze-tc>
          <breeze-tc>Department</breeze-tc>
          <breeze-tc>Email</breeze-tc>
          <breeze-tc>Actions</breeze-tc>
        </template>
        <tr v-for="e in employees.data" :key="e.id" class="hover:bg-gray-200">
          <breeze-tc>{{ e.id }}</breeze-tc>
          <breeze-tc>{{ e.name }}</breeze-tc>
          <breeze-tc>{{ e.department }}</breeze-tc>
          <breeze-tc>{{ e.email }}</breeze-tc>
          <breeze-tc>
            <Link mode="edit" :href="route('employees.edit', e.id)"
              >Edit</Link
            >
        </breeze-tc>
            <breeze-tc>
            <Link mode="delete" @click="destroy(e.id)">Delete</Link>
          </breeze-tc>
        </tr>
      </breeze-table>

      <breeze-pagination :links="employees.links" />
    </breeze-authenticated-layout>
  </template>

  <script>
  import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
  import BreezeTc from "@/Components/TableColumn";
  import BreezeTable from "@/Components/Table";
  import BreezePagination from "@/Components/Pagination";
  import BreezeLink from "@/Components/AnchorLink";
  import BreezeHeading from "@/Components/Heading";
  import { Link } from '@inertiajs/inertia-vue3';
  import BreezeSelect from "@/Components/Select";

  export default {
    components: {
      BreezeAuthenticatedLayout,
      BreezeTc,
      BreezeTable,
      BreezePagination,
      BreezeLink,
      BreezeHeading,
      Link,
      BreezeSelect
    },

    props: {
      employees: Object,
      department_id: [String, Number],
      departments: Object
    },
    methods: {
      destroy(id) {
        this.$inertia.delete(route("employees.destroy", id));
      },
    },
  };
  </script>

