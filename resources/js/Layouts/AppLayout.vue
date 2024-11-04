<template>
    <Head>
        <title>App</title>
    </Head>
    <div class="app-layout">
        <Header />


        <slot />


        <Footer />
    </div>

</template>
<script setup lang="ts">
    import { Head } from "@inertiajs/vue3";
    import Footer from "@/Components/AHO/Footer.vue";
    import Header from "@/Components/AHO/Header.vue";
</script>

<style scoped>
.app-layout {
    display: grid;
    grid-template-rows: auto 1fr auto;
    height: 100vh;
}
</style>
