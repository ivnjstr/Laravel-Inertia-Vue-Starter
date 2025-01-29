<script setup>
import Container from '../../Components/Container.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import SessionMessages from '../../Components/SessionMessages.vue';

const form = useForm({
    email:"",
    // only email
})
const submit = () => {
    form.post(route("password.email"));  
} 

defineProps({
    status: String, 
}) // then import SessiosMessages Component that we did
</script>


<template>
    <Head title="- Forgot Password" /> <!--Add head so it appear in the title that we are in the Login section-->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
           <p>
                Forgot your password? No problem. Just let us know your email address and we will email you  a password reset link that will allow you to choose a new one. 
           </p>
        </div>

        <!--We still need error message-->
        <ErrorMessages :error="form.errors" />

        <!--Session Messages-->
        <SessionMessages :status="status"/>


        <form @submit.prevent="submit" class="space-y-6"> 
            <InputField label="Email"  icon="at" placeholder="Enter Email" v-model="form.email" />
            <PrimaryBtn :disabled="form.processing">Sent Password Reset Link</PrimaryBtn>
        </form>
    </Container>
</template>