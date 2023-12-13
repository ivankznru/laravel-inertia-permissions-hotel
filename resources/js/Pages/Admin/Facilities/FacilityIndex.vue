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

defineProps(["facilities"]);
const form = useForm({});

const showConfirmDeleteFacilityModal = ref(false);
const { hasPermission } = usePermission();

const confirmDeleteFacility = () => {
    showConfirmDeleteFacilityModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteFacilityModal.value = false;
};

const deleteFacility = (id) => {
    form.delete(route("facilities.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Facilities Index" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Facilities Index Page</h1>
                <template v-if="hasPermission('create facility')">
                    <Link
                        :href="route('facilities.create')"
                        class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                        >New Facility</Link
                    >
                </template>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Action</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow
                            v-for="facility in facilities"
                            :key="facility.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ facility.id }}</TableDataCell>
                            <TableDataCell>{{ facility.name }}</TableDataCell>
                            <TableDataCell class="space-x-4">
                                <template v-if="hasPermission('update facility')">
                                    <Link
                                        :href="route('facilities.edit', facility.id)"
                                        class="text-green-400 hover:text-green-600"
                                        >Edit</Link
                                    >
                                </template>
                                <template v-if="hasPermission('delete facility')">
                                    <button
                                        @click="confirmDeleteFacility"
                                        class="text-red-400 hover:text-red-600"
                                    >
                                        Delete
                                    </button>
                                </template>

                                <Modal
                                    :show="showConfirmDeleteFacilityModal"
                                    @close="closeModal"
                                >
                                    <div class="p-6">
                                        <h2
                                            class="text-lg font-semibold text-slate-800"
                                        >
                                            Are you sure to delete this Role?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton
                                                @click="deleteFacility(facility.id)"
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
