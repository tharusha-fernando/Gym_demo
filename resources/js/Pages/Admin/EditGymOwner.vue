<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import Layout from '../../Components/Layout.vue';
import { Link, useForm, router } from '@inertiajs/vue3';


const props = defineProps({
    gymOwner: Object,
    image: String,
    errors: Array,
});

const form = useForm({
    gym_name: props.gymOwner.gym_name,
    owner_name: props.gymOwner.owner_name,
    registration_number: props.gymOwner.registration_number,
    contact_phone: props.gymOwner.contact_phone,
    address: props.gymOwner.address,
    description: props.gymOwner.description,
    logo: '',
    opening_hours: props.gymOwner.opening_hours,
    address: props.gymOwner.address,
    social_media_links: props.gymOwner.social_media_links,
    legal_docs: ''


});

function submit() {
    router.post(`/gym-owner/${props.gymOwner.id}`, {
        _method: 'put',
        gym_name: form.gym_name,
        owner_name: form.owner_name,
        registration_number: form.registration_number,
        contact_phone: form.contact_phone,
        address: form.address,
        description: form.description,
        logo: form.logo,
        opening_hours: form.opening_hours,
        address: form.address,
        social_media_links: form.social_media_links,
        legal_docs: form.legal_docs
    })
}

</script>

<template>
    <Layout title="Edit Owner">
        <div class="bg-white text-gray-900 dark:bg-gray-800 text-white ml-4 mr-4 md-2 rounded-lg">

            <div>

                <form class="mr-4 ml-4 md-4" @submit.prevent="submit">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="gym_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gym
                                Name</label>
                            <input type="text" id="gym_name" v-model="form.gym_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                            <div v-if="props.errors.gym_name" v-text="props.errors.gym_name"
                                class="text-red-500 text-xs mt-2 mr-2"></div>


                        </div>
                        <div>
                            <label for="owner_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Owner Name</label>
                            <input type="text" id="owner_name" v-model="form.owner_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Doe" required>
                            <div v-if="props.errors.owner_name" v-text="props.errors.owner_name"
                                class="text-red-500 text-xs mt-2 mr-2"></div>

                        </div>
                        <div>
                            <label for="registration_number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Regestration
                                Number</label>
                            <input type="text" id="registration_number" v-model="form.registration_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Flowbite" required>
                            <div v-if="props.errors.registration_number" v-text="props.errors.registration_number"
                                class="text-red-500 text-xs mt-2 mr-2"></div>

                        </div>
                        <div>
                            <label for="contact_phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
                                number</label>
                            <input type="tel" id="contact_phone" v-model="form.contact_phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="123-45-678" required>
                            <div v-if="props.errors.contact_phone" v-text="props.errors.contact_phone"
                                class="text-red-500 text-xs mt-2 mr-2"></div>

                        </div>
                        <div>
                            <label for="social_media_links"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Social Media
                                Links</label>
                            <input type="text" id="social_media_links" v-model="form.social_media_links"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="flowbite.com" required>
                            <div v-if="props.errors.social_media_links" v-text="props.errors.social_media_links"
                                class="text-red-500 text-xs mt-2 mr-2"></div>

                        </div>
                        <div>
                            <label for="address"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="url" id="address" v-model="form.address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="flowbite.com" required>
                            <div v-if="props.errors.address" v-text="props.errors.address"
                                class="text-red-500 text-xs mt-2 mr-2"></div>

                        </div>
                        <div>

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="logo">Logo</label>
                            <div class="m-2 p-2">
                                <img :src="image" class="w-32 h-32" />
                            </div>
                            <input @input="form.logo = $event.target.files[0]"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="logo" type="file">
                            <div v-if="props.errors.logo" v-text="props.errors.logo" class="text-red-500 text-xs mt-2 mr-2">
                            </div>



                        </div>
                        <div>


                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="4" v-model="form.description"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                            <div v-if="props.errors.description" v-text="props.errors.description"
                                class="text-red-500 text-xs mt-2 mr-2"></div>



                        </div>
                        <div>
                            <label for="opening_hours"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opening Hours</label>
                            <input type="text" id="opening_hours" v-model="form.opening_hours"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="flowbite.com" required>
                            <div v-if="props.errors.opening_hours" v-text="props.errors.opening_hours"
                                class="text-red-500 text-xs mt-2 mr-2"></div>

                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="legal_docs">Legal Docs</label>
                            <input @input="form.legal_docs = $event.target.files[0]"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="legal_docs" type="file">
                            <div v-if="props.errors.legal_docs" v-text="props.errors.legal_docs"
                                class="text-red-500 text-xs mt-2 mr-2"></div>
                            <div v-if="gymOwner.legal_docs">
                                <button type="button"
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    <a :href="route('gym-owners.download-docs', gymOwner.id)"
                                        class="block w-full h-full">
                                        Download Docs 
                                        
                            </a>
                                </button>
                            </div>

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
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                
                    </form>


            </div>



        </div>
    </Layout>
</template>
