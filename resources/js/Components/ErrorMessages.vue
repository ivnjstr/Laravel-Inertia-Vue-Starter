<script setup>
defineProps({
    error: Object,
});
</script>

<template>
    <!--this whole div should be conditioonal-->
    <div class="mb-4" v-if="Object.keys(error).length">
        <!--if this Object.keys(error).length returns true then we will see all of this otherwise we will not see anything-->
        <!--if the object has any element within it -->
        <!--v-if="Object" means if the object has any element within it and because the object at first will be an empty object sot it would not be null it would be an empty object  -->
        <p class="text-sm text-red-500">
            <!--have an error messages in one section rather than under input field -->
            Somethings went wrong!
        </p>
        <ul class="ml-4 list-disc list-inside">
            <li v-for="(errorMessage, i) in error" :key="i" class="text-sm text-red-500">
                 {{ errorMessage }} 
            </li>

            <!--v-for="(error, i) in errors" :key="i" > this means v-for that the element we want to repeat and we want to loop over that errors object. The "in errors" means we want to loop over the errors. the :key="i" means bind the key attributes to that i "-->
            <!--to the Register.vue ErrorMessages bind error using collon :errors="form.errors" -->
        </ul>
    </div>
</template>