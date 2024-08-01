<script>
import axios from 'axios'
import { router } from '@inertiajs/vue3'
import { toastMixin } from '@/utils/toast'
import MultiSelect from 'primevue/multiselect';

export default {
    props: ['csrf_token', 'equivalencia', 'disciplinas', 'edit'],
    components: {
        MultiSelect
    },
    data() {
        return {
            value_disciplinas: this.equivalencia ? this.equivalencia.disciplinas : null,
            equivalencia: this.equivalencia,
            titulo: this.equivalencia ? this.equivalencia.titulo : '',
            edit: this.edit
        }
    },
    methods: {
        codigoWithTitulo({ codigo, titulo }) {
            return `${codigo} — ${titulo}`
        },
        submitForm() {
            let formData = new FormData(document.getElementById('equivalencias_form'))
            let disciplinas = []

            this.value_disciplinas?.forEach((element, index) => {
                disciplinas += element.id + ','
            });

            formData.append('disciplinas', disciplinas)

            this.edit ? this.update(this.equivalencia.id, formData) : this.store(formData);
        },
        toast(response) {
            if (response.data.success) {
                toastMixin.fire({
                    title: response.data.success,
                })
                router.get(route('equivalencias.index'))
                return;
            }
            toastMixin.fire({
                title: response.data.error,
                icon: 'error'
            });
        },
        store(formData) {
            axios.post(route('equivalencias.store'), formData)
                .then(response => {
                    this.toast(response)
                })
                .catch(error => {
                    console.error(error);
                });
        },
        update(id, formData) {
            axios.put(route('equivalencias.update', id), formData, { headers: { 'Content-Type': 'application/json' } })
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
                <form @submit.prevent="submitForm" id="equivalencias_form">
                    <input type="hidden" name="_token" :value="$page.props.csrf_token">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="col-span-1">
                            <label for="titulo"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Titulo:</label>
                            <input v-model="titulo" type="text" name="titulo" id="titulo" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline dark:bg-[#192332] dark:text-gray-300 dark:border-gray-600"
                                placeholder="Insira o titulo">
                        </div>
                        <div class="col-span-1">
                            <label for="Disciplinas"
                                class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Disciplinas:</label>

                            <MultiSelect v-model="value_disciplinas" :options="$page.props.disciplinas" filter
                                scrollHeight="25rem" dataKey="id" :virtualScrollerOptions="{ itemSize: 44 }"
                                optionLabel="titulo" display="chip" placeholder="Adicionar disciplinas" class="w-full">
                                <template #option="props">
                                    <div class="flex items-center">
                                        <span class="option__title">{{ props.option.codigo }}</span> &nbsp - &nbsp <span
                                            class="option__small">{{ props.option.titulo }}</span>
                                    </div>
                                </template>
                            </MultiSelect>
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
