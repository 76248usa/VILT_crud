<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import BreezeTc from '@/Components/TableColumn';
import BreezeTable from '@/Components/Table';
import BreezePagination from '@/Components/Pagination';
import { Link } from '@inertiajs/inertia-vue3'
import BreezeLink from "@/Components/AnchorLink";
import BreezeHeading from '@/Components/Heading';


export default{
    components:{
        BreezeAuthenticatedLayout,
        BreezeTc,
        BreezeTable,
        BreezePagination,
        Link,
        BreezeLink,
        BreezeHeading,

    },

    props: {
        departments: Object,


    },
    methods: {
        destroy(id){
            this.$inertia.delete(route('departments.destroy', id))
        }
    }
}

</script>

<template>
    <Head title="Departments" />

    <BreezeAuthenticatedLayout>

            <breeze-heading>
                Departments
            </breeze-heading>


                        <div class="flex items-center justify-center mb-6">
                           <Link :href="route('departments.create')"
                            >Create Department</Link>

                        </div>


                    <breeze-table>
                    <template #header>
                        <breeze-tc>ID</breeze-tc>
                       <breeze-tc  >Name</breeze-tc>
                        <breeze-tc>Phone</breeze-tc>
                        <breeze-tc>Email</breeze-tc>
                        <breeze-tc>Action</breeze-tc>

                    </template>
                       <tr v-for="(department,index) in departments.data" :key="index"
                        class = "hover:bg-gray-100">
                        <breeze-tc>{{ department.id }}</breeze-tc>
                        <breeze-tc>{{ department.name }}</breeze-tc>
                        <breeze-tc>{{ department.phone }}</breeze-tc>
                        <breeze-tc>{{ department.email }}</breeze-tc>
                        <breeze-tc>
                            <Link  :href="route('departments.edit',department.id)"
                           >Edit</Link>
                        </breeze-tc>
                        <breeze-tc>
                            <Link @click="destroy(department.id)"
                           >Delete</Link>
                        </breeze-tc>
                        </tr>
                </breeze-table>

                <breeze-pagination :links="departments.links" />



    </BreezeAuthenticatedLayout>
</template>




