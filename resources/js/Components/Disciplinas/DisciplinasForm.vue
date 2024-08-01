<script>
import axios from 'axios'
import { router } from '@inertiajs/vue3'
import { toastMixin } from '@/utils/toast'
import MultiSelect from 'primevue/multiselect';

export default {
    props: ['csrf_token', 'grades', 'disciplina', 'edit'],
    components: {
        MultiSelect
    },
    data() {
        return {
            value_grades: this.disciplina ? this.disciplina.grades : null,
            disciplina: this.disciplina,
            edit: this.edit,
            titulo: this.disciplina ? this.disciplina.titulo : '',
            codigo: this.disciplina ? this.disciplina.codigo : '',
            carga_horaria: this.disciplina ? this.disciplina.carga_horaria : 0,
            periodo: this.disciplina ? this.disciplina.periodo : 0,
            tipo: this.disciplina ? this.disciplina.tipo : '',
            modalidade: this.disciplina ? this.disciplina.modalidade : 'PRESENCIAL',
        }
    },

    methods: {
        submitForm() {
            let formData = new FormData(document.getElementById('disciplinas_form'))
            let grades = []

            this.value_grades?.forEach((element, index) => {
                grades += element.id + ','
            });

            formData.append('grades', grades)

            this.edit ? this.update(this.disciplina.id, formData) : this.store(formData);
        },
        toast(response) {
            if (response.data.success) {
                toastMixin.fire({
                    title: response.data.success,
                })
                router.get(route('disciplinas.index'))
                return;
            }
            toastMixin.fire({
                title: response.data.error,
                icon: 'error'
            });
        },
        store(formData) {
            axios.post(route('disciplinas.store'), formData)
                .then(response => {
                    this.toast(response)
                })
                .catch(error => {
                    console.error(error);
                });
        },
        update(id, formData) {
            axios.put(route('disciplinas.update', id), formData, { headers: { 'Content-Type': 'application/json' } })
                .then(response => {
                    this.toast(response)
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
}
</script>
<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg py-4 px-6">
                <form @submit.prevent="submitForm" id="disciplinas_form">
                    <input type="hidden" name="_token" :value="$page.props.csrf_token">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="sm:col-span-2 col-span-6">
                            <label for="titulo"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Titulo:</label>
                            <input v-model="titulo" type="text" name="titulo" id="titulo" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600"
                                placeholder="Insira o titulo">
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="codigo"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Codigo:</label>
                            <input v-model="codigo" type="text" name="codigo" id="codigo" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600"
                                placeholder="Insira o código">
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <label for="carga_horaria"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Carga
                                horaria:</label>
                            <input v-model="carga_horaria" type="number" min="0" name="carga_horaria" id="carga_horaria"
                                required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600"
                                placeholder="Insira a carga horária">
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <label for="periodo"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Periodo:</label>
                            <input v-model="periodo" type="number" min="0" name="periodo" id="periodo"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600"
                                placeholder="Insira o período">
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <label for="tipo"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Tipo:</label>
                            <select name="tipo" id="tipo"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600">
                                <option value="">Não se aplica</option>
                                <option value="Core" :selected="disciplina && disciplina.tipo === 'Core'">Core</option>
                                <option value="Flex" :selected="disciplina && disciplina.tipo === 'Flex'">Flex</option>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-1">
                            <label for="modalidade"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Modalidade:</label>
                            <select name="modalidade" id="modalidade"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600">
                                <option :selected="disciplina && disciplina.modalidade === 'PRESENCIAL'"
                                    value="PRESENCIAL">Presencial</option>
                                <option :selected="disciplina && disciplina.modalidade === 'EAD'" value="EAD">Ead
                                </option>
                            </select>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="Grades"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Grades:</label>

                            <MultiSelect v-model="value_grades" :options="$page.props.grades" filter optionLabel="titulo" display="chip"
                                placeholder="Adicionar a grades"  class="w-full" dataKey="id" />
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="bg-primary hover:bg-amber-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
