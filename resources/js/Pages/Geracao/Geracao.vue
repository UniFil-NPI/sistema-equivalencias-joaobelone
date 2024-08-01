<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Select from 'primevue/select';
import Stepper from 'primevue/stepper';
import StepList from 'primevue/steplist';
import StepPanels from 'primevue/steppanels';
import Step from 'primevue/step';
import StepPanel from 'primevue/steppanel';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'
import axios from 'axios';
import { toastMixin } from '@/utils/toast';
import { ref, onMounted } from 'vue';

const grades = ref([{ label: 'Grade 1', value: 'Grade 1' }, { label: 'Grade 2', value: 'Grade 2' }, { label: 'Grade 3', value: 'Grade 3' }]
);

const grade_antiga = ref(null)
const grade_nova = ref(null)

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
                <Stepper value="1" linear class=" basis-[70rem]">
                    <StepList>
                        <Step value="1">Etapa I</Step>
                        <Step value="2">Etapa II</Step>
                        <Step value="3">Etapa III</Step>
                    </StepList>
                    <StepPanels>
                        <StepPanel class="rounded-lg p-6" v-slot="{ activateCallback }" value="1">
                            <div class="flex flex-col min-h-60">
                                <h1 class="font-semibold text-3xl">Selecione a grade antiga e a grade nova</h1>
                                <div class="flex mt-14 justify-center gap-10">

                                    <div class="flex flex-col w-fit">
                                        <label class="mb-2" for="grade_antiga">Grade Antiga</label>
                                        <Select v-model="grade_antiga" :options="grades" optionLabel="label"
                                            name="grade_antiga" placeholder="Selecione uma grade"
                                            class="w-full md:w-56" />
                                    </div>

                                    <div class=" hidden lg:flex justify-center items-end">
                                        <i style="font-size: 50px;" class=" text-primary pi pi-arrow-right" />
                                    </div>

                                    <div class="flex flex-col w-fit">
                                        <label class="mb-2" for="grade_nova">Grade Nova</label>
                                        <Select v-model="grade_nova" :options="grades" optionLabel="label"
                                            name="grade_nova" placeholder="Selecione uma grade"
                                            class="w-full md:w-56" />
                                    </div>

                                </div>
                            </div>
                            <div class="flex pt-6 justify-end">
                                <Button label="Próximo" icon="pi pi-arrow-right" @click="activateCallback('2')"
                                    iconPos="right" />
                            </div>
                        </StepPanel>
                        <StepPanel class="rounded-lg p-6" v-slot="{ activateCallback }" value="2">
                            <div class="flex flex-col h-48">
                                <div
                                    class=" rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">
                                    <h1 class="font-semibold text-3xl">asdasdasd</h1>
                                </div>
                            </div>
                            <div class="flex pt-6 justify-between">
                                <Button label="Voltar" severity="secondary" icon="pi pi-arrow-left"
                                    @click="activateCallback('1')" />
                                <Button label="Próximo" icon="pi pi-arrow-right" @click="activateCallback('3')"
                                    iconPos="right" />
                            </div>
                        </StepPanel>
                        <StepPanel class="rounded-lg p-6" v-slot="{ activateCallback }" value="3">
                            <div class="flex flex-col h-48">
                                <div
                                    class=" rounded bg-surface-50 dark:bg-surface-950 flex-auto flex justify-center items-center font-medium">
                                    Content III</div>
                            </div>
                            <div class="pt-6">
                                <Button label="Voltar" severity="secondary" icon="pi pi-arrow-left"
                                    @click="activateCallback('2')" />
                            </div>
                        </StepPanel>
                    </StepPanels>
                </Stepper>
            </div>
        </div>
    </AuthenticatedLayout>
</template>