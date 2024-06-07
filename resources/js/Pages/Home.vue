<script>
import {ref} from 'vue';
import {useForm} from '@inertiajs/vue3';

export default {
    setup() {
        const selected = ref({
            home: false,
            auto: false,
            rv: false,
        });

        const toggleSelection = (type) => {
            selected.value[type] = !selected.value[type];
        };

        const submitForm = () => {
            const form = useForm({
                home: selected.value.home,
                auto: selected.value.auto,
                rv: selected.value.rv,
            });

            form.post('/insurance-quote');
        };

        return {
            selected,
            toggleSelection,
            submitForm,
        };
    },
};
</script>

<template>
    <div class="flex h-screen">
        <!-- Left image section -->
        <div class="w-1/2 bg-cover bg-center rounded-2xl" style="background-image: url(./assets/images/home.jpg)"></div>

        <div class="w-1/2 flex items-center justify-center">
            <div class="bg-white  rounded-lg max-w-xl w-full ">
                <h2 class="text-4xl font-bold mb-6 ">Let's get started</h2>
                <p class="mb-6 text-gray-400 ">Please select one or more options below that you'd like to have quoted for insurance.</p>
                <div class="space-y-4">
                    <button @click="toggleSelection('home')" :class="{'bg-gray-100 text-gray-800 border border-blue-600': selected.home, 'bg-gray-100 text-gray-800': !selected.home}" class="w-full py-6 px-4 rounded-lg flex flex-col items-start justify-center text-center">
                        <span>Home</span>
                        <span  class="mt-2">Your current or soon-to-be home</span>
                    </button>
                    <button @click="toggleSelection('auto')" :class="{'bg-gray-100 text-gray-800 border border-blue-600': selected.auto, 'bg-gray-100 text-gray-800': !selected.auto}" class="w-full py-6 px-4 rounded-lg flex flex-col items-start justify-center text-center">
                        <span>Auto</span>
                        <span class="mt-2">Your personal vehicle(s)</span>
                    </button>
                    <button @click="toggleSelection('rv')" :class="{'bg-gray-100 text-gray-800 border border-blue-600': selected.rv, 'bg-gray-100 text-gray-800': !selected.rv}" class="w-full py-6 px-4 rounded-lg flex flex-col items-start justify-center text-center">
                        <span>Recreational Vehicle</span>
                        <span class="mt-2">Your boat, RV, motorcycle, etc.</span>
                    </button>
                </div>
                <button @click="submitForm" class="mt-6 w-full bg-blue-500 text-white py-4 px-4 rounded-lg">Agree and Continue</button>
            </div>
        </div>
    </div>
</template>


<style scoped>
button.bg-gray-100:hover {
    background-color: #e2e8f0;
}
</style>
