<script setup>
import { Head } from '@inertiajs/vue3';
import Card from '../Components/Card.vue'


defineProps({
    listings: Object,
});

</script>

<template>
    {{ console.log(listings) }}
    <!-- <header>
        <p>This is a simple starter kit for Laravel 11, Inertia JS, and Vue JS, without authentication. Tailwind and ZiggyVue are installed.</p>
    </header> -->

    <Head title="- Latest Listings"/>

    <!--Check if they are in there are any Listings -->
    <div v-if="Object.keys(listings.data).length"> <!--data array ng listing if this true-->
        <div class="grid grid-cols-3 gap-4">
            <div v-for="listing in listings.data" :key="listing.id">
                <!-- {{ listing.title }} -->
                <Card :listing="listing"/>
            </div>

        </div>
    </div>

</template>