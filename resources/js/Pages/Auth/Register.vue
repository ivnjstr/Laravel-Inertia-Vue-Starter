<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
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

        <form class="space-y-6">
            <InputField label="Name" icon="id-badge"/>
            <InputField label="Email" type="email" icon="at"/>
            <InputField label="Password" type="password" icon="key"/>
            <InputField label="Name" type="password" icon="at"/>
        </form>
    </Container>
</template>