<script setup>
defineProps({
    routeName: String,
    label: String,
})
</script>

<template>
    <!--Now use Link component which is part of Innertia-->
    <Link :href="route(routeName)" class="text-indigo-500 hover:text-indigo-600 font-medium underline dark:text-indigo-400 dark:hover:text-indigo-500">{{ label }}</Link>
</template>

<!--Our Text Link component is Expecting a routeName and a label-->
<!--Now import the Link component to register.vue-->