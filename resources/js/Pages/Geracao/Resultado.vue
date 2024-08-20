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

const page = usePage();

const grade_antiga = page.props.resultado.grade_antiga;
const grade_nova = page.props.resultado.grade_nova;
const disciplinas_cursadas_grade_antiga = page.props.resultado.disciplinas_cursadas_grade_antiga;
const disciplinas_matadas_grade_nova = page.props.resultado.disciplinas_matadas_grade_nova;
const disciplinas_a_cursar_grade_nova = page.props.resultado.disciplinas_a_cursar_grade_nova;

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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card flex justify-center mb-8">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-xl">
                            <DataTable :value="disciplinas_cursadas_grade_antiga" filter removableSort stripedRows
                                paginator :rows="10" :rowsPerPageOptions="[25, 50, 100]"
                                tableStyle="max-width: 50rem; border-radius:6%">
                                <template #header>
                                    <span class="text-xl font-bold">Disciplinas Cursadas ({{ grade_antiga?.titulo ??
                                        '' }})</span>
                                </template>
                                <Column field="codigo" header="Código"></Column>
                                <Column field="titulo" header="Titulo"></Column>
                                <Column field="carga_horaria" header="Carga Horária"></Column>


                            </DataTable>
                        </div>
                        <div>
                            <DataTable :value="disciplinas_matadas_grade_nova" filter removableSort stripedRows
                                paginator :rows="10" :rowsPerPageOptions="[25, 50, 100]"
                                tableStyle="max-width: 50rem; border-radius:6%">
                                <template #header>
                                    <span class="text-xl font-bold">Disciplinas Equivalentes Cortadas ({{
                                        grade_nova?.titulo ?? '' }})</span>
                                </template>
                                <Column field="codigo" header="Código"></Column>
                                <Column field="titulo" header="Titulo"></Column>
                                <Column field="carga_horaria" header="Carga Horária"></Column>


                            </DataTable>
                        </div>
                    </div>
                </div>

                <div>
                    <DataTable :value="disciplinas_a_cursar_grade_nova" tableStyle=" border-radius:6%" filter
                        removableSort stripedRows paginator :rows="10" :rowsPerPageOptions="[25, 50, 100]">
                        <template #header>
                            <span class="text-xl font-bold">Disciplinas para cursar ({{ grade_nova?.titulo ?? ''
                                }})</span>
                        </template>
                        <Column field="codigo" header="Código"></Column>
                        <Column field="titulo" header="Titulo"></Column>
                        <Column field="carga_horaria" header="Carga Horária"></Column>
                    </DataTable>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
