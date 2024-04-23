<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Chirp from '@/Components/Chirp/Chirp.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { ref, onMounted,computed } from 'vue'
//import Echo from 'laravel-echo';
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const user = computed(() => page.props.auth.user)

const messageSound = new Audio('/notification.wav');

const props = defineProps(['chirps']);
const Allchirps = ref(props.chirps)
onMounted(() => {
    messageSound.load();
//  console.log(Allchirps.value.push())
// console.log(Allchirps.value)
   Echo.listen(`ChirpCreated`,'ChirpCreated',(e)=>{
    
    console.log(e)
    Allchirps.value.unshift(e.chirp);
    if(user.value.id != e.chirp.user_id)
    playMessageSound();
   })
})

const playMessageSound = () => {
  // Check if the audio is supported and not currently playing
  if (messageSound && messageSound.paused) {
    messageSound.play();
  }
};
const notify = (text, theme, type) => {
    toast(text, {
        autoClose: 1000,
        theme: theme,
        type: type
    }); // ToastOptions
}

const form = useForm({
    message: '',
});




const disabled = ref(false)

const submit = () => {

    form.post(route('chirps.store'),
        {
            onStart: () => disabled.value = true,
            onSuccess: () => (form.reset(), notify("Chirp posted", 'dark', 'success')),
            onFinish: () => disabled.value = false
        })



}
</script>
<template>
    <Head title="Chirps" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chirps</h2>
        </template>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="submit">

                <textarea v-model="form.message" placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4" :disabled="disabled">Chirp<span v-if="disabled">...</span></PrimaryButton>
            </form>
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Chirp v-for="chirp in Allchirps" :key="chirp.id" :chirp="chirp" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>