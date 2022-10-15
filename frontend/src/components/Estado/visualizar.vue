<template>
    <div>
        <div>
            <h1>Visualizar Estado</h1>
            <p>Nome: {{nome}}</p>
            <p>Abreviação: {{abreviacao}}</p>
            <p>Criado em: {{created_at}}</p>
            <p>Atualizado em: {{updated_at}}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'visualizarEstado',
    props: ['id', 'nome', 'abreviacao', 'created_at', 'updated_at'],
};
</script>



