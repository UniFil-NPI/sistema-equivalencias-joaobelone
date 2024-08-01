<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Stepper from 'primevue/stepper';
import StepperPanel from 'primevue/stepperpanel';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { toastMixin } from '@/utils/toast';
import { ref, onMounted } from 'vue';

const grades = ref([{ label: 'Grade 1', value: 'Grade 1' }, { label: 'Grade 2', value: 'Grade 2' }, { label: 'Grade 3', value: 'Grade 3' }]
);

const grade_antiga = ref(null)

const page = usePage();

</script>
<template>

    <Head title="Geração de Equivalências" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Geração de
                    Equivalências</h2>
            </div>
        </template>
        <div class="py-12">
            <div class="card flex justify-center ">

                <Stepper linear class="max-w-7xl w-full">
                    <StepperPanel header="Etapa I">
                        <template #content="{ nextCallback }">
                            <h1 class="font-semibold text-2xl">Selecione a grade antiga e a grade nova</h1>
                            <div class="p-12 flex justify-around flex-column h-12rem">

                                <select class="focus:border-primary border-2 text-black dark:text-white dark:bg-gray-900 rounded-md p-2">
                                    <option value="">Selecione a grade</option>
                                    <option value="">Selecione a grade</option>
                                    <option value="">Selecione a grade</option>
                                </select>
                                <div>asd</div>
                            </div>
                            <div class="flex pt-4 justify-end">
                                <Button class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full"  label="Próximo" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                            </div>
                        </template>
                    </StepperPanel>
                    <StepperPanel header="Etapa II">
                        <template #content="{ prevCallback, nextCallback }">
                            <h1 class="font-semibold text-2xl">Faça upload do histórico do aluno</h1>
                            <div class="flex flex-column h-12rem">
                                asd 2
                            </div>
                            <div class="flex pt-4 justify-between">
                                <div>
                                    <Button class="border-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full" label="Voltar" severity="secondary" icon="pi pi-arrow-left"
                                        @click="prevCallback" />
                                </div>
                                <div>
                                    <Button class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full" label="Próximo" icon="pi pi-arrow-right" iconPos="right"
                                        @click="nextCallback" />
                                </div>
                            </div>
                        </template>
                    </StepperPanel>
                    <StepperPanel header="Etapa III">
                        <template #content="{ prevCallback }">
                            <div class="flex flex-column h-12rem">
                                asd 3
                            </div>
                            <div class="flex pt-4 justify-start">
                                <Button class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded-full" label="Voltar" severity="secondary" icon="pi pi-arrow-left"
                                    @click="prevCallback" />
                            </div>
                        </template>
                    </StepperPanel>
                </Stepper>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
.p-stepper-panels{
    margin-top: 2%;
    border-radius: 6px;
}
</style>
