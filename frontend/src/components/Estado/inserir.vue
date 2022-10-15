<template>
    <div style="margin-top: 100px;">
        <!-- <div v-for="(erro, index) in errors" :key="index" style="border: 1px solid red; margin-bottom: 10px;">
            {{ erro }}
        </div> -->
        <div v-if="this.confirm.success != null">
            <div v-if="this.confirm.success == true">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ this.confirm.message }}</strong>
                    <b-button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </b-button>
                </div>
            </div>
            <div v-if="this.confirm.success == false">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ this.confirm.message }}</strong>
                    <b-button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </b-button>
                </div>
            </div>
        </div>
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
            confirm: {
                success: null,
                message: null,
            },
        }
    },

    methods: {
        enviaFormulario() {
            axios.post('http://localhost:8000/api/estado/inserir', this.form)
                .then(response => {
                    if (response.status == 200) {
                        this.confirm.success = response.data.success
                        this.confirm.message = response.data.message
                        this.form = {
                            nome: null,
                            abreviacao: null,
                        }
                    }
                })
                .catch(error => {
                    this.confirm.success = false
                    this.confirm.message = Object.values(error.response.data.errors)[0][0]
                });
        }
    },

    props: {
        errors: Object
    },

};
</script>