<template>
    <div>
        <!-- <Link href="/">Home</Link>
        <Link href="/about">Sobre</Link>
        <Link href="/estado/listar">Estados</Link>
        <Link href="/estado/inserir">Inserir Estado</Link> -->
        <router-link to="/" class="nav-item nav-link">Home</router-link>
        <router-link to="/about" class="nav-item nav-link">Sobre</router-link>
        <router-link to="/estado/listar" class="nav-item nav-link">Estados</router-link>
        <router-link to="/estado/inserir" class="nav-item nav-link">Inserir Estado</router-link>
        <router-view></router-view>
        <!-- <div>
            <slot />
        </div> -->
    </div>
</template>

<script>
export default {
    name: 'layout',
};
</script>