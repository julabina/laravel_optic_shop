import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
                sans: ['Roboto', 'sans-serif', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#14416A',
                secondary : '#14416A',
                tertiary : '#FF0000',
                greenValidate: '#74c13b',
                searchBtn: '#1a1c17',
                searchInput: 'rgba(255, 255, 255, 0.226)'
            }
        },
    },

    plugins: [forms],
};
