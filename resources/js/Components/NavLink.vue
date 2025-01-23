<script setup>
    // we want to make this dynamic
    defineProps({ //pass an object within the parenthesis
        // so we need a route('home') in link so call it as
        routeName: String, // so instead of this route('home') hard codede home call as routeName
        componentName: String,
    })

</script>

<template>

    <Link
    :href="route(routeName)"
    class="px-3 py-2 rounded-lg hover:bg-slate-700"
    :class="{'bg-slate-700' : $page.component === componentName}"
    >
    <!--right after the class att we can also have another class but bind it to an object which is going TO BE OUR CONDITION notice the collon before the class name and the object inside the cotations
    $page.component is the global page component in inertia
    Create another defineProps called componentName: String, to become dynamic
    -->
        <slot /> <!--This means saying anything can go in here-->
    </Link> 

</template>