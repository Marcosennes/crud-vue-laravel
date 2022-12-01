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
        <b-modal hide-footer ref="inserir" title="Inserir Estado">
            <Inserir @confirm="updateConfirm" @estadoInserido="updateEstados" @closeModal="closeModalInsert"></Inserir>
        </b-modal>
        <b-modal hide-footer ref="alterar" title="Alterar Estado">
            <div v-if="id_estado_a_ser_alterado">
                <Alterar @confirm="updateConfirm" @estadoAlterado="updateEstadoAlterado"
                    @closeModalEdit="closeModalEdit" :id_estado="id_estado_a_ser_alterado"></Alterar>
            </div>
        </b-modal>
        <b-modal hide-footer ref="detalhar" title="Detalhes Estado">
            <div v-if="id_detalhar_estado">
                <Detalhar :id_estado="id_detalhar_estado" />
            </div>
        </b-modal>
        <div id="filter-insert" class="row mt-3">
            <div class="col-2">
                <p>Filtro: </p>
            </div>
            <div class="col-8">
                <b-form-input id="input-1" v-model="filteredEstado" type="text" placeholder="Nome do Estado" required>
                </b-form-input>
            </div>
            <div class="col-2">
                <b-button id="novo-estado-button" class="btn btn-primary" @click="inserir()">
                    <b-icon icon="plus" scale="1"></b-icon> Novo Estado
                </b-button>
            </div>
        </div>
        <b-table id="estados_table" striped responsive :per-page="perPage" :current-page="currentPage" label-sort-asc=""
            label-sort-desc="" label-sort-clear="" :items="estados" :busy="isBusy" :fields="fields" class="mt-3"
            outlined>
            <template #cell(created_at)="data">
                {{ new Date(data.item.created_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo' }) }}
            </template>
            <template #cell(updated_at)="data">
                {{ new Date(data.item.updated_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo' }) }}
            </template>
            <template #cell(acoes)="data">
                <b-button size="sm" variant="info" @click="detalhar(data.item.id)">
                    <b-icon icon="eye-fill" scale="1"></b-icon>
                </b-button>
                <b-button size="sm" variant="warning" @click="alterar(data.item.id)">
                    <b-icon icon="pencil-fill" scale="1"></b-icon>
                </b-button>
                <b-button size="sm" variant="danger" @click="excluir(estados.indexOf(data.item), data.item.id)">
                    <b-icon icon="trash-fill" scale="1"></b-icon>
                </b-button>
            </template>
        </b-table>
        <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage" aria-controls="estados_table">
        </b-pagination>
        <!-- Visualização em PDF -->
        <VueHtml2pdf :show-layout="false" :float-layout="true" :enable-download="false" :preview-modal="true"
            :paginate-elements-by-height="1400" filename="pd_de_teste" :pdf-quality="2" :manual-pagination="false"
            pdf-format="a4" pdf-orientation="landscape" pdf-content-width="800px" ref="html2Pdf">
            <section slot="pdf-content">
                <b-table id="estados_table" striped responsive label-sort-asc="" label-sort-desc="" label-sort-clear=""
                    :items="estados" :fields="fields" class="mt-3" outlined>
                    <template #cell(created_at)="data">
                        {{ new Date(data.item.created_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo' }) }}
                    </template>
                    <template #cell(updated_at)="data">
                        {{ new Date(data.item.updated_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo' }) }}
                    </template>
                </b-table>
            </section>:per-page="perPage" :current-page="currentPage"
        </VueHtml2pdf>
        <b-button class="mx-2" @click="generateReport" variant="primary">Gerar PDF</b-button>
        <b-button class="mx-2" @click="exportData" variant="primary">Gerar CSV</b-button>
    </div>
</template>

<script>
import axios from 'axios'
import Detalhar from './visualizar.vue';
import Inserir from './inserir.vue';
import Alterar from './alterar.vue';
import VueHtml2pdf from 'vue-html2pdf'
import { excelParser } from "../../excel-parser";

export default {
    name: "listarEstado",
    components: { Detalhar, Inserir, Alterar, VueHtml2pdf },
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
            id_estado_a_ser_alterado: null,
            filteredEstado: null,
            perPage: 5,
            currentPage: 1,
        };
    },
    mounted() {
        this.getEstados();
    },
    computed: {
        rows() {
            return this.estados.length
        },
    },
    watch: {
        filteredEstado: function () {
            if (this.filteredEstado != null && this.filteredEstado != "") {
                axios.get("http://localhost:8000/api/estado/filtrar/" + this.filteredEstado)
                    .then(response => {
                        if (response.status == 200) {
                            this.estados = response.data.estados;
                        }
                        else {
                            console.log("Erro ao buscar dados");
                        }
                    });
            } else {
                this.getEstados();
            }
        }
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
        alterar(id) {
            this.id_estado_a_ser_alterado = id;
            this.$refs.alterar.show();
        },
        excluir(index, id) {
            if (confirm("Deseja realmente excluir este registro?")) {
                axios.delete("http://localhost:8000/api/estado/excluir/" + id)
                    .then(response => {
                        if (response.status == 200) {
                            this.confirm.success = response.data.success;
                            this.confirm.message = response.data.message;
                            if (response.data.success == true) {
                                this.estados.splice(index, 1);
                            }
                        }
                    });
            }
        },
        detalhar(id) {
            this.$refs.detalhar.show();
            this.id_detalhar_estado = id;
        },
        updateConfirm(confirm) {
            this.confirm = confirm;
        },
        updateEstados(estado) {
            this.estados.push(estado);
        },
        updateEstadoAlterado(estado) {
            let index = this.estados.findIndex(item => item.id == estado.id)
            this.$set(this.estados, index, estado);
        },
        closeModalInsert() {
            this.$refs.inserir.hide();
        },
        closeModalEdit() {
            this.$refs.alterar.hide();
        },
        generateReport() {
            this.$refs.html2Pdf.generatePdf()
        },
        exportData() {
            excelParser().exportDataFromJSON(this.estados, null, null);
        },
    }
};
</script>

<style>
#estados_table {
    width: 100%;
}

#novo-estado-button {
    width: 150px;
}

#filter-insert p {
    font-size: 1.3rem;
    margin: 0;
}

table button {
    margin: 5px;
    color: white !important;
}
</style>