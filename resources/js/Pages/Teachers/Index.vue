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
        BreezeHeading
    },

    props: {
        teachers: Object,

    },
    methods: {
        destroy(id){
            this.$inertia.delete(route('teachers.destroy', id))
        }
    }
}

</script>

<template>
    <Head title="Teachers" />

    <BreezeAuthenticatedLayout>

            <breeze-heading>
                Teachers
            </breeze-heading>


                        <div class="flex items-center justify-center mb-6">
                           <Link :href="route('teachers.create')"
                            >Create Teacher</Link>

                        </div>


                    <breeze-table>
                    <template #header>
                        <breeze-tc>ID</breeze-tc>
                       <breeze-tc  >Name</breeze-tc>
                        <breeze-tc>Department</breeze-tc>
                        <breeze-tc>Email</breeze-tc>
                        <breeze-tc>Action</breeze-tc>

                    </template>
                       <tr v-for="(teacher,index) in teachers.data" :key="index"
                        class = "hover:bg-gray-100">
                        <breeze-tc>{{ teacher.id }}</breeze-tc>
                        <breeze-tc>{{ teacher.name }}</breeze-tc>
                        <breeze-tc>{{ teacher.department }}</breeze-tc>

                        <breeze-tc>{{ teacher.email }}</breeze-tc>

                        <breeze-tc>

                           <Link :href="route('teachers.edit', teacher.id)"
                        >Edit</Link>
                        </breeze-tc>
                        <breeze-tc>
                           <Link @click="destroy(teacher.id)"
                           >Delete</Link>
                        </breeze-tc>
                        </tr>
                </breeze-table>

                <breeze-pagination :links="teachers.links" />



    </BreezeAuthenticatedLayout>
</template>




