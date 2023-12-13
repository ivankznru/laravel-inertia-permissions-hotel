<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";




</script>

<template>
  <Head title="Create new post" />

  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-between">
        <Link
          :href="route('posts.index')"
          class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
          >Back</Link
        >
      </div>
      <div class="mt-6 max-w-6xl mx-auto bg-slate-100 shadow-lg rounded-lg p-6">
        <h1 class="text-2xl font-semibold text-indigo-700">Create new post</h1>
        <form @submit.prevent="store()">
          <div class="mt-4">
            <InputLabel for="title" value="title" />
            <TextInput
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="title"
              autofocus
              autocomplete="title"
            />

            <InputError class="mt-2" :message="title" />
          </div>
            <div class="mt-4">
                <InputLabel for="content" value="content" />
                <TextInput
                    id="content"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="content"
                    autofocus
                    autocomplete="content"
                />

                <InputError class="mt-2" :message="content" />
            </div>
          <div class="flex items-center mt-4">
            <button type ='submit'>Store</button>
          </div>
        </form>
      </div>
    </div>
  </AdminLayout>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export  default {
    name: "Create",
    components:{
       Link
    },

    date() {
        return {
        title: '',
        content: '',
        }
    },

    methods:{
        store() {
          this.$inertia.post('/posts', {title: this.title, content: this.content})
        }
    }


}
</script>
