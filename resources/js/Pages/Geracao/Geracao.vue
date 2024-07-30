<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

import Button from 'primevue/button';
import Stepper from 'primevue/stepper';
import StepperPanel from 'primevue/stepperpanel';

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { toastMixin } from '@/utils/toast';

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
                    <StepperPanel header="Header I">
                        <template #content="{ nextCallback }">
                            <div class="flex flex-column h-12rem">
                                <div
                                    class="border-2 border-dashed surface-border border-round surface-ground flex-auto flex justify-center align-items-center font-medium">
                                    Content I</div>
                            </div>
                            <div class="flex pt-4 justify-end">
                                <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                            </div>
                        </template>
                    </StepperPanel>
                    <StepperPanel header="Header II">
                        <template #content="{ prevCallback, nextCallback }">
                            <div class="flex flex-column h-12rem">
                                <div
                                    class="border-2 border-dashed surface-border border-round surface-ground flex-auto flex justify-center align-items-center font-medium">
                                    Content II</div>
                            </div>
                            <div class="flex pt-4 justify-between">
                                <div>
                                    <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                        @click="prevCallback" />
                                </div>
                                <div>
                                    <Button label="Next" icon="pi pi-arrow-right" iconPos="right"
                                        @click="nextCallback" />
                                </div>
                            </div>
                        </template>
                    </StepperPanel>
                    <StepperPanel header="Header III">
                        <template #content="{ prevCallback }">
                            <div class="flex flex-column h-12rem">
                                <div
                                    class="border-2 border-dashed surface-border border-round surface-ground flex-auto flex justify-center align-items-center font-medium">
                                    Content III</div>
                            </div>
                            <div class="flex pt-4 justify-start">
                                <Button label="Back" severity="secondary" icon="pi pi-arrow-left"
                                    @click="prevCallback" />
                            </div>
                        </template>
                    </StepperPanel>
                </Stepper>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
