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
        <b-modal hide-footer ref="inserir">
            <Inserir @confirm="updateConfirm" @estadoInserido="updateEstados" @closeModal="closeModalInsert"></Inserir>
        </b-modal>
        <div v-if="id_detalhar_estado">
            <Detalhar :id="id_detalhar_estado" />
        </div>
        <div>
            <!-- <b-button @click="toggleBusy">Toggle Busy State</b-button> -->
            <b-button class="btn btn-primary" @click="inserir()">Novo Estado</b-button>
            <!-- <router-link to="/estado/inserir" class="button btn btn-primary">Inserir Estado</router-link> -->
            <b-table id="estados_table" responsive :items="estados" :busy="isBusy" :fields="fields" class="mt-3"
                outlined>
                <template #cell(acoes)="data">
                    <b-button size="sm" variant="info" @click="detalhar(data.item.id)">Visualizar</b-button>
                    <!-- <b-button size="sm" variant="warning" @click="alterar()">Alterar</b-button> -->
                    <b-button size="sm" variant="danger" @click="excluir(estados.indexOf(data.item), data.item.id)">
                        Excluir
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
import Inserir from './inserir.vue';

export default {
    name: "listarEstado",
    components: { Detalhar, Inserir },
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
            id_detalhar_estado: null,
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
        inserir() {
            this.$refs.inserir.show();
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
        detalhar(id) {
            this.id_detalhar_estado = id;
        },
        updateConfirm(confirm) {
            this.confirm = confirm;
        },
        updateEstados(estado) {
            this.estados.push(estado);
        },
        closeModalInsert() {
            this.$refs.inserir.hide();
        },
    }
};
</script>

<style>
#estados_table {
    width: 100%;
}
</style>