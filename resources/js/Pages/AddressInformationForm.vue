<script>
import {useForm} from '@inertiajs/vue3';

export default {
    setup() {
        const form = useForm({
            street_address: '',
            apt: '',
            city: '',
            state: 'TX',
            zip: '',
        });

        const submitForm = () => {
            form.post('/submit-address-info');
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
        <div class="w-1/2 bg-cover bg-center rounded-2xl" style="background-image: url(./assets/images/address.jpg)"></div>

        <div class="w-1/2 flex items-center justify-center">
            <div class="bg-white  rounded-lg max-w-xl w-full ">
                <h2 class="text-4xl font-bold mb-6 ">Address Information</h2>
                <p class="mb-6 text-gray-400">We can help with that! What is your address?</p>
                <form @submit.prevent="submitForm">
                    <div class="flex justify-between">
                        <div class="mb-4 flex-grow">
                            <label for="street-address" class="block text-gray-700">Street Address</label>
                            <input v-model="form.street_address" type="text" placeholder="Enter Street Address" id="street-address" class="mt-1 block w-full border border-gray-300 rounded-xl p-4">
                        </div>
                        <div class="mb-4 flex-grow ml-4">
                            <label for="apt" class="block text-gray-700">Ste/Apt</label>
                            <input v-model="form.apt" type="text" id="apt" placeholder="-" class="mt-1 block w-full border border-gray-300 rounded-xl p-4">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700">City *</label>
                        <input v-model="form.city" type="text" id="city" placeholder="Enter City" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                    </div>
                    <div class="mb-4">
                        <label for="state" class="block text-gray-700">State *</label>
                        <select v-model="form.state" id="state" class="mt-1 block w-full border border-gray-300 rounded-xl p-4 " required>
                            <option value="TX">TX</option>
                            <option value="CA">CA</option>
                            <option value="NY">NY</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="zip" class="block text-gray-700">Zip Code *</label>
                        <input v-model="form.zip" type="text" id="zip" placeholder="Enter Zip Code" class="mt-1 block w-full border border-gray-300 rounded-xl p-4" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white p-4 px-4 rounded-xl w-full font-bold">Continue</button>
                    <button @click.prevent="goBack" class="text-blue-500 w-full px-4 mt-6 font-bold">Back</button>
                </form>
            </div>
        </div>
    </div>
</template>
