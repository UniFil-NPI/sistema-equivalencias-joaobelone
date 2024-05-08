<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GradesForm from '@/Components/Grades/GradesForm.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>

    <Head title="Grades" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Editar Grade</h2>
        </template>

        <GradesForm :edit="true" :grade="$page.props.grade" :disciplinas="$page.props.disciplinas" :csrf_token="page.props.csrf_token" />
        
    </AuthenticatedLayout>
</template>
