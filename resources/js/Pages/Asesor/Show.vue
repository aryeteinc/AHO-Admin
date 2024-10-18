<template>
    <h1>Hola en el Template de Asesores</h1>
    <ul>
        <li v-for="asesor in asesors" :key="asesor.id">
            {{ asesor.name }}
        </li>
    </ul>
</template>

<script setup>
    import { ref } from 'vue';
    defineProps({asesors: Object});
</script>

