import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import theme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                //sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Raleway', ...defaultTheme.fontFamily.sans],
                gabarito: ['Gabarito', 'sans-serif'],
            },
            colors:{
                'midnight-black': '#01182B',
                'red-wine': '#5C0807',
                'power-red': '#A90808',
                'quiet-gray': '#B3B3B3'
            }
        },
    },

    plugins: [forms,
    function({addComponents, theme}){
        addComponents({
            '.btn-primary': {
                padding: '0.75rem',
                borderRadius: '10px',
                border: 'none',
                backgroundColor: theme('colors.power-red'),
                color: 'white',
                fontWeight: 'bold',
                cursor: 'pointer',
                position: 'relative',
                overflow: 'hidden',
                width: 'calc(33.33% - 1rem)',
                '&:hover': {
                    backgroundColor: theme('colors.red-wine'),
                },
                '&::before': {
                    content: '""',
                    position: 'absolute',
                    bottom: '0',
                    right: '0',
                    width: '100%',
                    height: '100%',
                    background: 'url("/images/esquinero_cuadro_blanco.png") no-repeat bottom right',
                    backgroundSize: 'contain',
                    opacity: '0.5',
                    pointerEvents: 'none',
                },
            },
        });
    }],
};
