<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import DisciplinasSVG from "@/assets/svgs/DisciplinasSVG.vue";
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="flex justify-center">
            <div class="sm:max-w-2xl justify-center grid grid-cols-2 gap-4">
                <div class="py-12 col-span-2 sm:col-span-1">
                    <Link :href="route('geracao.page')">
                        <div
                            class=" hover:scale-105 mb-4 hover:border-primary border-4 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Geração de
                                Equivalências
                                <DisciplinasSVG />
                            </div>
                        </div>
                    </Link>
                </div>
                <div class="py-12 col-span-2 sm:col-span-1">
                    <Link :href="route('geracao.historico')">
                        <div
                            class="hover:scale-105 mb-4 hover:border-primary border-4 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100"> Histórico </div>
                        </div>
                    </Link>
                    <Link :href="route('disciplinas.index')">
                        <div
                            class="hover:scale-105 mb-4 hover:border-primary border-4 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Disciplinas </div>
                        </div>
                    </Link>
                    <Link :href="route('equivalencias.index')">
                        <div
                            class="hover:scale-105 mb-4 hover:border-primary border-4 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Equivalências</div>
                        </div>
                    </Link>
                    <Link :href="route('grades.index')">
                        <div
                            class="hover:scale-105 hover:border-primary border-4 border-transparent transition ease-in-out bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class=" p-6 text-gray-900 text-xl font-bold dark:text-gray-100">Grades</div>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
