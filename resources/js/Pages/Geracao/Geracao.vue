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
import InputText from 'primevue/inputtext';
import axios, { all } from 'axios';
import { toastMixin } from '@/utils/toast';
import { ref, onMounted } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional


const page = usePage();

const grades = page.props.grades;

const grade_antiga = ref(null)
const grade_nova = ref(null)
const fileupload = ref();
const disciplinas_da_grade_escolhida = ref(null);

const disciplina_insert = ref(null);
const ch_insert = ref(null);

const disciplinas_selecionadas_list = ref([]);

const insert_disciplinas = (id, codigo, titulo, carga_horaria) => {

    disciplinas_selecionadas_list.value.push({ id, codigo, titulo, carga_horaria });

}

const setDisciplinasGradeAntiga = (grade_antiga) => {
    const allDisciplinas = page.props.disciplinas;

    disciplinas_da_grade_escolhida.value = allDisciplinas.filter(disciplina =>
        disciplina.grades.some(grade => grade.id === grade_antiga)
    );
};

const handleGradeAntigaChange = (grade_antiga) => {
    setDisciplinasGradeAntiga(grade_antiga)

    disciplinas_selecionadas_list.value = []
}

const deleteDisciplinaFromList = (id) => {
    console.log(id);

    disciplinas_selecionadas_list.value = disciplinas_selecionadas_list.value.filter(disciplina => disciplina.id !== id);
}



const upload = () => {
    fileupload.value.upload();
};

const onUpload = () => {

};

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
                                        <Select v-model="grade_antiga" :options="grades" optionLabel="titulo"
                                            name="grade_antiga" placeholder="Selecione uma grade" class="w-full md:w-56"
                                            @change="handleGradeAntigaChange(grade_antiga.id)" />
                                    </div>

                                    <div class=" hidden lg:flex justify-center items-end">
                                        <i style="font-size: 50px;" class=" text-primary pi pi-arrow-right" />
                                    </div>

                                    <div class="flex flex-col w-fit">
                                        <label class="mb-2" for="grade_nova">Grade Nova</label>
                                        <Select v-model="grade_nova" :options="grades" optionLabel="titulo"
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
                        <!-- <StepPanel class="rounded-lg p-6" v-slot="{ activateCallback }" value="2">
                            <div class="flex flex-col max-h-60">
                                <h1 class="font-semibold text-3xl">Faça upload do arquivo de histórico</h1>
                                <div class="flex mt-14 items-center justify-center flex-col ">
                                    <i style="font-size: 90px;" class="text-primary pi pi-file mb-8"></i>
                                    <FileUpload ref="fileupload" mode="basic" name="demo[]" url="/api/upload"
                                        accept="image/*" :maxFileSize="1000000" @upload="onUpload" />
                                </div>
                            </div>

                            <div class="flex pt-6 justify-between">
                                <Button label="Voltar" severity="secondary" icon="pi pi-arrow-left"
                                    @click="activateCallback('1')" />
                                <Button label="Próximo" icon="pi pi-arrow-right" @click="activateCallback('3')"
                                    iconPos="right" />
                            </div>
                        </StepPanel> -->
                        <StepPanel class="rounded-lg p-6" v-slot="{ activateCallback }" value="2">
                            <div class="flex flex-col min-h-60">
                                <h1 class="font-semibold text-3xl">Adicione as disciplinas cursadas</h1>
                                <div class="flex mt-14 justify-center gap-10">

                                    <div class="flex flex-col w-fit">
                                        <label class="mb-2" for="disciplina_insert">Disciplina </label>
                                        <Select filter v-model="disciplina_insert"
                                            :options="disciplinas_da_grade_escolhida" optionLabel="titulo"
                                            name="disciplina_insert" placeholder="Selecione uma disciplina "
                                            class="w-full md:w-56" />
                                    </div>
                                    <div class="flex flex-col w-fit">
                                        <label class="mb-2" for="ch_insert">Carga horária</label>
                                        <InputText placeholder="Insira a carga horária" type="number" min="0"
                                            name="ch_insert" id="ch_insert" v-model="ch_insert" />
                                    </div>
                                    <div class="flex items-end w-fit">
                                        <Button label="" severity="primary" icon="pi pi-plus"
                                            @click="insert_disciplinas(disciplina_insert.id, disciplina_insert.codigo, disciplina_insert.titulo, ch_insert)" />
                                    </div>
                                </div>
                                <div class="flex mt-14 justify-center gap-10 mb-8">
                                    <DataTable :value="disciplinas_selecionadas_list" tableStyle="max-width: 50rem">
                                        <Column field="codigo" header="Código"></Column>
                                        <Column field="titulo" header="Titulo"></Column>
                                        <Column field="carga_horaria" header="Carga Horária"></Column>
                                        <Column field="actions" header="Ações">
                                            <template #body="slotProps">
                                                <div class="flex gap-4 justify-center">
                                                    <button @click="deleteDisciplinaFromList(slotProps.data.id)">
                                                        <i class="hover:text-red-600 pi pi-trash"></i>
                                                    </button>
                                                </div>
                                            </template>
                                        </Column>

                                    </DataTable>
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
                            <div class="flex flex-col max-h-60">
                                <h1 class="font-semibold text-3xl">Confirme as informações</h1>
                                <div class="flex items-center justify-center h-60 gap-4 ">
                                    <i style="font-size: 90px;" class="text-primary pi pi-check"></i>
                                </div>
                            </div>
                            <div class="pt-6 flex justify-between">
                                <Button label="Voltar" severity="secondary" icon="pi pi-arrow-left"
                                    @click="activateCallback('2')" />
                                <Button class="" iconPos="right" icon="pi pi-cog" label="Gerar Equivalências"
                                    @click="upload" />
                            </div>
                        </StepPanel>
                    </StepPanels>
                </Stepper>
            </div>
        </div>
    </AuthenticatedLayout>
</template>