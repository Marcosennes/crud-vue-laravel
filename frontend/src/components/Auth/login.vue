<template>
    <div id="estudosContainer" class="container">
        <div class="row">
            <b-form @submit.prevent="logar">
                <div id="NomeResult" class="offset-2 col-8">
                    <div class="offset-2 col-8">
                        <b-form-group id="" class="mt-2" label="Email:" label-for="email">
                            <b-form-input id="email" v-model="form.email" type="email" placeholder="" required>
                            </b-form-input>
                        </b-form-group>
                        <b-form-group id="" label="Senha:" label-for="password">
                            <b-form-input id="password" v-model="form.password" type="password" placeholder="" required>
                            </b-form-input>
                        </b-form-group>
                    </div>
                    <div class="offset-2 col-8">
                        <div id="enviar-button-div" class="mt-3 d-flex justify-content-end">
                            <b-button id="enviar-button" variant="primary" type="submit">Enviar</b-button>
                        </div>
                    </div>
                </div>
            </b-form>
        </div>
    </div>
</template>

<script>



export default {
    name: 'loginComp',
    data: () => {
        return {
            form: {
                email: null,
                password: null,
            },
            alert: {
                short_password: false,
                passwords_dont_match: false,
                null_password: false,
                null_confirm_password: false,
            }
        }
    },
    watch: {
        'form.password': function () {
            this.cleanAlerts()
        },
        'form.password_confirm': function () {
            this.cleanAlerts()
        }

    },
    methods: {
        logar() {
            alert("logar")
            fetch('http://127.0.0.1:8000/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.form)
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                })
        },
        redefinirSenha() {
            if (this.form.password == null) {   // Senha é nula
                this.alert.null_password = true
            } else {
                if (this.form.password.length < 8) {    // Senha é menor que 8 caracteres
                    this.alert.short_password = true
                    return false
                }
            }
            if (this.form.password_confirm == null) {   // Confirmação de senha é nula
                this.alert.null_confirm_password = true
            } else {
                if (this.form.password !== this.form.password_confirm) {  // Senha e confirmação de senha conferem
                    this.alert.passwords_dont_match = true
                } else {
                    alert("Formulário enviado com sucesso!")
                }
            }
        },
        cleanAlerts() {
            this.alert.short_password = this.alert.passwords_dont_match = this.alert.null_password = this.alert.null_confirm_password = false
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