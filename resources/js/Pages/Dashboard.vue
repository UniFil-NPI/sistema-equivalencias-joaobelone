<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import  DisciplinasSVG from "@/assets/svgs/DisciplinasSVG.vue";
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="flex justify-center">
            <div class="sm:max-w-2xl justify-center grid grid-cols-2 gap-10">
                <div class="py-12 col-span-2 sm:col-span-1">
                <a href="#">
                    <div
                        class="mb-4 hover:border-amber-600 border-2 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">UIUI EXEMPLO EXEMPLO <DisciplinasSVG/></div>
                    </div>
                </a>
            </div>
            <div class="py-12 col-span-2 sm:col-span-1">
                <a href="#">
                    <div
                        class="mb-4 hover:border-amber-600 border-2 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Disciplinas  </div>
                    </div>
                </a>
                <a href="#">
                    <div
                        class="mb-4 hover:border-amber-600 border-2 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Equivalências</div>
                    </div>
                </a>
                <a href="#">
                    <div
                        class="mb-4 hover:border-amber-600 border-2 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Grades</div>
                    </div>
                </a>
            </div>
        </div>
        </div>
    </AuthenticatedLayout>
</template>
