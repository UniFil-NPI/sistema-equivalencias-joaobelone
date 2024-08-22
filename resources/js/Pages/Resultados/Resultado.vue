<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import 'sweetalert2/src/sweetalert2.scss'
import InputText from 'primevue/inputtext';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { FilterMatchMode } from '@primevue/core/api';

const page = usePage();

onMounted(() => {    
    console.log(page.props.resultado);
});

const grade_antiga = page.props.resultado.grade_antiga;
const grade_nova = page.props.resultado.grade_nova;
const disciplinas_cursadas_grade_antiga = page.props.resultado.disciplinas_cursadas;
const disciplinas_abatidas_grade_nova = page.props.resultado.disciplinas_abatidas;
const disciplinas_a_cursar_grade_nova = page.props.resultado.disciplinas_atribuidas;


const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS }
});

const downloadPdf = async (id) => {
    try {
        const response = await axios.get(route('geracao.pdf',id), {
            responseType: 'blob', // Important for handling binary data
        });

        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', `${page.props.resultado.titulo}.pdf`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } catch (error) {
        console.error('Error downloading the PDF:', error);
    }
};

</script>
<template>

    <Head title="Geração de Equivalências" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Resultado da geração de
                    equivalências - <span class="text-primary"> {{ $page.props.resultado.titulo }}</span></h2>
                    <button id="download_pdf" @click="downloadPdf($page.props.resultado.id)"
                    class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full"><i class="pi pi-download"></i> Baixar PDF</button>
            </div>
        </template>
        <div class="pt-12 pb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg gap-y-">
                    <DataTable v-model:filters="filters" filter removableSort stripedRows paginator :rows="25"
                        :rowsPerPageOptions="[25, 50, 100]" :value="disciplinas_cursadas_grade_antiga"
                        tableStyle="min-width: 20rem"
                        :globalFilterFields="['codigo', 'titulo', 'tipo', 'modalidade', 'carga_horaria']">
                        <template #empty>Nenhuma disciplina encontrada.</template>
                        <template #header>
                            <div class="flex justify-between">
                                <h2 class="text-xl font-bold">Disciplinas cursadas na grade antiga - <span class="text-primary"> {{
                                    grade_antiga?.titulo ?? '' }}</span></h2>
                                <InputText
                                    class="shadow appearance-none border rounded ps-10 w-96 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"
                                    v-model="filters['global'].value" placeholder="Pesquisa" />
                            </div>
                        </template>
                        <Column field="codigo" header="Codigo" sortable></Column>
                        <Column field="titulo" header="Titulo" sortable></Column>
                        <Column field="pivot.carga_horaria" header="Carga Horaria" sortable></Column>
                    </DataTable>

                </div>
            </div>
        </div>
        <div class="pt-6 pb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg gap-y-">
                    <DataTable v-model:filters="filters" filter removableSort stripedRows paginator :rows="25"
                        :rowsPerPageOptions="[25, 50, 100]" :value="disciplinas_abatidas_grade_nova"
                        tableStyle="min-width: 20rem"
                        :globalFilterFields="['codigo', 'titulo', 'tipo', 'modalidade', 'carga_horaria']">
                        <template #empty>Nenhuma disciplina encontrada.</template>
                        <template #header>
                            <div class="flex justify-between">
                                <h2 class="text-xl font-bold">Disciplinas abatidas da grade nova - <span class="text-primary"> {{
                                    grade_nova?.titulo ?? '' }}</span></h2>
                                <InputText
                                    class="shadow appearance-none border rounded ps-10 w-96 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"
                                    v-model="filters['global'].value" placeholder="Pesquisa" />
                            </div>
                        </template>
                        <Column field="codigo" header="Codigo" sortable></Column>
                        <Column field="titulo" header="Titulo" sortable></Column>
                        <Column field="carga_horaria" header="Carga Horaria" sortable></Column>
                    </DataTable>

                </div>
            </div>
        </div>
        <div class="pt-6 pb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg gap-y-">
                    <DataTable v-model:filters="filters" filter removableSort stripedRows paginator :rows="25"
                        :rowsPerPageOptions="[25, 50, 100]" :value="disciplinas_a_cursar_grade_nova"
                        tableStyle="min-width: 20rem"
                        :globalFilterFields="['codigo', 'titulo', 'tipo', 'modalidade', 'carga_horaria']">
                        <template #empty>Nenhuma disciplina encontrada.</template>
                        <template #header>
                            <div class="flex justify-between">
                                <h2 class="text-xl font-bold">Disciplinas a cursar na grade nova - <span class="text-primary"> {{
                                    grade_nova?.titulo ?? '' }}</span></h2>
                                <InputText
                                    class="shadow appearance-none border rounded ps-10 w-96 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"
                                    v-model="filters['global'].value" placeholder="Pesquisa" />
                            </div>
                        </template>
                        <Column field="codigo" header="Codigo" sortable></Column>
                        <Column field="titulo" header="Titulo" sortable></Column>
                        <Column field="carga_horaria" header="Carga Horaria" sortable></Column>
                    </DataTable>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
