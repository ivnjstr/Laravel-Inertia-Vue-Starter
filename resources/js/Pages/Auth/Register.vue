<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';

//Start by creating form variable using inertia form helper
const form = useForm({
    //useForm from inertia vue and when u put this it auto imported at top
    //this is a function that will take an object all the properties we need
    name:"",
    email:"",
    password:"",
    password_confirmation:"",

    //this is what our laravel backend is expecting 
    //now bind them to the input field we created
    // example for the name we use v-model="form.name"
})

//after creating route and function
const submit = () => {
    //so we have to submit a form using a post request
    // so we us post have all the http method so post delete get or etc
    form.post(route('register'), {
        // since we have a ziggy package we can use a route function again
        // route('register') means we want to sumbit this to the route register.

        // we can also pass an option as the second argument to this form helper 
        // example whats going to happen when this form is cancelled or there is an error using on.
        //we use onFinish
        onFinish: () => form.reset("password", "password_confirmation"),
        // means we the form processing is finished or submitted  we can use the form.reset to reset the whole form of specific field but we want to reset a password and password_confirmation
    })
        //Now attached submit to form    
}
    
</script>


<template>
    <!--Use our Container-->
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Register a new account</Title>
            <p>Already have an account?
                <TextLink routeName="home" label="Login"/>
            </p> <!--and also login as link-->
        </div>

        <!--Errors messages-->
            <!-- create component for Error messages templates-->
        <ErrorMessages :error="form.errors" />


        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Name" icon="id-badge" type="text" placeholder="Enter Name" v-model="form.name"/>

            <InputField label="Email" type="email" icon="at" placeholder="Enter Email" v-model="form.email" />

            <InputField label="Password" type="password" icon="key" placeholder="Enter Password" v-model="form.password"/>

            <InputField label="Name" type="password" icon="at" placeholder="Confirm Password" v-model="form.password_confirmation"/>

            <p class="text-slate-500 text-sm dark:text-slate-400">
                By creating an account, you agree to our Terms of Services and Privacy 
            </p>
            <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
            <!--Since we have a form now we can bind the disabled att to form.processing-->
            <!--In inertia form helper we have form.processign property that would be true white the form is processing so we dont have applied the logic manually and inertia form helper will do everything for us-->
            <!--now we need a submit function and a route to submit this insformation-->
            <!--Now start by creating a route-->
        </form>
    </Container>
</template>