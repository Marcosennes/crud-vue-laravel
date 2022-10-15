<template>
    <div>
        <!-- <b-button @click="toggleBusy">Toggle Busy State</b-button> -->

        <b-table responsive :items="estados" :busy="isBusy" :fields="fields" class="mt-3" outlined>
            <!-- <template #cell(acoes)="data">
                <b-button size="sm" variant="warning" @click="alterar()">Alterar</b-button>
                <b-button size="sm" variant="danger">Excluir</b-button>
            </template> -->
            <!-- <b-button size="sm" variant="danger" @click="excluir(data.item.id)">Excluir</b-button> -->
            <template #table-busy>
                <div class="text-center text-danger my-2">
                    <b-spinner class="align-middle"></b-spinner>
                    <strong>Loading...</strong>
                </div>
            </template>
        </b-table>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'listarEstado',
    data() {
        return {
            isBusy: false,
            estados: [],
            fields: [
                { key: 'nome', label: 'Nome', sortable: true, formatter: this.nomeFormatter },
                { key: 'abreviacao', label: 'Abreviação', sortable: true },
                { key: 'created_at', label: 'Criado em', sortable: true },
                { key: 'updated_at', label: 'Atualizado em', sortable: true },
                { key: 'acoes', label: 'Ações' },
            ],
            acoes: ["Editar", "Excluir"],
        }
    },
    mounted(){
        this.getEstados();
    },
    methods: {
        toggleBusy() {
            this.isBusy = !this.isBusy
        },

        async getEstados() {
            const response = await axios.get('http://localhost:8000/api/estado/listar');
            if (response.status == 200) {
                this.estados = response.data.estados;
            } else {
                console.log('Erro ao buscar dados');
            }
        },

        // excluir(id) {
        //     if (confirm('Deseja realmente excluir este registro?')) {
        //     }
        // },
    }
};
</script>