<template>
    <div class="row mt-5">
        <div id="cidades-redis" class="d-flex justify-content-center">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="cidade in cidades" :key="cidade.id">
                        <td>{{ cidade.nome }}</td>
                        <td>{{ cidade.estadoNome }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="mt-5 col-12 d-flex justify-content-center">
                <b-button id="atualizar-button" class="mx-1" variant="primary" @click="getCidades(0)">1</b-button>
                <b-button id="atualizar-button" class="mx-1" variant="primary" @click="getCidades(1)">2</b-button>
                <b-button id="atualizar-button" class="mx-1" variant="primary" @click="getCidades(2)">3</b-button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default{
        name: 'RedisComp',
        data() {
            return {
                cidades : [],
            }
        },
        mounted() {
            this.getCidades();
        },
        methods: {
            getCidades(current_page = 0) {
                axios.get('http://localhost:8000/api/cidade/cidadesPag/' + current_page)
                    .then(response => {
                        if (response.status == 200) {
                            this.cidades = response.data.cidades;
                        }
                        else {
                            console.log("Erro ao buscar dados");
                        }
                    });
            },
        }
    }
</script>

<style>
#cidades-redis{
    margin: 0 auto;
    width: 50%;
}
</style>