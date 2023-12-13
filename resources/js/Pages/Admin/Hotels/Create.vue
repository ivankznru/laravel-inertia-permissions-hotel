<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    facilities: {
        type: Object,
        required: true,
    },
});

const form = useForm({
  hotel_name: "",
  description: "",
  poster_url: "",
  address: "",
  facilities:[],
});

function storeHotel() {
    form.post('/hotels')
}

</script>

<template>
  <Head title="Создать новый отель " />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link
          :href="route('hotels.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
          >Назад</Link
        >
      </div>
      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-indigo-700">Создать новый отель</h1>
          <form @submit.prevent="storeHotel">
          <div class="mt-4">
            <InputLabel for="name" value="name" />
            <TextInput
              id="hotel_name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.hotel_name"
              autofocus
              autocomplete="name"
            />
            <InputError class="mt-2" :message="form.errors.hotel_name" />
          </div>
          <div class="mt-4">
                <InputLabel for="description" value="description" />
                <TextInput
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    autofocus
                    autocomplete="description"
                />
                <InputError class="mt-2" :message="form.errors.description" />
          </div>
          <div class="mt-4">
                  <InputLabel for="poster_url" value="Фото" />
                  <input type="file" @input="form.poster_url = $event.target.files[0]"/>
                  <InputError class="mt-2" :message="form.errors.poster_url" />
          </div>
          <div class="mt-4">
                <InputLabel for="address" value="address" />
                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autofocus
                    autocomplete="address"
                />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>
            <div class="mt-4">
                  <InputLabel for="facilities" value="Выберите особености" />
                  <select class="border-gray-300 p-2 w-1/4" v-model="form.facilities" multiple>
                      <option value="null" selected disabled>Выберите особеность</option>
                      <option v-for="facility in facilities" :value="facility.id">{{ facility.name }}</option>
                  </select>
                  <InputError class="mt-2" :message="form.errors.facilities" />
            </div>
          <div class="flex items-center mt-4">
            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              type="submit"
            >
              Создать
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
