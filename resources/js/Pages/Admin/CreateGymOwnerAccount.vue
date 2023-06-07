<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Layout from '../../Components/Layout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
   

});

const props=defineProps({
    
});

function submit() {
    form.post('/create-account/gym-owner/store')
}

</script>

<template>
    <Layout title="Add Owner">
        <div class="bg-white text-gray-900 dark:bg-gray-800 text-white ml-4 mr-4 md-2 rounded-lg">

            <div>


                <form class="mr-4 ml-4 md-4" @submit.prevent="submit">
                    <div class="mb-6">
                            <label for="email"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                Name</label>
                            <input type="text" id="name" v-model="form.name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                placeholder="John Doe" required>
                                <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-2 mr-2"></div>
                        </div>
                    
                        <div class="mb-6">
                            <label for="email"  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                email</label>
                            <input type="email" id="email" v-model="form.email"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                placeholder="name@flowbite.com" required>
                                <div v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-2 mr-2"></div>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                password</label>
                            <input type="password" id="password" v-model="form.password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                required>
                                <div v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-2 mr-2"></div>
                        
                        </div>
                        <div class="mb-6">
                            <label for="repeat-password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>
                            <input type="password" id="repeat-password" v-model="form.password_confirmation"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                required>
                                <div v-if="form.errors.password_confirmation" v-text="form.errors.password_confirmation" class="text-red-500 text-xs mt-2 mr-2"></div>
                        
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
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :disabled="form.processing">Register
                            new account</button>
               

            </form>



        </div>



    </div>
</Layout></template>
