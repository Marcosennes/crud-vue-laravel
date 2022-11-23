<template>
    <div>
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
        <b-button class="mx-2" @click="exportData" variant="primary">Download file</b-button>
    </div>
</template>
 
<script>
import VueHtml2pdf from 'vue-html2pdf'
import axios from 'axios'
import { excelParser } from "../excel-parser";
// import { sampleData } from "./sample-data";


export default {
    name: 'pdfComp',
    components: {
        VueHtml2pdf
    },
    data() {
        return {
            isBusy: false,
            estados: [],
            fields: [
                { key: "nome", label: "Nome", sortable: true, formatter: this.nomeFormatter },
                { key: "abreviacao", label: "Abreviação", sortable: true },
                { key: "created_at", label: "Criado em", sortable: true },
                { key: "updated_at", label: "Atualizado em", sortable: true },
            ],
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
    methods: {
        generateReport() {
            this.$refs.html2Pdf.generatePdf()
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
        exportData() {
            excelParser().exportDataFromJSON(this.estados, null, null);
        },
    },
}
</script>

<style>

</style>