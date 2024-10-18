<script setup>

</script>

<template>
    <div class="header">
        <div class="logo">
            <img src="/images/Logo_Blanco_sin_fondo.svg" alt="Logo" class="logo-img" />
        </div>
        <nav class="menu">
            <a href="#" class="menu-item">Inmuebles</a>
            <a href="#" class="menu-item">Simulador de Crédito</a>
            <a href="#" class="menu-item">Compañía</a>
            <a href="#" class="menu-item">Contacto</a>
        </nav>
    </div>

</template>

<style scoped>

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(0, 0, 0, 0); /* Fondo transparente */
    color: white;
    padding: 3rem;
    position: absolute;
    top: 0;
    width: 100%;
    height: 12.5vh; /* 1/8 del viewport height */
    z-index: 10; /* Asegura que esté delante del video */
}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
}

.logo-img {
    max-height: 20rem;
    max-width: 20rem;
    height: 20rem;
    width: 20rem;
}

.menu {
    display: flex;
    gap: 1rem;
}

.menu-item {
    color: white;
    font-weight: bold;
    text-decoration: none;
}

</style>
