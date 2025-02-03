<script setup>
    import Container from '../../../Components/Container.vue'
    import Title from '../../../Components/Title.vue'
    import InputField from '../../../Components/InputField.vue'
    import PrimaryBtn from '../../../Components/PrimaryBtn.vue'
    import { router, useForm } from '@inertiajs/vue3'
    import SessionMessages from '../../../Components/SessionMessages.vue'
    import ErrorMessages from '../../../Components/ErrorMessages.vue'


    const props = defineProps({
        user: Object,
        status: String,
    })
    //now we have access to the user instance
    //now in order to use the information of the user on the field we save the defined prop inside the variable

    const form = useForm({
        name: props.user.name,
        email: props.user.email,
    })

    const resendEmail = (e) =>{
        router.post(route('verification.send'), {}, {
            onStart: () => e.target.disabled = true,
            onFinish: () => e.target.disabled = false,
        })
    }
    // if we click the button we want to submit a request to that verification send route and this is called a manual visit to a route

    console.log(form);
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Update Information</Title>
            <p>Update your account's profile information adn email address.</p>
            
        </div>

        
         <!--Error messages-->
        <ErrorMessages :error="form.errors" />
        <p v-if="form.recentlySuccessful" class="text-green-500 font-medium mb-4">Saved!</p>


        <form
        @submit.prevent="form.patch(route('profile.info'))"    
        class="space-y-6">
            <!-- we use form instance and submit through patch because that is what our route expect-->
            <InputField label="Name" icon="id-badge" class="w-1/2" v-model="form.name"/>
            <InputField label="Email" icon="at" class="w-1/2" v-model="form.email" />

            <div v-if="user.email_verified_at === null" > <!--if true then show the text-->

                <!--Session messages-->
                <SessionMessages :status="status" />

                <p>Your Email address is unverified
                    <button @click="resendEmail" class="text-indigo-500 font-medium underline dark:text-indigo-400 dark:hover:text-indigo-500 disabled:text-slate-400 disabled:cursor-wait">Click here to re-send the verification email</button>
                </p>
                
            </div>

            

            <PrimaryBtn :disabled="form.processing" >Save</PrimaryBtn>
        </form>
    </Container>
</template>