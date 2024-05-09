<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import EquivalenciasForm from '@/Components/Equivalencias/EquivalenciasForm.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>

    <Head title="Equivalencia" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Editar Equivalencia</h2>
        </template>

        <EquivalenciasForm :edit="true" :equivalencia="$page.props.equivalencia" :disciplinas="$page.props.disciplinas"
            :csrf_token="page.props.csrf_token" />

    </AuthenticatedLayout>
</template>
