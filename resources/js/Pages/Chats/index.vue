<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Chat from '@/Components/Chats/Chat.vue';
import { useForm, Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Chats" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chats</h2>
        </template>
        <div class="flex justify-center  h-screen">
            <div class="bg-white shadow-md rounded-md overflow-hidden  mt-10 flex">
                <!-- Top Users Column -->
                <div class="w-1/2 bg-gray-100 py-2 px-4">
                    <h2 class="text-xl font-semibold text-gray-800">Users</h2>
                    <ul class="divide-y divide-gray-200">
                        <li class="flex items-center py-4 px-6">
                           
                            <img class="w-12 h-12 rounded-full object-cover mr-4"
                                src="https://randomuser.me/api/portraits/women/72.jpg" alt="User avatar">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-800">Emily Jones</h3>
                                <p class="text-gray-600 text-base">1234 points</p>
                            </div>
                        </li>
                        <!-- Add more user items as needed -->
                    </ul>
                </div>
                <div>
                    <Chat />
                </div>
                       
                 
            </div>
        </div>





    </AuthenticatedLayout>
</template>
