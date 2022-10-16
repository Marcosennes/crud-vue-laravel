<template>
  <div>
      <div>
          <p>Nome: {{nome}}</p>
          <p>Estado: {{estadoNome}}</p>
          <p>Criado em: {{created_at}}</p>
          <p>Atualizado em: {{updated_at}}</p>
      </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'visualizarCidade',
    props: ['id'],
    data: function () {
        return {
            nome: null,
            estadoNome: null,
            created_at: null,
            updated_at: null,
        }
    },
    mounted() {
        this.getCidade();
    },
    watch: {
        id: function () {
            this.getCidade();
        }
    },
    methods: {
        async getCidade() {
            const response = await axios.get("http://localhost:8000/api/cidade/detalhar/" + this.id);
            if (response.status == 200) {
                this.nome       = response.data.cidade.nome;
                this.estadoNome   = response.data.cidade.estadoNome;
                this.created_at = new Date(response.data.cidade.created_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo'});
                this.updated_at = new Date(response.data.cidade.updated_at).toLocaleString('pt-br', { timeZone: 'America/Sao_Paulo'});
            }
            else {
                alert("Erro ao buscar dados");
            }
        },
    },
};
</script>