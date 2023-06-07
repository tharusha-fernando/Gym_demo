<script setup>
import { computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const props=defineProps({
    links:Array
});



</script>

<template>
    <nav aria-label="Page navigation example" class="mb-4 rounded-lg">
        <ul class="inline-flex items-center -space-x-px mt-2">


            <li v-for="link in links">

                <Link :href="link.url" v-html="link.label"
                    class="px-3 py-2  leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                </Link>
            </li>



        </ul>
    </nav>
</template>


























