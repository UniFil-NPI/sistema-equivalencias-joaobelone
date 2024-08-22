<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import {ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { FilterMatchMode } from '@primevue/core/api';

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS }
});

const downloadPdf = async (titulo, id) => {
    try {
        const response = await axios.get(route('geracao.pdf',id), {
            responseType: 'blob', // Important for handling binary data
        });

        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `${titulo}.pdf`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (error) {
        console.error('Error downloading the PDF:', error);
    }
};

</script>
<template>

    <Head title="Histórico" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Histórico de gerações</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable v-model:filters="filters" filter removableSort stripedRows paginator :rows="25"
                        :rowsPerPageOptions="[25, 50, 100]" :value="$page.props.resultados"
                        tableStyle="min-width: 20rem"
                        :globalFilterFields="['titulo', 'grade_antiga', 'grade_nova', 'created_at']">
                        <template #empty>Nenhum resultado encontrado.</template>
                        <template #header>
                            <div class="flex justify-start">
                                <IconField class="pt-2" iconPosition="left">
                                    <InputIcon>
                                        <i class="pi pi-search" />
                                    </InputIcon>
                                    <InputText
                                        class="shadow appearance-none border rounded ps-10 w-96 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"
                                        v-model="filters['global'].value" placeholder="Pesquisa" />
                                </IconField>
                            </div>
                        </template>

                        <Column field="titulo" header="Titulo" sortable></Column>
                        <Column field="created_at" header="Data" sortable>
                            <template #body="slotProps">
                                {{ new Date(slotProps.data.created_at).toLocaleString('br') }}
                            </template>
                        </Column>
                        <Column field="grade_antiga.titulo" header="Grade Antiga" sortable></Column>
                        <Column field="grade_nova.titulo" header="Grade Nova" sortable></Column>
                        <Column field="id" header="Ações">
                            <template #body="slotProps">
                                <div class="gap-4 flex">
                                <a class="transition ease-in-out hover:text-blue-500  flex justify-center items-center rounded-full"
                                    :href="route('geracao.resultado', slotProps.data.id)"><i class="pi pi-eye"></i></a>
                                    <button class="transition ease-in-out hover:text-green-400  flex justify-center items-center rounded-full"
                                    @click="downloadPdf(slotProps.data.titulo, slotProps.data.id)"><i class="pi pi-download"></i></button>
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
