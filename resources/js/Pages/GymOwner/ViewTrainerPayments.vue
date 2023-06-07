<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import LayoutGymOwner from '../../Components/LayoutGymOwner.vue';
import { Link, useForm, router } from '@inertiajs/vue3';
import pagination from '../../Components/pagination.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    GymTrainerPayments: Object,
});

let search = ref('');

watch(search, value => {
    router.get(
        '/gym-trainer-payments',
        { search: value },
        {
            preserveState: true,
        }
    );
});


const date_from = ref('');
const date_to = ref('');

watch([date_from, date_to], ([newDateFrom, newDateTo]) => {
    router.get(
        '/gym-trainer-payments',
        { search: search.value, date_from: newDateFrom, date_to: newDateTo },
        {
            preserveState: true,
        }
    );
});



let printInvoice = () => {

    router.get({
        name: 'GymTrainerPaymentBasicInvoice', // Replace with the correct route name asasa asas
        query: { search: search.value, date_from: date_from.value, date_to: date_to.value },
    });
};


</script>


<template>
    <LayoutGymOwner title="View Owner">
        <div class="bg-white text-gray-900 dark:bg-gray-800 text-white ml-4 mr-4 md-2 rounded-lg">
            <div v-if="$page.props.flash.message"
                class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ $page.props.flash.message }}
                </div>
            </div>


            <div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between pb-4">
                        <div class="mr-2">
                            <div>
                                <label for="small-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">From</label>
                                <input type="date" id="small-input" v-model="date_from"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div>
                                <label for="small-input"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">To</label>
                                <input type="date" id="small-input" v-model="date_to"
                                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="table-search" v-model="search"
                                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for Payments">
                        </div>
                    </div>




                    <!--pagination-->

                    <div class="mb-4">
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="vue-checkbox-list" type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="vue-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Credit
                                        Card</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="react-checkbox-list" type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="react-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deposit</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="angular-checkbox-list" type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="angular-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Angular</label>
                                </div>
                            </li>
                            <li class="w-full dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="laravel-checkbox-list" type="checkbox" value=""
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="laravel-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laravel</label>
                                </div>
                            </li>
                        </ul>


                    </div>
                    <!--Search By-->

                    <div class="flex items-center justify-between pb-4">
                        <pagination :links="GymTrainerPayments.links" />



                    </div>


                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Commission
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Profit
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Payment Type
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="GymTrainerPayment in props.GymTrainerPayments.data" :key="GymTrainerPayment.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Payment Id - {{ GymTrainerPayment.id }} <br>
                                    Payment Date- {{ GymTrainerPayment.created_at }}
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <p v-if="GymTrainerPayment.gym_trainer.user.name">
                                        {{ GymTrainerPayment.gym_trainer.user.name }}
                                    </p>
                                </th>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    LKR{{ GymTrainerPayment.amount }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ GymTrainerPayment.commission }}%
                                </td>
                                <td class="px-6 py-4">
                                    LKR {{ GymTrainerPayment.profit }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ GymTrainerPayment.payment_type }}
                                </td>

                                

                            </tr>
                        </tbody>
                        <button type="button"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            <a :href="route('GymTrainerPaymentBasicInvoice', {search: search.value, date_from: newDateFrom, date_to: newDateTo  })"
                                class="block w-full h-full">
                                Download Docs
                            </a>
                        </button>
                        <button type="button" @click="printInvoice"
                            class="focus:outline-none mr-2 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Print
                            Invoice</button>
                    </table>
                </div>

            </div>


        </div>
    </LayoutGymOwner>
</template>
