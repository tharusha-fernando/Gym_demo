<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import { createPopper } from '@popperjs/core';
import GymownerNav from './GymownerNav.vue';
import FooterVue from './Footer.vue';




import { 
    initAccordions, 
    initCarousels, 
    initCollapses, 
    initDials, 
    initDismisses, 
    initDrawers, 
    initDropdowns, 
    initModals, 
    initPopovers, 
    initTabs, 
    initTooltips } from 'flowbite'

    onMounted(() => {
        initAccordions();
        initCarousels();
        initCollapses();
        initDials();
        initDismisses();
        initDrawers();
        initDropdowns();
        initModals();
        initPopovers();
        initTabs();
        initTooltips();
    })



defineProps({
    title: String,
});




const showingNavigationDropdown = ref(false);
const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};


</script>


<template>
    <div>

        <Head :title="title" />
        <GymownerNav/>
       
        
        <div class="min-h-screen bg-white dark:bg-gray-900" >
            

            <main >
                <slot />
            </main>

            <FooterVue/>

           


        </div>
    </div>
</template>
