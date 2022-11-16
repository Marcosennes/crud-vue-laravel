<template>
    <div id="estudosContainer" class="container">
        <div class="row">
            <div class="col-6">
                <b-form @submit.prevent="envio">
                    <b-form-group id="primeiroNomeLabel" label="Primeiro nome:" label-for="primeiroNome">
                        <b-form-input id="primeiroNome" v-model="primeiroNome" type="text" placeholder="Primeiro nome"
                            required>
                        </b-form-input>
                    </b-form-group>

                    <b-form-group id="segundoNomeLabel" class="mt-2" label="Segundo Nome:" label-for="segundoNome">
                        <b-form-input id="segundoNome" v-model="segundoNome" placeholder="Segundo nome" required>
                        </b-form-input>
                    </b-form-group>

                    <!-- <b-button id="cadastrar-button" class="mt-2" type="submit" variant="primary">Cadastrar</b-button> -->
                </b-form>
            </div>
            <div id="NomeResult" class="col-6">
                <label for="nomeCompleto">
                    <span id="nomeCompleto">{{ nomeCompleto }}</span>
                </label>
            </div>
        </div>
        <div id="enviar-button-div" class="row mt-3 d-flex justify-content-end">
            <b-button id="enviar-button" variant="outline-primary">Button</b-button>
        </div>
    </div>
</template>

<script>

export default {
    name: 'estudosComp',
    data: () => {
        return {
            primeiroNome: null,
            segundoNome: null,
        }
    },
    computed: {
        nomeCompleto() {
            if(this.primeiroNome && this.segundoNome) {
                return this.primeiroNome + ' ' + this.segundoNome
            } else{
                return ''
            }
        }
    }
};
</script>

<style>
#estudosContainer {
    margin-top: 20px;
}

#NomeResult {
    background-color: gainsboro;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}
#enviar-button{
    width: 100px;
}
</style>