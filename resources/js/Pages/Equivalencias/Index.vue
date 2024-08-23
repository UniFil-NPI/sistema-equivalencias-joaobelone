<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { toastMixin } from '@/utils/toast';

const page = usePage();

const empty = page.props.equivalencias.length === 0;

const confirmDelete = async (id) => {
    const result = await Swal.fire({
        title: "Tem certeza que deseja excluir essa equivalencia?",
        text: "Ao excluir essa equivalencia, todas as informações relacionadas a ela também serão excluidas!",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: 'Não',
        confirmButtonColor: "#e98e06",
    });

    if (result.isConfirmed) {
        try {
            const response = await axios.delete(route('equivalencias.destroy', id));
            toastMixin.fire({
                title: response.data.success || response.data.error,
            }).then(() => {
                router.visit(route('equivalencias.index'), {
                    only: ['equivalencias'],
                })
            });
        } catch (error) {
            Swal.fire("Erro ao excluir equivalencia", "", "error");
        }
    }
}
</script>
<template>

    <Head title="Disciplinas" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Equivalências</h2>
                <Link :href="route('equivalencias.create')"
                    class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full">+ Criar
                Equivalência</Link>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div v-if="empty">
                        <div class="flex justify-center flex-col gap-2 items-center h-60">
                            <h2 class="text-3xl text-gray-400">Nenhuma equivalência encontrada</h2>
                        </div>
                    </div>
                    <div v-if="!empty">
                        <DataTable removableSort stripedRows paginator :rows="25" :rowsPerPageOptions="[25, 50, 100]"
                            :value="$page.props.equivalencias" tableStyle="min-width: 20rem">
                            <Column field="titulo" header="Titulo" sortable></Column>
                            <Column field="disciplinas" header="Disciplinas" sortable>
                                <template #body="slotProps">
                                    <div class="flex gap-1 overflow-x-scroll max-w-4xl">
                                        <div v-tooltip.top="disciplina.titulo"
                                            class="text-xs hover:cursor-default border border-green-600 p-1 rounded-lg"
                                            v-for="disciplina in slotProps.data.disciplinas" :key="disciplina.id">
                                            {{ disciplina.codigo }}
                                        </div>
                                    </div>
                                </template>
                            </Column>
                            <Column field="id" header="Açoes">
                                <template #body="slotProps">
                                    <div class="flex gap-4">
                                        <Link :href="route('equivalencias.edit', slotProps.data.id)"><i
                                            class=" hover:text-amber-500 pi pi-pen-to-square"></i></Link>
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
