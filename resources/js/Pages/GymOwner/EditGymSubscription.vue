<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import LayoutGymOwnerVue from '../../Components/LayoutGymOwner.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: props.gymSubscription.name,
    price: props.gymSubscription.price,
    description: props.gymSubscription.description,
    member_count:props.gymSubscription.member_count


});

const props = defineProps({
    gymSubscription:Object,
});


function submit() {
  form.put(route('gym-subscriptions.update', { gym_subscription: props.gymSubscription.id }));
}


</script>

<template>
    <LayoutGymOwnerVue title="Add Owner">
        <div class="bg-white text-gray-900 dark:bg-gray-800 text-white ml-4 mr-4 md-2 rounded-lg">
            <div class="mb-6 ml-2 mr-2 p-4">
        <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Update Package</h2>
        <hr/>
    </div>

            <div>


                <form class="mr-4 ml-4 md-4" @submit.prevent="submit">

                    <div class="mb-6">
                        <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" id="base-input" v-model="form.name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-2 mr-2"></div>
                        
                        </div>
                    <div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                        <input type="text" id="small-input" v-model="form.price"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div v-if="form.errors.price" v-text="form.errors.price" class="text-red-500 text-xs mt-2 mr-2"></div>
                        
                        </div>
                        <!--div>
                        <label for="small-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Member Count</label>
                        <input type="text" id="small-input" v-model="form.member_count"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div v-if="form.errors.member_count" v-text="form.errors.member_count" class="text-red-500 text-xs mt-2 mr-2"></div>
                        
                        </div-->
                    <div class="mb-6">
                        <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" id="large-input" v-model="form.description"
                            class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-2 mr-2"></div>
                        
                        </div>
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                required>
                        </div>
                        <label for="terms" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree
                            with the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and
                                conditions</a></label>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        :disabled="form.processing">Edit</button>


                </form>



            </div>



    </div>
    </LayoutGymOwnerVue></template>
