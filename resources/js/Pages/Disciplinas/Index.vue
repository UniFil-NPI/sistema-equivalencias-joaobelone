<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { toastMixin } from '@/utils/toast';

const page = usePage();

const empty = page.props.disciplinas.length === 0;

const confirmDelete = async (id) => {
    const result = await Swal.fire({
        title: "Tem certeza que deseja excluir essa disciplina?",
        text: "Ao excluir essa disciplina, todas as informações relacionadas a ela também serão excluidas!",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: 'Não',
    });

    if (result.isConfirmed) {
        try {
            const response = await axios.delete(route('disciplinas.destroy', id));
            toastMixin.fire({
                title: response.data.success || response.data.error,
            }).then(() => { location.reload(); });
        } catch (error) {
            Swal.fire("Erro ao excluir disciplina", "", "error");
        }
    } else if (result.isDenied) {
        Swal.fire("Changes are not saved", "", "info");
    }
}
</script>
<template>

    <Head title="Disciplinas" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Disciplinas</h2>
                <a :href="route('disciplinas.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">+ Criar
                    Disciplina</a>
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
                        <DataTable stripedRows paginator :rows="25" :rowsPerPageOptions="[25, 50, 100]"
                            :value="$page.props.disciplinas" tableStyle="min-width: 20rem">
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
                                        <a :href="route('disciplinas.edit', slotProps.data.id)"><i
                                                class="edit-icon pi pi-pencil"></i></a>
                                        <button @click="confirmDelete(slotProps.data.id)"><i
                                                class="delete-icon pi pi-trash"></i></button>
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
