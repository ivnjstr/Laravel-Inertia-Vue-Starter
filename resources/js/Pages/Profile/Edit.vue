<script setup>
import { Head } from '@inertiajs/vue3';
import UpdateInfo from './Sections/UpdateInfo.vue';
import UpdatePassword from './Sections/UpdatePassword.vue';
import DeleteAccount from './Sections/DeleteAccount.vue';

defineProps({
    user: Object,
    status: String
})

</script>

<template>
    <Head title="- Profile" />
    <UpdateInfo :user="user" :status="status"/> <!--:user="user" means expectiong the user and bind the prop as user-->
    <UpdatePassword/>
    <DeleteAccount/>
</template>