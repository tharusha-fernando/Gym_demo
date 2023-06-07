<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Layout from '../../Components/Layout.vue';
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

function submit() {
    form.post('/gym-owner')
}

</script>

<template>
    <Layout title="Add Owner">
        <div class="bg-white text-gray-900 dark:bg-gray-800 text-white ml-4 mr-4 md-2 rounded-lg">

            <div>


                <form class="mr-4 ml-4 md-4" @submit.prevent="submit">

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gym
                                Name</label>
                            <input type="text" id="first_name" v-model="form.gym_name" name="gym_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="last_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Regestration
                                Number</label>
                            <input type="text" id="last_name" v-model="form.registration_number" name="registration_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Doe" required>
                        </div>
                        <div>
                            <label for="company"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" id="company" name="address" v-model="form.address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Flowbite" required>
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                number</label>
                            <input type="tel" id="phone" name="contact_phone" v-model="form.contact_phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="123-45-678"  required>
                        </div>
                        <div>

                            <label for="message"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="message" rows="4" name="description" v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>

                        </div>
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Logo/Cove</label>
                            <input name="logo" @input="form.logo"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file">

                        </div>
                        <div>
                            <label for="company"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opening Hours</label>
                            <input type="text" id="company" name="opening_hours" v-model="form.opening_hours"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Flowbite" required>
                        </div>
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Legal Docs</label>
                            <input name="legal_docs" @input="form.legal_docs"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="file_input" type="file">

                        </div>

                    </div>

                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="remember" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                required>
                        </div>
                        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with
                            the <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and
                                conditions</a>.</label>
                    </div>
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>


            </div>



        </div>
    </Layout>
</template>
