<script setup>
import { Link, router } from '@inertiajs/vue3';

defineProps({
    listing: Object,
});

const selectUser = (id) => {
    //we want to do the same thing as we did in home.vue using router with the payloads
    router.get(route('home'), {
        user_id: id,
    })

}
</script>

<template>
    <div
        class="bg-white rounded-lg shadow-lg overflow-hidden dark:bg-slate-800 h-full flex flex-col justify-between"
    >
        <div>
            <!-- Image -->
            <Link href="" >
                <!--we want to show the default image now -->
                <img 
                    :src="listing.image ? `/storage/${listing.image}` : `/storage/images/listing/default.jpg`"
                    class="w-full h-48 object-cover object-center bg-slate-300"
                    alt="">
            </Link>

            <!-- the idea of Link is, if you click the image it would go to the detail page of that listing-->

            <!--Title-->
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">
                    {{ listing.title.substring(0, 40) }}... <!--Start form 0 to 40 letters-->
                </h3>
                <p>Listed on {{ new Date(listing.created_at).toLocaleDateString() }} by 

                    <button class="text-link" @click="selectUser(listing.user.id)">
                        {{ listing.user.name }}
                    </button>
                
                </p>
            </div>

            <!--Tags-->
            <div v-if="listing.tags" class="flex items-center gap-3 px-4 pb-4">
                <!--if listing tag was true -->
                <div v-for="tag in listing.tags.split(',')" :key="tag"> <!--the split separator is comma -->
                    <button class="bg-slate-500 text-white px-2 py-px rounded-full hover:bg-slate-700 dark:hover:bg-slate-900">
                        {{ tag }}
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>