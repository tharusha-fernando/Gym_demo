<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Layout from '../../Components/Layout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    gymOwner: Object
});
const form = useForm({
    amount: '',
    commission: '',
    payment_type: '',
    gym_owner_id: props.gymOwner.id,


});



function submit() {
    form.post('/gym-owner-payments')
}

</script>

<template>
    <Layout title="Add Owner">
        <div class="bg-white text-gray-900 dark:bg-gray-800 text-white ml-4 mr-4 md-2 rounded-lg">

            <div v-if="$page.props.flash.alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ $page.props.flash.alert }}
                </div>
            </div>
            
            <div>


                <form class="mr-4 ml-4 md-4" @submit.prevent="submit">


                    <div>
                        <label for="small-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="number" id="small-input" v-model="form.amount"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="form.errors.amount" v-text="form.errors.amount" class="text-red-500 text-xs mt-2 mr-2">
                        </div>

                    </div>

                    <div>
                        <label for="small-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Commission</label>
                        <input type="number" id="small-input" v-model="form.commission"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="form.errors.commission" v-text="form.errors.commission"
                            class="text-red-500 text-xs mt-2 mr-2"></div>

                    </div>
                    <div>

                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment
                            Type</label>
                        <select id="countries" v-model="form.payment_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option selected value="deposit">Deposit</option>
                            <option value="credit_card">Credit Card</option>

                        </select>
                        <div v-if="form.errors.payment_type" v-text="form.errors.payment_type"
                            class="text-red-500 text-xs mt-2 mr-2"></div>

                    </div>
                    <div>
                        <input type="hidden" id="small-input" v-model="form.gym_owner_id"
                            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="form.errors.gym_owner_id" v-text="form.errors.gym_owner_id"
                            class="text-red-500 text-xs mt-2 mr-2"></div>

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
                        :disabled="form.processing">Add New Payment For {{ gymOwner.gym_name }}</button>


                </form>



            </div>



    </div>
</Layout></template>
