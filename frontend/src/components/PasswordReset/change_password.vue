<template>
    <div id="estudosContainer" class="container">
        <div class="row">
            <div id="NomeResult" class="offset-2 col-8">
                <div class="offset-2 col-8">
                    <b-form @submit.prevent="envio">
                        <b-form-group id="" label="Senha:" label-for="password">
                            <b-form-input id="password" v-model="form.password" type="text" placeholder="" required>
                            </b-form-input>
                        </b-form-group>
                        <div v-if="alert.short_password" class="mt-1">
                            <span class="error-text">Senha deve possuir pelo menos 8 caracteres.</span>
                        </div>
                        <div v-if="alert.null_password" class="mt-1">
                            <span class="error-text">Senha não pode ser vazio.</span>
                        </div>
                        <b-form-group id="" class="mt-2" label="Confirme a senha:" label-for="passwordConfirm">
                            <b-form-input id="passwordConfirm" v-model="form.password_confirm" placeholder="" required>
                            </b-form-input>
                        </b-form-group>
                        <div v-if="alert.null_confirm_password" class="mt-1">
                            <span class="error-text">Confirmação de Senha não pode ser vazio.</span>
                        </div>
                        <div v-if="alert.passwords_dont_match" class="mt-1">
                            <span class="error-text">Senha e confirmação de senha não conferem.</span>
                        </div>
                    </b-form>
                </div>
                <div class="offset-2 col-8">
                    <div id="enviar-button-div" class="mt-3 d-flex justify-content-end">
                        <b-button id="enviar-button" variant="primary" @click="redefinirSenha()">Enviar</b-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>



export default {
    name: 'estudosComp',
    data: () => {
        return {
            form: {
                password: null,
                password_confirm: null,
            },
            alert: {
                short_password: false,
                passwords_dont_match: false,
                null_password: false,
                null_confirm_password: false,
            }
        }
    },
    computed: {
    },
    methods: {
        redefinirSenha() {
            if (this.form.password == null) {
                this.alert.null_password = true
            } else {
                this.alert.null_password = false
                if (this.form.password.length < 8) {
                    this.alert.short_password = true
                } else {
                    this.alert.short_password = false
                    if (this.form.password_confirm == null) {
                        this.alert.null_confirm_password = true
                    } else {
                        this.alert.null_confirm_password = false
                        if (this.form.password != this.form.confirmPassword) {
                            this.alert.passwords_dont_match = true
                        } else {
                            this.alert.passwords_dont_match = false
                        }
                    }
                }
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
    background-color: rgba(241, 241, 241, 0.911);
    padding: 10px;
    border-radius: 7px;
    text-align: initial;
}

#enviar-button {
    width: 100px;
}

.error-text {
    color: red;
}
</style>