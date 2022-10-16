<template>
    <div>
        <div v-if="this.confirm.success != null">
            <div v-if="this.confirm.success == true">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ this.confirm.message }}</strong>
                </div>
            </div>
            <div v-if="this.confirm.success == false">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ this.confirm.message }}</strong>
                </div>
            </div>
        </div>
        <b-modal hide-footer ref="inserir" title="Inserir Cidade">
            <Inserir @confirm="updateConfirm" @cidadeInserida="updateCidades" @closeModal="closeModalInsert"></Inserir>
        </b-modal>
        <b-modal hide-footer ref="alterar" title="Alterar Cidade">
            <div v-if="id_cidade_a_ser_alterada">
                <Alterar @confirm="updateConfirm" @cidadeAlterada="updateCidadeAlterada"
                    @closeModalEdit="closeModalEdit" :id_cidade="id_cidade_a_ser_alterada"></Alterar>
            </div>
        </b-modal>
        <b-modal hide-footer ref="detalhar" title="Detalhes Cidade">
            <div v-if="id_detalhar_cidade">
                <Detalhar :id_cidade="id_detalhar_cidade" />
            </div>
        </b-modal>
        <div id="filter-insert" class="row mt-3">
            <div class="col-2">
                <p>Filtro: </p>
            </div>
            <div class="col-8">
                    <b-form-input id="input-1" v-model="filteredCidade" type="text" placeholder="Nome da Cidade"
                        required>
                    </b-form-input>
            </div>
            <div class="col-2">
                <b-button id="nova-cidade-button" class="btn btn-primary" @click="inserir()">
                    <b-icon icon="plus" scale="1"></b-icon> Nova Cidade
                </b-button>
            </div>
        </div>
        <b-table id="cidades_table" striped responsive :per-page="perPage" :current-page="currentPage" label-sort-asc="" label-sort-desc="" label-sort-clear=""
            :items="cidades" :busy="isBusy" :fields="fields" class="mt-1" outlined>
            <template #cell(created_at)="data">
                {{ new Date(data.item.created_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo'}) }}
            </template>
            <template #cell(updated_at)="data">
                {{ new Date(data.item.updated_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo'}) }}
            </template>
            <template #cell(acoes)="data">
                <b-button size="sm" variant="info" @click="detalhar(data.item.id)">
                    <b-icon icon="eye-fill" scale="1"></b-icon>
                </b-button>
                <b-button size="sm" variant="warning" @click="alterar(data.item.id)">
                    <b-icon icon="pencil-fill" scale="1"></b-icon>
                </b-button>
                <b-button size="sm" variant="danger" @click="excluir(cidades.indexOf(data.item), data.item.id)">
                    <b-icon icon="trash-fill" scale="1"></b-icon>
                </b-button>
            </template>
        </b-table>
        <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="cidades_table">
        </b-pagination>
    </div>

</template>

<script>
import axios from 'axios'
import Detalhar from './visualizar.vue';
import Inserir from './inserir.vue';
import Alterar from './alterar.vue';

export default {
    name: "listarCidade",
    components: { Detalhar, Inserir, Alterar },
    data() {
        return {
            isBusy: false,
            cidades: [],
            fields: [
                { key: "nome", label: "Nome", sortable: true, formatter: this.nomeFormatter },
                { key: "estadoNome", label: "Estado", sortable: true },
                { key: "created_at", label: "Criado em", sortable: true },
                { key: "updated_at", label: "Atualizado em", sortable: true },
                { key: "acoes", label: "Ações" },
            ],
            acoes: ["Editar", "Excluir"],
            confirm: {
                success: null,
                message: null,
            },
            id_detalhar_cidade: null,
            id_cidade_a_ser_alterada: null,
            filteredCidade: null,
            perPage: 5,
            currentPage: 1,
        };
    },
    mounted() {
        this.getCidades();
    },
    computed: {
        rows() {
            return this.cidades.length;
        },
    },
    watch: {
        filteredCidade: function () {
            if (this.filteredCidade != null && this.filteredCidade != "") {
                axios.get("http://localhost:8000/api/cidade/filtrar/" + this.filteredCidade)
                    .then(response => {
                        if (response.status == 200) {
                            this.cidades = response.data.cidades;
                        }
                        else {
                            console.log("Erro ao buscar dados");
                        }
                    });
            } else {
                this.getCidades();
            }
        }
    },
    methods: {
        toggleBusy() {
            this.isBusy = !this.isBusy;
        },
        async getCidades() {
            const response = await axios.get("http://localhost:8000/api/cidade/listar");
            if (response.status == 200) {
                this.cidades = response.data.cidades;
            }
            else {
                console.log("Erro ao buscar dados");
            }
        },
        inserir() {
            this.$refs.inserir.show();
        },
        alterar(id) {
            this.id_cidade_a_ser_alterada = id;
            this.$refs.alterar.show();
        },
        excluir(index, id) {
            if (confirm("Deseja realmente excluir este registro?")) {
                axios.delete("http://localhost:8000/api/cidade/excluir/" + id)
                    .then(response => {
                        if (response.status == 200) {
                            this.confirm.success = response.data.success;
                            this.confirm.message = response.data.message;
                            if (this.confirm.success == true) {
                                this.cidades.splice(index, 1);
                            }
                        }
                    });
            }
        },
        detalhar(id) {
            this.$refs.detalhar.show();
            this.id_detalhar_cidade = id;
        },
        updateConfirm(confirm) {
            this.confirm = confirm;
        },
        updateCidades(cidade) {
            this.cidades.push(cidade);
        },
        updateCidadeAlterada(cidade) {
            let index = this.cidades.findIndex(item => item.id == cidade.id)
            this.$set(this.cidades, index, cidade);
        },
        closeModalInsert() {
            this.$refs.inserir.hide();
        },
        closeModalEdit() {
            this.$refs.alterar.hide();
        },
    }
};
</script>

<style>
#cidades_table {
    width: 100%;
}

#nova-cidade-button {
    width: 150px;
}

#filter-insert p{
    font-size: 1.3rem;
    margin: 0;
}

table button {
    margin: 5px;
    color: white !important;
}

#input-3 {
    width: 100% !important;
    border-radius: 0.25rem;
    border-color: rgb(206, 212, 218);
    height: 35px;

}
</style>