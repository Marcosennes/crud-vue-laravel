<template>
    <div>
        <div>
            <p>Nome: {{nome}}</p>
            <p>Abreviação: {{abreviacao}}</p>
            <p>Criado em: {{created_at}}</p>
            <p>Atualizado em: {{updated_at}}</p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'visualizarEstado',
    props: ['id'],
    data: function () {
        return {
            nome: null,
            abreviacao: null,
            created_at: null,
            updated_at: null,
        }
    },
    mounted() {
        this.getEstado();
    },
    watch: {
        id: function () {
            this.getEstado();
        }
    },
    methods: {
        async getEstado() {
            const response = await axios.get("http://localhost:8000/api/estado/detalhar/" + this.id);
            if (response.status == 200) {
                this.nome = response.data.estado.nome;
                this.abreviacao = response.data.estado.abreviacao;
                this.created_at = new Date(response.data.estado.created_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo'});
                this.updated_at = new Date(response.data.estado.updated_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo'});
            }
            else {
                alert("Erro ao buscar dados");
            }
        },
    },
};
</script>



