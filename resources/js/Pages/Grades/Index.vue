<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>

    <Head title="Grades" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Grades</h2>
                <a :href="route('grades.create')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">+ Criar
                    Grades</a>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 justify-center grid grid-cols-2 sm:grid-cols-4">
                <div v-for="grade in $page.props.grades" :key="grade.id" class="h-44 w-44 col-span-1 flex justify-center items-center bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <h3 class="text-2xl">{{ grade.titulo }}</h3>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
