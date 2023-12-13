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

defineProps(["rooms","facilities"]);
const form = useForm({});

const showConfirmDeleteRoomModal = ref(false);
const { hasPermission } = usePermission();

const confirmDeleteRoom = () => {
    showConfirmDeleteRoomModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteRoomModal.value = false;
};

const deleteRoom = (id) => {
    form.delete(route("rooms.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Rooms Index" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Rooms Index Page</h1>
                <template v-if="hasPermission('create room')">
                    <Link
                        :href="route('rooms.create')"
                        class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                        >New Room</Link
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
                            <TableHeaderCell>Floor_area</TableHeaderCell>
                            <TableHeaderCell>Type</TableHeaderCell>
                            <TableHeaderCell>Price</TableHeaderCell>
                            <TableHeaderCell>Hotel_id</TableHeaderCell>
                            <TableHeaderCell>Room_facilities</TableHeaderCell>
                            <TableHeaderCell>Action</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow
                            v-for="room in rooms"
                            :key="room.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ room.id }}</TableDataCell>
                            <TableDataCell>{{ room.name }}</TableDataCell>
                            <TableDataCell>{{ room.description }}</TableDataCell>
                            <TableDataCell> <img v-if="room.poster_url" class="w-full w-24 h-24 block" :src="'image/front/room/' + room.poster_url" :alt="room.poster_url"></TableDataCell>
                            <TableDataCell>{{ room.floor_area }}</TableDataCell>
                            <TableDataCell>{{ room.type }}</TableDataCell>
                            <TableDataCell>{{ room.price }}</TableDataCell>
                            <TableDataCell>{{ room.hotel_name}}</TableDataCell>
                            <TableDataCell><div v-for="facility in room.facilities">{{facility.name}}</div></TableDataCell>
                            <TableDataCell class="space-x-4">
                                <template v-if="hasPermission('update room')">
                                    <Link
                                        :href="route('rooms.edit', room.id)"
                                        class="text-green-400 hover:text-green-600"
                                        >Edit</Link
                                    >
                                </template>
                                <template v-if="hasPermission('delete room')">
                                    <button
                                        @click="confirmDeleteRoom"
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Delete
                                    </button>
                                </template>

                                <Modal
                                    :show="showConfirmDeleteRoomModal"
                                    @close="closeModal"
                                >
                                    <div class="p-6">
                                        <h2
                                            class="text-lg font-semibold text-slate-800"
                                        >
                                            Are you sure to delete this Room?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton
                                                @click="deleteRoom(room.id)"
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
