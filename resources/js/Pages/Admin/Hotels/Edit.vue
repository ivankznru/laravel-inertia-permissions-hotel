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
import {computed, onMounted, watch} from "vue";


const props = defineProps({

  hotel: {
    type: Object,
    required: true,
  },
  facilities: {
     type: Object,
     required: true,

  },
    poster_url:String,

});

const form = useForm({
    hotel_name: props.hotel?.hotel_name,
  description: props.hotel?.description,
  poster_url: props.hotel?.poster_url,
  address: props.hotel?.address,
  facilities:props.facilities?.facilities,
});


function updateHotel() {
    router.post(`/hotels/${props.hotel.id}`, {
        _method: 'put',
        hotel_name: form.hotel_name,
        description: form.description,
        address:form.address,
        facilities:form.facilities,
        poster_url:form.poster_url,
    })

}

</script>

<template>
  <Head title="Update hotel" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link
          :href="route('hotels.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
          >Back</Link
        >
      </div>
      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-indigo-700">Update hotel</h1>
          <form @submit.prevent="updateHotel">
          <div class="mt-4">
            <InputLabel for="name" value="Наименование" />
            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.hotel_name"
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
                          :src="'/image/front/hotel/' + hotel.poster_url"
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
                <InputLabel for="address" value="Адрес" />
                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autofocus
                    autocomplete="Address"
                />

                <InputError class="mt-2" :message="form.errors.address" />
            </div>
            <div class="mt-4" >
                  <InputLabel for="facilities" value="Выберите особености" />
                  <select  class="border-gray-300 p-2 w-1/4" v-model="form.facilities" multiple>
                      <option  value="null" selected disabled>Выберите особеность</option>
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
