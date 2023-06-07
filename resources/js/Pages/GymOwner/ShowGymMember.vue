<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import LayoutGymOwner from '../../Components/LayoutGymOwner.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    gym_name: '',
    registration_number: '',
    address: '',
    contact_phone: '',
    description: '',
    logo: '',
    opening_hours: '',
    legal_docs: '',

});

const props = defineProps({
    image: String,
    gymMember: Object
});


function submit() {
    form.post('/gym-owner')
}



</script>

<template>
    <LayoutGymOwner title="View Owner">

        <div class="flex items-center justify-center">

            <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">
                    <button id="dropdownButton" data-dropdown-toggle="dropdown"
                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                        <span class="sr-only">Open dropdown</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                            </path>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2" aria-labelledby="dropdownButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export
                                    Data</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src="image" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ props.gymMember.user.name }}</h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{
                        props.gymMember.user.email }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">NIC - {{
                        props.gymMember.nic }}</span>
                         <span class="text-sm text-gray-500 dark:text-gray-400">Member Id - {{
                        props.gymMember.id }}</span>

                    <span class="text-sm text-gray-500 dark:text-gray-400"><b>Subscription End - </b>{{
                        props.gymMember.subenddate }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400"><b>Subscription Type - </b>
                        <span v-if="gymMember.gym_subscription && gymMember.gym_subscription.name">{{
                            props.gymMember.gym_subscription.name }}</span></span>

                    <div class="flex mt-4 space-x-3 md:mt-6">
                        <div class="m-2">
                            <Link :href="route('gym-member-payments-seperate', { gymMember: props.gymMember.id })"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Add New Payment</Link>
                        </div>
                        <Link :href="route('threads-init', { user: props.gymMember.user.id })"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Message</Link>
                    </div>
                </div>
            </div>

        </div>
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

            <div class="m-2">

                <div class="relative overflow-x-auto mt-4">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Gym Name -
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.gym_name }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Owner Name --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.gymMember }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Regestration Name --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.registration_number }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Contact Phone --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.contact_phone }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Address --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.address }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Description --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.description }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Logo --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.logo }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Opening Hours --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.opening_hours }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Average Rating --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.average_rating }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Social Media Links --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.social_media_links }}
                                </td>

                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Legal Docs --
                                </th>
                                <td class="px-6 py-4">
                                    {{ props.gymMember.legal_docs }}
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>



        </div>
    </LayoutGymOwner>
</template>
