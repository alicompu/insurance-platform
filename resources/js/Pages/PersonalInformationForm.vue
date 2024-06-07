<script>
import {useForm} from '@inertiajs/vue3';

export default {
    setup() {

        const form = useForm({
            first_name: '',
            last_name: '',
            email: '',
            phone: '',
            contact_preference: 'email',
        });

        const submitForm = () => {
            form.post('/submit-personal-info');
        };

        const goBack = () => {
            form.reset();
            window.history.back();
        };

        return {
            form,
            submitForm,
            goBack,
        };
    },
};
</script>
<template>
    <div class="flex h-screen">
        <!-- Left image section -->
        <div class="w-1/2 bg-cover bg-center rounded-2xl" style="background-image: url(./assets/images/car.jpg)"></div>

        <!-- Right form section -->
        <div class="w-1/2 flex items-center justify-center  ">
            <div class="bg-white  rounded-lg max-w-xl w-full ">
                <h2 class="text-4xl font-bold mb-6 ">Personal Information</h2>
                <p class="mb-6 text-gray-400">Ok, Great! Before we continue, please let us know how we can contact you regarding your quote.</p>
                <form @submit.prevent="submitForm">
                    <div class="flex justify-between">
                        <div class="mb-4 flex-grow">
                            <label for="first-name" class="block text-gray-700">First name *</label>
                            <input v-model="form.first_name" placeholder="Enter First Name" type="text" id="first-name" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                        </div>
                        <div class="mb-4 flex-grow ml-4">
                            <label for="last-name" class="block text-gray-700">Last name *</label>
                            <input v-model="form.last_name" type="text" placeholder="Enter Last Name" id="last-name" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email Address *</label>
                        <input v-model="form.email" type="email" id="email" placeholder="Enter Email Address" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700">Phone No *</label>
                        <input v-model="form.phone" type="text" id="phone" placeholder="Enter Phone No" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                    </div>
                    <div class="mb-4">
                        <label for="contact-preference" class="block text-gray-700">Contact Preference *</label>
                        <select v-model="form.contact_preference" id="contact-preference" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white p-4 px-4 rounded-xl w-full font-bold">Continue</button>
                    <button @click.prevent="goBack" class="text-blue-500 w-full px-4 mt-6 font-bold">Back</button>
                </form>
            </div>
        </div>
    </div>
</template>
