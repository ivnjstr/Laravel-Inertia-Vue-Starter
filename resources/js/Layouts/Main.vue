<script setup>
import { switchTheme } from '../theme';
import NavLink from '../Components/NavLink.vue'; // import NavLink
import { usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { route } from '../../../vendor/tightenco/ziggy/src/js';


const page = usePage() // usePage() this is from inertia
const user = computed(()=> page.props.auth.user) //computed this is from the vue


const show = ref(false)

</script>

<template>
    <!--overlay-->
    <div v-show="show" @click="show = false" class="fixed inset-0 z-40 "></div>
    <!--we are cover the whole page class="fixed inset-0 z-40">-->

    <header class="bg-slate-800 text-white">
        <nav class="p-6 mx-auto max-w-screen-lg flex items-center justify-between">

            <NavLink routeName="home" componentName="Home">Home</NavLink> <!-- this is inertia link-->

            <div class="flex items-center space-x-6">

                <!--------------Auth Section----------->
                <div v-if="user" class="relative"> <!--means if user is true then show this p tag.-->

                      <div
                      @click = "show = !show"
                      class="flex items-center gap-2 px-3 py-1 rounded-lg hover:bg-slate-700 cursor-pointer"
                      :class="{'bg-slate-700' : show}">
                        <!--@click = "show = !show" > this means if show is true set it to false and if false set it to true-->
                        <p>{{ user.name }}</p>
                        <i class="fa-solid fa-angle-down"></i>
                      </div>

                      <!--------------User Dropdown Menu----------->
                      <div
                      v-show="show"
                      @click = "show = false"
                      class="absolute z-50 top-16 right-0 bg-slate-800 text-white rounded-lg border-slate-200 border overflow-hidden w-40">

                      <!--Profile Edit-->
                      <Link
                        :href="route('profile.edit')"
                        class="block w-full px-6 py-3 hover:bg-slate-700 text-left">Profile
                      </Link>  

                      <!--Dashboard-->
                      <Link
                        :href="route('dashboard')"
                        class="block w-full px-6 py-3 hover:bg-slate-700 text-left">Dashboard
                      </Link>  

                      <!--Logout-->
                      <Link
                      :href="route('logout')"
                      method="post"
                      as="button"
                      class="block w-full px-6 py-3 hover:bg-slate-700 text-left">Logout
                      </Link>

                      </div>

                </div>
                

                <!--------------Guest Section----------->
                <div v-else class="space-x-6">
                    <!--Link for Login-->
                    <NavLink routeName="login" componentName="Auth/Login">
                        Login
                    </NavLink>

                    <NavLink routeName="register" componentName="Auth/Register">
                        Register
                    </NavLink>
                </div>
               
                <button
                    @click="switchTheme()" 
                    class=" hover:bg-slate-700 w-6 h-6 grid place-items-center rounded-full hover:outline outline-1 outline-white" >
                    
                    <i class="fa-solid fa-circle-half-stroke"></i>
                </button>
                
            </div>
        </nav>
    </header>

    <main class="p-6 mx-auto max-w-screen-lg">
        <slot />
    </main>
</template>
