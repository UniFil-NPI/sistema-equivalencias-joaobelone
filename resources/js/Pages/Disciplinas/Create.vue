<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DisciplinasForm from '@/Components/Disciplinas/DisciplinasForm.vue';
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

        <DisciplinasForm :grades="$page.props.grades" :csrf_token="page.props.csrf_token" />
        
    </AuthenticatedLayout>
</template>
