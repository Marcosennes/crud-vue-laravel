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

import Cookie from 'js-cookie'

export default {
    name: 'loginComp',
    data: () => {
        return {
            form: {
                email: null,
                password: null,
            }
        }
    },
    // created(){
    //     Cookie.remove('logged_token')
    // },
    methods: {
        logar() {
            fetch('http://127.0.0.1:8000/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.form)
            })
                .then(response => {
                    if (response.status == 200) {
                        return response.json()
                    } else{
                        alert('Usuário ou senha inválidos!')
                    }
                })
                .then(data => {
                    Cookie.set('logged_token', data.access_token)
                    this.$router.push('/logged')
                })
        },
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