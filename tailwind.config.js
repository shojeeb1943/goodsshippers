import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary": "#1a355b",
                "accent": "#f97316",
                "brand": {
                    "blue": "#1e3a5f",
                    "blue-dark": "#0f2744",
                    "navy": "#0a192f",
                    "orange": "#f97316",
                    "orange-hover": "#ea580c",
                    "green": "#22c55e",
                },
                "background": {
                    "light": "#f8fafc",
                    "dark": "#0f172a",
                },
            },
        },
    },

    plugins: [forms],
};
