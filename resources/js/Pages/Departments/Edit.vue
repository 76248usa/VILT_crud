<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLink from "@/Components/AnchorLink";
import { useForm } from '@inertiajs/inertia-vue3';
import BreezeLabel from '@/Components/Label';
import BreezeInput from '@/Components/Input';
import BreezeButton from '@/Components/Button';
import BreezeResetButton from '@/Components/ResetButton';
import BreezeHeading from '@/Components/Heading';

export default{

    props: {
    errors: Object,
    department: Object
  },

    components: {
        BreezeAuthenticatedLayout,
        BreezeLink,
        BreezeLabel,
        BreezeInput,
        //BreezeInputError,
        BreezeButton,
        BreezeResetButton,
        BreezeHeading
    },

setup (props) {
    const form = useForm({
      name: props.department.name,
      email: props.department.email,
      phone: props.department.phone,
    })

    return { form }
  },
  methods:{

    resetForm(){
        //this.form.clearErrors();
        this.form.reset();
    },

    submit() {
      this.form.put(route('departments.update', this.department.id));
    }
  },
};

</script>

<template>
    <Head title="Departments" />

    <BreezeAuthenticatedLayout>

           <breeze-heading>
                Edit Department -- {{ form.name }}
            </breeze-heading>



                        <form @submit.prevent="submit">
                        <div class="mt-4">
                            <breeze-label for="name" value="Name"></breeze-label>
                            <breeze-input id="name" for="name"
                            type="text" v-model="form.name"
                            class="mt-1 block w-1/2"
                            required autofocus></breeze-input>
                        </div>

                        <div v-if="errors.name">{{ errors.name }}</div>

                        <div class="mt-4">
                            <breeze-label for="email" value="Email"></breeze-label>
                            <breeze-input for="email"
                            type="email" v-model="form.email"
                            class="mt-1 block w-1/2" id="email"
                            required ></breeze-input>
                        </div>

                        <div>
                            <breeze-label for="phone" value="Phone"></breeze-label>
                            <breeze-input for="phone"
                            type="text" v-model="form.phone"
                            class="mt-1 block w-1/2" id="phone"
                            max="15" min="5"></breeze-input>
                        </div>
                        <div class="flex items-center mt-4">
                            <breeze-reset-button
                            @click="resetForm">Reset</breeze-reset-button>
                            <breeze-button @submit.prevent="submit"
                            :class="{'opacity-25': form.processing}"
                            :disabled="form.processing">Edit</breeze-button>
                        </div>


                        </form>

    </BreezeAuthenticatedLayout>
</template>


