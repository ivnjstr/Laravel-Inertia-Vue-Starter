<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import CheckBox from '../../Components/CheckBox.vue';
import SessionMessages from '../../Components/SessionMessages.vue';


const form = useForm({
    email:"",
    password:"",
    remember: null,
    // add remember property
    // Add remember me feature to it
})


const submit = () => {
    form.post(route('login'), {    // submit this form request to the login page 
        onFinish: () => form.reset("password"),
    })  
} // submit function its going to be quite similar

defineProps({
    status: String,
})

</script>


<template>
    <Head title="- Login" /> <!--Add head so it appear in the title that we are in the Login section-->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Login to your account</Title>
            <p>Need an account?
                <TextLink routeName="register" label="Register"/>
            </p> <!--and also login as link-->
        </div>

        <!--We still need error message-->
        <ErrorMessages :error="form.errors" />

        <!--Session Messages-->
        <SessionMessages :status="status"/>

        <form @submit.prevent="submit" class="space-y-6"> 
            <InputField label="Email"  icon="at" placeholder="Enter Email" v-model="form.email" />
            <InputField label="Password" type="password" icon="key" placeholder="Enter Password" v-model="form.password"/>

            <!--Add remember me section-->
            <div class="flex items-center justify-between">
                <!--Added checkbox for Remember me section(CheckBox.vue component)--> 
                <CheckBox name="remeber" v-model="form.remember">Remember me</CheckBox>

                <!--Link for forgot password we give the user an ability to change the pass if they forget-->
                <TextLink routeName="password.request" label="Forgot password?"/>
            </div>


            <PrimaryBtn :disabled="form.processing">Login</PrimaryBtn>
        </form>
    </Container>
</template>