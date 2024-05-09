<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ref } from "vue";
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import { toastMixin } from '@/utils/toast';


const page = usePage();

const confirmDelete = async (id) => {
    const result = await Swal.fire({
        title: "Tem certeza que deseja excluir essa grade?",
        text: "Ao excluir essa grade, todas as informações relacionadas a ela também serão excluidas!",
        showCancelButton: true,
        confirmButtonText: "Sim",
        cancelButtonText: 'Não',
    });

    if (result.isConfirmed) {
        try {
            const response = await axios.delete(route('grades.destroy', id));
            toastMixin.fire({
                title: response.data.success || response.data.error,
            }).then(() => { location.reload(); });
        } catch (error) {
            Swal.fire("Erro ao excluir grade", "", "error");
        }
    }
}
</script>

<template>

    <Head title="Grades" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Grades</h2>
                <a :href="route('grades.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">+ Criar
                    Grade</a>
            </div>
        </template>

        <div class="py-12">
            <div
                class="max-w-4xl mx-auto sm:px-6 px-8 justify-center grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-12">
                <div v-for="grade in $page.props.grades" :key="grade.id"
                    class="h-32 w-32 col-span-1 flex justify-center items-center bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                    <a :href="route('grades.edit', grade.id)" aria-haspopup="true" aria-controls="overlay_menu"
                        class="btn absolute mr-24 mb-20 text-xs"><i class="edit-icon pi pi-pencil"></i></a>
                    <button @click="confirmDelete(grade.id)" aria-haspopup="true" aria-controls="overlay_menu"
                        class="btn absolute ml-24 mb-20 text-xs"><i class="delete-icon pi pi-trash"></i></button>
                    <h3 class=" text-black dark:text-white text-xl">{{ grade.titulo }}</h3>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
