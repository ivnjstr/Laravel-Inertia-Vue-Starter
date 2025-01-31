<script setup>
    import Container from '../../../Components/Container.vue'
    import Title from '../../../Components/Title.vue'
    import InputField from '../../../Components/InputField.vue'
    import PrimaryBtn from '../../../Components/PrimaryBtn.vue'
    import { useForm } from '@inertiajs/vue3'
    import ErrorMessages from '../../../Components/ErrorMessages.vue'

    const form = useForm({
        current_password: "",
        password: "",
        password_confirmation: "",
    }) 

    const submit = () =>{
        form.put(route("profile.password"), {
            preserveScroll: true, // prevent jump to the top of the page if we click the save button
            // it a part of Inertia
            onSuccess: () => form.reset(),
            onError: () => form.reset(),
        });
    }

    console.log(form);
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Update Password</Title>
            <p>Ensure you are using a long, random password to stay secure.</p>
        </div>

         <!--Error messages-->
        <ErrorMessages :error="form.errors" />

        <form
        @submit.prevent="submit"    
        class="space-y-6">
            
            <InputField label="Current Password" icon="key" class="w-1/2" type="password" v-model="form.current_password" />

            <InputField label="New Password" icon="key" class="w-1/2" type="password" v-model="form.password" />

            <InputField label="Confirm Password" icon="key" class="w-1/2" type="password" v-model="form.password_confirmation" />

            <!--This is part of inertia form which is very usefull-->
            <p v-if="form.recentlySuccessful" class="text-green-500 font-medium">Saved!</p>
           

            <PrimaryBtn :disabled="form.processing" >Save</PrimaryBtn>
        </form>
    </Container>
</template>