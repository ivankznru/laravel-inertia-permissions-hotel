<script setup>
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { usePermission } from "@/composables/permissions";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["hotels"]);
const form = useForm({});

const showConfirmDeleteHotelModal = ref(false);
const { hasPermission } = usePermission();

const confirmDeleteHotel = () => {
    showConfirmDeleteHotelModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteHotelModal.value = false;
};

const deleteHotel = (id) => {
    form.delete(route("hotels.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Hotels Index" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Hotels Index Page</h1>
                <template v-if="hasPermission('create hotel')">
                    <Link
                        :href="route('hotels.create')"
                        class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                        >New Hotel</Link
                    >
                </template>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Description</TableHeaderCell>
                            <TableHeaderCell>Photo</TableHeaderCell>
                            <TableHeaderCell>Address</TableHeaderCell>
                            <TableHeaderCell>Facilities</TableHeaderCell>
                            <TableHeaderCell>Action</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow
                            v-for="hotel in hotels"
                            :key="hotel.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ hotel.id }}</TableDataCell>
                            <TableDataCell>{{ hotel.hotel_name }}</TableDataCell>
                            <TableDataCell>{{ hotel.description }}</TableDataCell>
                            <TableDataCell><img v-if="hotel.poster_url" class="w-full w-24 h-24 block" :src="'image/front/hotel/' + hotel.poster_url" :alt="hotel.poster_url"></TableDataCell>
                            <TableDataCell>{{ hotel.address }}</TableDataCell>
                            <TableDataCell><div v-for="facility in hotel.facilities">{{facility.name}}</div></TableDataCell>
                            <TableDataCell class="space-x-4">
                                <template v-if="hasPermission('update hotel')">
                                    <Link
                                        :href="route('hotels.edit', hotel.id)"
                                        class="text-green-400 hover:text-green-600"
                                        >Edit</Link
                                    >
                                </template>
                                <template v-if="hasPermission('delete hotel')">
                                    <button
                                        @click="confirmDeleteHotel"
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Delete
                                    </button>
                                </template>

                                <Modal
                                    :show="showConfirmDeleteHotelModal"
                                    @close="closeModal"
                                >
                                    <div class="p-6">
                                        <h2
                                            class="text-lg font-semibold text-slate-800"
                                        >
                                            Are you sure to delete this Hotel?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton
                                                @click="deleteHotel(hotel.id)"
                                                >Delete</DangerButton
                                            >
                                            <SecondaryButton @click="closeModal"
                                                >Cancel</SecondaryButton
                                            >
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
