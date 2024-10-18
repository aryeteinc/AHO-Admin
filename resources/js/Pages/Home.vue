<template>
    <AppLayout>


        <div class="video-container">
            <video autoplay loop muted playsinline class="background-video">
                <source src="../../../public/storage/video_promocional.mp4" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>


            <div class="search-form-container">
                <h2 class="form-title text-2xl font-bold text-white gabarito-font">Encuentra tu próximo Hogar o Negocio</h2>
                <form class="search-form">
                    <div class="form-group">
                        <label for="city" class="gabarito-font text-white">Ciudad</label>
                        <input type="text" id="city" name="city" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="property-type" class="gabarito-font text-white">Tipo de Inmueble</label>
                        <input type="text" id="property-type" name="property-type" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="transaction-type" class="gabarito-font text-white">Tipo de Transacción</label>
                        <input type="text" id="transaction-type" name="transaction-type" class="form-control" />
                    </div>
                    <button type="submit" class="btn-primary">Buscar</button>
                </form>
            </div>


        </div>

        <div>
            <slot />
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<style scoped>
    .video-container {
        position: relative;
        height: 100vh; /* 3/4 of the viewport height */
        overflow: hidden;
    }

    .background-video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
    }

    .search-form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(255, 255, 255, 0.2); /* White background with transparency */
        backdrop-filter: blur(1px); /* Blur effect */
        border: 1px solid white; /* White border */
        border-radius: 15px; /* Rounded corners */
        padding: 2rem;
        width: 80%;
        max-width: 600px;
    }

    .search-form {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        width: calc(33.33% - 1rem);
    }

    .form-control {
        padding: 0.5rem;
        border-radius: 10px; /* Rounded corners for input fields */
        border: 1px solid white; /* White border */
        background: rgba(255, 255, 255, 0.1); /* Slightly darker background with transparency */
        backdrop-filter: blur(5px); /* Blur effect */
        color: white;
    }


</style>

