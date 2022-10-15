<template>
    <div style="margin-top: 100px;">
        <!-- <div v-for="(erro, index) in errors" :key="index" style="border: 1px solid red; margin-bottom: 10px;">
            {{ erro }}
        </div> -->
        <form @submit.prevent="enviaFormulario">
            <input type="text" placeholder="Nome" v-model="form.nome" />
            <input type="text" placeholder="Abreviação" v-model="form.abreviacao" />
            <button type="submit">Cadastrar</button>
        </form>
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

                        this.$parent.getEstados();
                    }
                })
                .catch(error => {
                    if(error.response.status == 422) {
                        this.$emit('confirm', {
                            success: false,
                            message: Object.values(error.response.data.errors)[0][0]
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