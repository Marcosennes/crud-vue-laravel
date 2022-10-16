<template>
    <div>
        <b-form @submit.prevent="enviaFormulario">
            <b-form-group id="input-group-1" label="Nome:" label-for="input-1">
                <b-form-input id="input-1" type="text" placeholder="Nome" v-model="form.nome" :value="form.nome">
                </b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" class="mt-2" label="Abreviação:" label-for="input-2">
                <b-form-input id="input-2" placeholder="Abreviação" v-model="form.abreviacao" :value="form.abreviacao"></b-form-input>
            </b-form-group>

            <b-button id="alterar-button" class="mt-2" type="submit" variant="primary">Alterar</b-button>
        </b-form>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    name: 'alterarEstado',
    data() {
        return {
            form: {
                id: this.id_estado,
                nome: null,
                abreviacao: null,
            },
        }
    },
    mounted() {
        this.getEstado();
    },
    methods: {
        enviaFormulario() {
            axios.post('http://localhost:8000/api/estado/alterar', this.form)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('confirm', {
                            success: response.data.success,
                            message: response.data.message
                        })

                        this.$emit('estadoAlterado', response.data.estado)

                        this.$emit('closeModalEdit', true)
                    }
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.$emit('closeModalEdit', true)
                        this.$emit('confirm', {
                            success: false,
                            message: "O Estado não foi alterado pois o campo " + Object.values(error.response.data.errors)[0][0]
                        })
                    }
                });
        },
        async getEstado() {
            const response = await axios.get("http://localhost:8000/api/estado/detalhar/" + this.form.id);
            if (response.status == 200) {
                this.form.nome = response.data.estado.nome;
                this.form.abreviacao = response.data.estado.abreviacao;
            }
            else {
                alert("Erro ao buscar dados");
            }
        },
    },

    props: ['id_estado'],

};
</script>

<style>
#alterar-button {
    float: right;
}
</style>