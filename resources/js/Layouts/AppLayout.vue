<template>
    <div class="app-layout">
        <Header />

        <div>
            <slot />
        </div>

        <Footer />
    </div>

</template>
<script setup lang="ts">
    import Footer from "@/Components/AHO/Footer.vue";
    import Header from "@/Components/AHO/Header.vue";
</script>

<style scoped>
.app-layout {
    display: grid;
    grid-template-rows: auto 1fr auto;
    min-height: 100vh;
}
</style>
