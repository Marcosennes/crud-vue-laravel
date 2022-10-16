<template>
  <div>
    <b-form @submit.prevent="enviaFormulario">
      <b-form-group id="input-group-1" label="Nome:" label-for="input-1">
        <b-form-input id="input-1" v-model="form.nome" type="text" placeholder="Nome" required>
        </b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Estado:" label-for="input-3">
        <b-form-select id="input-3" v-model="form.estadoId" label="Estado: " required>
          <b-form-select-option v-for="(estado, index) in estados" :key="index" :value="estado.id">
            {{ estado.nome }}
          </b-form-select-option>
        </b-form-select>
      </b-form-group>

      <b-button id="cadastrar-button" class="mt-2" type="submit" variant="primary">Cadastrar</b-button>
    </b-form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'inserirCidade',
  data: () => {
    return {
      form: {
        nome: null,
        estadoId: null,
      },
      estados: [],
    }
  },
  mounted() {
    this.getEstados();
  },
  methods: {
    async getEstados() {
      const response = await axios.get("http://localhost:8000/api/estado/listar");
      if (response.status == 200) {
        this.estados = response.data.estados;
      }
      else {
        console.log("Erro ao buscar dados");
      }
    },
    enviaFormulario() {
      axios.post('http://localhost:8000/api/cidade/inserir', this.form)
        .then(response => {
          if (response.status == 200) {
            this.$emit('confirm', {
              success: response.data.success,
              message: response.data.message
            })

            this.form = {
              nome: null,
              estadoId: null,
            }
            this.$emit('cidadeInserida', response.data.cidade)
            this.$emit('closeModal', true)
          }
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.$emit('closeModal', true)
            this.$emit('confirm', {
              success: false,
              message: "A cidade não foi inserida pois " + Object.values(error.response.data.errors)[0][0]
            })
          }
        });
    },
  },

  props: {
    errors: Object
  },
}
</script>

<style>
#cadastrar-button {
  float: right;
}
</style>