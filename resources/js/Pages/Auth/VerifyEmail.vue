<script setup>
// <!--Basically just a text to inform the user they need to verify their email and just a form to resend the verification

import { Head, useForm } from '@inertiajs/vue3';
import Container from '../../Components/Container.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import SessionMessages from '../../Components/SessionMessages.vue';

//add useForm from Inertia 
const form = useForm({ });

//create submit function
const submit = () => {
    form.post(route('verification.send'));
    // the route we use is last route we created in email verification which is the verification.send
};
//Now have a form instance and submit function we can use @submit prevent in the form and PrimaryBtn below

defineProps({
    status: String,
});
</script>

<template>
   <Head title="- Email Verification" />

   <Container class="w-1/2">
        <div class="mb-8">
            <p>
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you did'nt receive the email, we will gladly send you another.
            </p>
        </div>


        <!-- instead of <p v-if="status">{{ status }}</p> ----- Make this component -->
        <SessionMessages :status="status"/>

        <form @submit.prevent="submit">
            <PrimaryBtn :disabled="form.processing">Resend Verification Email</PrimaryBtn>
        </form>
   </Container>

</template>