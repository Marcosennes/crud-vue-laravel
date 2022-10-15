<template>
    <div>
        {{ users.status }}
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'homeComp',
    props: {},
    mounted() {
        this.getUsers();
    },
    data() {
        return {
            users: []
        }
    },
    methods: {
        async getUsers() {
            const response = await axios.get('http://localhost:8000/api/');

            if (response.status == 200) {
                this.users = response.data;
            } else {
                console.log('Erro ao buscar dados');
            }
        }
    }
};
</script>