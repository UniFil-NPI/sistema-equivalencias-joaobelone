<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
    <Head title="Disciplinas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Criar Disciplina</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg py-4 px-6">
                    <form action="/disciplinas" method="POST">
                        <input type="hidden" name="_token" :value="$page.props.csrf_token">

                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <label for="titulo" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Titulo:</label>
                                <input type="text" name="titulo" id="titulo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" placeholder="Insira o titulo">
                            </div>
                            <div class="">
                                <label for="codigo" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Codigo:</label>
                                <input type="text" name="codigo" id="codigo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" placeholder="Insira o código">
                            </div>
                            <div class="">
                                <label for="periodo" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Periodo:</label>
                                <input type="number" min="0" name="periodo" id="periodo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" placeholder="Insira o período">
                            </div>
                            <div class="">
                                <label for="carga_horaria" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Carga horaria:</label>
                                <input type="text" name="carga_horaria" id="carga_horaria" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600" placeholder="Insira a carga horária">
                            </div>
                            <div class="">
                                <label for="tipo" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Tipo:</label>
                                <select name="tipo" id="tipo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                                    <option value="core">Core</option>
                                    <option value="flex">Flex</option>
                                </select>
                            </div>
                            <div class="">
                                <label for="modalidade" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Modalidade:</label>
                                <select name="modalidade" id="modalidade" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                                    <option value="presencial">Presencial</option>
                                    <option value="ead">Ead</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline dark:bg-blue-600">Submit</button>
                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
    </AuthenticatedLayout>
</template>
