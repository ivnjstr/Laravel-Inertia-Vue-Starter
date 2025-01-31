<script setup>
import Container from '../../Components/Container.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ErrorMessages from '../../Components/ErrorMessages.vue';

const form = useForm({
    password:"",
})

const submit = () => {
    form.post(route('password.confirm'), {  
        onFinish: () => form.reset(), // we dont need to pass everything because we only have 1 field
    })  
} 

</script>


<template>
    <Head title="- Password Confirmation" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                This is a secured area of the application. Please confirm your password before continuing.
            </p> 
        </div>

        <!--We still need error message-->
        <ErrorMessages :error="form.errors" />

        <form @submit.prevent="submit" class="space-y-6"> 
            
            <InputField label="Password" type="password" icon="key" placeholder="Enter Password" v-model="form.password"/>

            <PrimaryBtn :disabled="form.processing">Confirm</PrimaryBtn>
        </form>
    </Container>
</template>