<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Head, Link, router, useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import { onMounted, watch } from "vue";

import InputNumber from 'primevue/inputnumber';

const props = defineProps({
  room: {
    type: Object,
    required: true,
  },
    hotels: {
        type: Object,
        required: true,
    },
    facilities: {
        type: Object,
        required: true,
    },
    poster_url:String
});
const form = useForm({
  name: props.room?.name,
  description: props.room?.description,
  poster_url: props.room?.poster_url,
  floor_area: props.room?.floor_area,
  type: props.room?.type,
  price: props.room?.price,
  hotel_id: props.room?.hotel_id,
  facilities:props.facilities?.facilities,

});
function updateRoom() {
    router.post(`/rooms/${props.room.id}`, {
        _method: 'put',
        name: form.name,
        description: form.description,
        floor_area: form.floor_area,
        type: form.type,
        price:form.price,
        hotel_id:form.hotel_id,
        facilities:form.facilities,
        poster_url:form.poster_url,
    })
}


</script>

<template>
  <Head title="Update room" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link
          :href="route('rooms.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
          >Back</Link
        >
      </div>
      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-indigo-700">Update room</h1>
          <form @submit.prevent="updateRoom">
          <div class="mt-4">
            <InputLabel for="name" value="Наименование" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              autofocus
              autocomplete="Name"
            />

            <InputError class="mt-2" :message="form.errors.name" />
          </div>
          <div class="mt-4">
                <InputLabel for="description" value="Описание" />
                <TextInput
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    autofocus
                    autocomplete="Description"
                />

                <InputError class="mt-2" :message="form.errors.description" />
            </div>
            <div class="mt-4">
                <InputLabel for="poster_url" value="Существующее фото" />
                <p>
                    <img
                        class="img-thumbnail"
                        :src="'/image/front/room/' + room.poster_url"
                        width="80"
                        height="50"
                        alt=""
                    />
                </p>
                <InputLabel for="poster_url" value="Фото на замену" />
                <input type="file" @input="form.poster_url = $event.target.files[0]"/>
                <InputError class="mt-2" :message="form.errors.poster_url" />

            </div>
          <div class="mt-4">
                <InputLabel for="floor_area" value="floor_area" />
              <InputNumber v-model="form.floor_area"  inputId="square meterminmaxfraction stacked-buttons" :minFractionDigits="2" suffix=" m²" showButtons :min="0"  />

                <InputError class="mt-2" :message="form.errors.floor_area" />
          </div>
          <div class="mt-4">
                <InputLabel for="type" value="Type" />
                <TextInput
                    id="type"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.type"
                    autofocus
                    autocomplete="Type"
                />

                <InputError class="mt-2" :message="form.errors.type" />
          </div>
          <div class="mt-4">
                <InputLabel for="price" value="price" />
              <InputNumber v-model="form.price" inputId="stacked-buttons" showButtons mode="currency" currency="RUB" locale="ru-RU" :min="0" />

                <InputError class="mt-2" :message="form.errors.price" />
          </div>
          <div class="mt-4">
                <InputLabel for="hotel_id" value="Выберите отель" />
                <select class="border-gray-300 p-2 w-1/4" v-model="form.hotel_id" >
                    <option value="null" selected disabled>Выберите отель</option>
                    <option v-for="hotel in hotels" :value="hotel.id">{{ hotel.name }}</option>
                </select>
                <InputError class="mt-2" :message="form.errors.hotel_id" />
          </div>
          <div class="mt-4">
                <InputLabel for="facilities" value="Выберите особености" />
                <select class="border-gray-300 p-2 w-1/4" v-model="form.facilities" multiple name="facilities[]" >
                    <option value="null" selected disabled>Выберите особеность</option>
                    <option  v-for="facility in facilities" :value="facility.id" > {{ facility.name }}</option>
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
              Update
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
