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
                    @closeModalEdit="closeModalEdit" :id_estado="id_cidade_a_ser_alterada"></Alterar>
            </div>
        </b-modal>
        <b-modal hide-footer ref="detalhar" title="Detalhes Cidade">
            <div v-if="id_detalhar_cidade">
                <Detalhar :id="id_detalhar_cidade" />
            </div>
        </b-modal>
        <div>
            <div id="inserir-class" class="row d-flex flex-column mt-3">
                <b-button id="nova-cidade-button" class="btn btn-primary" @click="inserir()">
                    <b-icon icon="plus" scale="1"></b-icon> Nova Cidade
                </b-button>
            </div>
            <b-table id="cidades_table" responsive :items="cidades" :busy="isBusy" :fields="fields" class="mt-3"
                outlined>
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
        </div>
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
            id_cidade_a_ser_alterada: null
        };
    },
    mounted() {
        this.getCidades();
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
                            this.cidades.splice(index, 1);
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

#inserir-class {
    align-items: flex-end;
    margin-right: 1px;
}

table button {
    margin: 5px;
    color: white !important;
}
</style>