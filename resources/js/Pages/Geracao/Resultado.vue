<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Select from 'primevue/select';
import Stepper from 'primevue/stepper';
import StepList from 'primevue/steplist';
import StepPanels from 'primevue/steppanels';
import Step from 'primevue/step';
import StepPanel from 'primevue/steppanel';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import InputText from 'primevue/inputtext';
import axios, { all } from 'axios';
import { toastMixin } from '@/utils/toast';
import { ref, onMounted } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';
import Row from 'primevue/row';
import { FilterMatchMode } from '@primevue/core/api';

const page = usePage();

const grade_antiga = page.props.resultado.grade_antiga;
const grade_nova = page.props.resultado.grade_nova;
const disciplinas_cursadas_grade_antiga = page.props.resultado.disciplinas_cursadas_grade_antiga;
const disciplinas_abatidas_grade_nova = page.props.resultado.disciplinas_abatidas_grade_nova;
const disciplinas_a_cursar_grade_nova = page.props.resultado.disciplinas_a_cursar_grade_nova;


const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS }
});
</script>
<template>

    <Head title="Geração de Equivalências" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Resultado da geração de
                    equivalências</h2>
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
                        <Column field="carga_horaria" header="Carga Horaria" sortable></Column>
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
