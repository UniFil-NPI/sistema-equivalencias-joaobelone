<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import InputText from 'primevue/inputtext';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import { onMounted, ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { toastMixin } from '@/utils/toast';
import { FilterMatchMode } from '@primevue/core/api';
import ToggleSwitch from 'primevue/toggleswitch';

const page = usePage();

const empty = page.props.disciplinas.length === 0;

const changeDisciplinaStatus = async (id) => {
    try {
        const response = await axios.post(route('disciplinas.change-status', id));
        toastMixin.fire({
            title: response.data.success || response.data.error,
        });
    } catch (error) {
        Swal.fire("Erro ao alterar status da disciplina", "", "error");
    }
}

const confirmDelete = async (id) => {
    const result = await Swal.fire({
        title: "Tem certeza que deseja excluir essa disciplina?",
        text: "Ao excluir essa disciplina, todas as informações relacionadas a ela também serão excluidas!",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: 'Não',
        confirmButtonColor: "#e98e06",
    });

    if (result.isConfirmed) {
        try {
            const response = await axios.delete(route('disciplinas.destroy', id));
            toastMixin.fire({
                title: response.data.success || response.data.error,
            }).then(() => {
                router.visit(route('disciplinas.index'), {
                    only: ['disciplinas'],
                })
            });
        } catch (error) {
            Swal.fire("Erro ao excluir disciplina", "", "error");
        }
    } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
    }
}

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS }
});
</script>
<template>

    <Head title="Disciplinas" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Disciplinas</h2>
                <Link :href="route('disciplinas.create')"
                    class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full">+ Criar
                Disciplina</Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="empty">
                        <div class="flex justify-center flex-col gap-2 items-center h-60">
                            <h2 class="text-3xl text-gray-400">Nenhuma disciplina encontrada</h2>
                        </div>
                    </div>
                    <div v-if="!empty">
                        <DataTable v-model:filters="filters" filter removableSort stripedRows paginator :rows="25"
                            :rowsPerPageOptions="[25, 50, 100]" :value="$page.props.disciplinas"
                            tableStyle="min-width: 20rem"
                            :globalFilterFields="['codigo', 'titulo', 'tipo', 'modalidade', 'carga_horaria']">
                            <template #empty>Nenhuma disciplina encontrada.</template>
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
                            <Column field="codigo" header="Codigo" sortable></Column>
                            <Column field="titulo" header="Titulo" sortable></Column>
                            <Column field="carga_horaria" header="Carga Horaria" sortable></Column>
                            <Column field="tipo" header="Tipo" sortable></Column>
                            <Column field="modalidade" header="Modalidade" sortable></Column>
                            <Column field="grades" header="Grades" sortable>
                                <template #body="slotProps">
                                    <span>{{ slotProps.data.grades.map(grade => grade.titulo).join(', ') }}</span>
                                </template>
                            </Column>
                            <Column field="id" header="Açoes">
                                <template #body="slotProps">
                                    <div class="flex gap-4">
                                        <ToggleSwitch :modelValue="(slotProps.data.ativo == 1 ? true : false)"
                                            @update:modelValue="value => slotProps.data.ativo = value"
                                            @change="changeDisciplinaStatus(slotProps.data.id)" />
                                        <Link :href="route('disciplinas.edit', slotProps.data.id)"><i
                                            class="hover:text-amber-500 pi pi-pen-to-square"></i></Link>
                                        <button @click="confirmDelete(slotProps.data.id)"><i
                                                class="hover:text-red-600 pi pi-trash"></i></button>
                                    </div>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
