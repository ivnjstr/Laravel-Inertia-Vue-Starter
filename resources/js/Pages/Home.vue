<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import Card from '../Components/Card.vue'
import PaginationLinks from '../Components/PaginationLinks.vue'
import InputField from '../Components/InputField.vue'

const props = defineProps({
    listings: Object,
    searchTerm: String
});

const form = useForm({
    search: props.searchTerm,
});

const search = () => {
    //we want to submit this using the inertia function 
    //on this instance we have all the http method so that we can use get method
    router.get(route("home"), { search: form.search });
    //include route function part of ziggy package
    //route('home') > firts argument from get methods next payload which is an object
};

</script>

<template>
    {{ console.log(listings) }}
    <!-- <header>
        <p>This is a simple starter kit for Laravel 11, Inertia JS, and Vue JS, without authentication. Tailwind and ZiggyVue are installed.</p>
    </header> -->

    <Head title="- Latest Listings"/>

    <!--Search Section-->
    <div class="flex items-center justify-between mb-4">
        <div>Filters</div>
        <div class="w-1/4">
            <form @submit.prevent="search">
                <!--import the InputFeild-->
                <InputField
                    type="search"
                    label=""
                    icon="magnifying-glass"
                    placeholder="Search.."
                    v-model="form.search"
                />
            </form>
        </div>
    </div>



    <!--Check if they are in there are any Listings -->
    <div v-if="Object.keys(listings.data).length"> <!--data array ng listing if this true-->
        
        <!--Card-->
        <div class="grid grid-cols-3 gap-4">
            <div v-for="listing in listings.data" :key="listing.id">
                <!-- {{ listing.title }} -->
                <Card :listing="listing"/>
            </div>
        </div>

        <!--Pagination-->
        <div class="mt-8">
            <PaginationLinks :paginator="listings" />
        </div>
        
    </div>

    <div v-else>
        There are no Listings.

    </div>

</template>