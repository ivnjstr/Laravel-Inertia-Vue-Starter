<script setup>
defineProps({
    paginator: Object,
})

const makeLabel = (label) => {

    if (label.includes("Previous")){
        return "<<";
    }else if(label.includes("Next")){
        return ">>";
    }else {
        return label;
    }
};

//so calling this function makeLabel which will take a label as a parameter and check if its include the word Previous then it will change it to << as well as in Next

</script>
<template>
    <div class="flex justify-between items-start">
        <div class="flex items-center rounded-mb overflow-hidden shadow-lg">
            <div v-for="(link, i) in paginator.links" :key="i"> <!--Grabbing the index of Links-->

                <component 
                    :is="link.url ? 'Link' : 'span'"
                    :href="link.url"
                    v-html="makeLabel(link.label)"
                    class="border-x rounded-t-md border-slate-50 w-12 h-12 grid place-items-center bg-white dark:bg-slate-900 dark:border-slate-800" 
                    :class="{
                        'hover:bg-slate-300 dark:hover:bg-slate-500' : link.url,
                        'text-slate-300' : !link.url,
                        'font-bold text-indigo-500 dark:text-indigo-400' : link.active,
                    }"

                />
                <!--through this element we can say what is component example is="span" then its going to render a span or is="Link" and etc.-->
                <!--Make it dynamic bind this using : or if-->
                <!--if :is="link.url" is true then render a Link element (from inertia vue) using ?-->
                <!--the if its not or null the url thenn render a span-->
                <!--then we need an href if that is a link bind that to link.url-->
                <!--then we need a label we use v-html bind to link.label-->
                <!--we use vhtml because notice we have an html in symbol in label-->

                <!--3 conditional classes (add some dynamic classes)-->
                <!--bind the class to an object using :class="{}"-->
                <!--1st dynamic class -> 'hover:bg-slate-300 dark:hover:bg-slate-500' : link.url added the hover object if the link url is true-->
                <!--2nd mute the button if there is no link > 'text-slate' : !link.url, if link url is false-->
                <!--3rd to show which page we are on -->
            </div>
        </div>

        <p class="text-slate-600 dark:text-slate-400 text-sm">
                Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} results.
        </p>


    </div>
</template>