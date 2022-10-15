<template>
    <div>
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
        <div v-if="detalhar_estado.id">
            <Detalhar :id="detalhar_estado.id" :nome="detalhar_estado.nome" :abreviacao="detalhar_estado.abreviacao" :created_at="detalhar_estado.created_at" :updated_at="detalhar_estado.updated_at"/>
        </div>
        <div>
            <!-- <b-button @click="toggleBusy">Toggle Busy State</b-button> -->
            <!-- <b-button class="btn btn-primary" @click="novoEstado">Novo Estado</b-button> -->
            <b-table id="estados_table" responsive :items="estados" :busy="isBusy" :fields="fields" class="mt-3" outlined>
                <template #cell(acoes)="data">
                    <b-button size="sm" variant="info" @click="detalhar(data.item.id)">Visualizar</b-button>
                    <!-- <b-button size="sm" variant="warning" @click="alterar()">Alterar</b-button> -->
                    <b-button size="sm" variant="danger" @click="excluir(estados.indexOf(data.item), data.item.id)">Excluir
                    </b-button>
                </template>
                <template #table-busy>
                    <div class="text-center text-danger my-2">
                        <b-spinner class="align-middle"></b-spinner>
                        <strong>Loading...</strong>
                    </div>
                </template>
            </b-table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Detalhar from './visualizar.vue';

export default {
    name: "listarEstado",
    components: { Detalhar },
    data() {
        return {
            isBusy: false,
            estados: [],
            fields: [
                { key: "nome", label: "Nome", sortable: true, formatter: this.nomeFormatter },
                { key: "abreviacao", label: "Abreviação", sortable: true },
                { key: "created_at", label: "Criado em", sortable: true },
                { key: "updated_at", label: "Atualizado em", sortable: true },
                { key: "acoes", label: "Ações" },
            ],
            acoes: ["Editar", "Excluir"],
            confirm: {
                success: null,
                message: null,
            },
            detalhar_estado: {
                id: null,
                nome: null,
                abreviacao: null,
                created_at: null,
                updated_at: null,
            },
        };
    },
    mounted() {
        this.getEstados();
    },
    methods: {
        toggleBusy() {
            this.isBusy = !this.isBusy;
        },
        async getEstados() {
            const response = await axios.get("http://localhost:8000/api/estado/listar");
            if (response.status == 200) {
                this.estados = response.data.estados;
            }
            else {
                console.log("Erro ao buscar dados");
            }
        },
        excluir(index, id) {
            if (confirm("Deseja realmente excluir este registro?")) {
                axios.delete("http://localhost:8000/api/estado/excluir/" + id)
                    .then(response => {
                        if (response.status == 200) {
                            this.confirm.success = response.data.success;
                            this.confirm.message = response.data.message;
                            this.estados.splice(index, 1);
                        }
                    });
            }
        },
        detalhar(id){
            axios.get("http://localhost:8000/api/estado/detalhar/" + id)
                .then(response => {
                    if (response.status == 200) {
                        this.detalhar_estado.id          = response.data.estado.id;
                        this.detalhar_estado.nome        = response.data.estado.nome;
                        this.detalhar_estado.abreviacao  = response.data.estado.abreviacao;
                        this.detalhar_estado.created_at  = response.data.estado.created_at;
                        this.detalhar_estado.updated_at  = response.data.estado.updated_at;
                    }
                });
        }
    }
};
</script>

<style>
    #estados_table {
        width: 100%;
    }
</style>