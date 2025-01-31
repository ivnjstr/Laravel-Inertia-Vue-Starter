<script setup>
    import Container from '../../../Components/Container.vue'
    import Title from '../../../Components/Title.vue'
    import InputField from '../../../Components/InputField.vue'
    import PrimaryBtn from '../../../Components/PrimaryBtn.vue'
    import { useForm } from '@inertiajs/vue3'
    import ErrorMessages from '../../../Components/ErrorMessages.vue'
    import { ref } from 'vue'
    import { route } from '../../../../../vendor/tightenco/ziggy/src/js'

    const form = useForm({
        password: "",
    })
    
    const showConfirmPassword = ref(false); //ref from vue with the initial value is false

    const submit = () => {
        form.delete(route("profile.destroy"), {
            onFinish: () => form.reset(),
            preserveScroll: true,
        });
    }
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Title>Delete Account</Title>
            <p>Once your account is deleted, all of the resources data will be permanently deleted. This action connot be undone.</p>
        </div>
        
         <!--Error messages-->
        <ErrorMessages :error="form.errors" />

        <div v-if="showConfirmPassword" ><!--so because its false the form is hide -->
            <form
                @submit.prevent="submit"    
                class="flex items-end gap-4">
                <!-- we use form instance and submit through patch because that is what our route expect-->
                <InputField label="Confirm Password" icon="key" type="password" class="w-1/2" v-model="form.password"/>
        
                <PrimaryBtn :disabled="form.processing" >Confirm</PrimaryBtn>

                <button
                @click="showConfirmPassword = false"
                class="text-indigo-500 font-medium undeline dark:text-indigo-400"
                >
                Cancel
                </button>
            </form>
        </div>

        <button
        v-if="!showConfirmPassword"
        @click="showConfirmPassword = true"
        class="px-6 py-2 rounded-lg bg-red-500 text-white" >
            <i class="fa-solid fa-triangle-exclamation mr-2"></i>
            Delete Account
        </button>
        
    </Container>
</template>