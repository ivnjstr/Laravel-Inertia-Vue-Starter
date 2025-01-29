<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';

const props = defineProps({
    token: String,
    email: String,
})
const form = useForm({
    token: props.token,
    email: props.email,
    password:"",
    password_confirmation:"", // the password will be provided by the user 
})
const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset("password", "password_confirmation"),
    })
}
</script>


<template>
    <Head title="- Reset password" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Enter your New password</Title>
        </div>

        <!--Errors messages-->
        <ErrorMessages :error="form.errors" />

        <form @submit.prevent="submit" class="space-y-6"> 
            <InputField label="Email"  icon="at" placeholder="Enter Email" v-model="form.email" />

            <InputField label="Password" type="password" icon="key" placeholder="Enter Password" v-model="form.password"/>

            <InputField label="Name" type="password" icon="at" placeholder="Confirm Password" v-model="form.password_confirmation"/>

            <PrimaryBtn :disabled="form.processing">Reset Password</PrimaryBtn>
        </form>
    </Container>
</template>