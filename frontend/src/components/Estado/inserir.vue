<template>
    <div>
        <b-form @submit.prevent="enviaFormulario">
            <b-form-group id="input-group-1" label="Nome:" label-for="input-1">
                <b-form-input id="input-1" v-model="form.nome" type="text" placeholder="Nome">
                </b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" class="mt-2" label="Abreviação:" label-for="input-2">
                <b-form-input id="input-2" v-model="form.abreviacao" placeholder="Abreviação"></b-form-input>
            </b-form-group>

            <b-button id="cadastrar-button" class="mt-2" type="submit" variant="primary">Cadastrar</b-button>
        </b-form>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    name: 'inserirEstado',
    data: () => {
        return {
            form: {
                nome: null,
                abreviacao: null,
            },
        }
    },

    methods: {
        enviaFormulario() {
            axios.post('http://localhost:8000/api/estado/inserir', this.form)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('confirm', {
                            success: response.data.success,
                            message: response.data.message
                        })

                        this.form = {
                            nome: null,
                            abreviacao: null,
                        }

                        this.$emit('estadoInserido', response.data.estado)

                        this.$emit('closeModal', true)
                    }
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.$emit('closeModal', true)
                        this.$emit('confirm', {
                            success: false,
                            message: "O Estado não foi inserido pois o campo " + Object.values(error.response.data.errors)[0][0]
                        })
                    }
                });
        },
    },

    props: {
        errors: Object
    },

};
</script>

<style>
#cadastrar-button {
    float: right;
}
</style>