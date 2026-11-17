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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                body: ['"Plus Jakarta Sans"', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['"Bricolage Grotesque"', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                paper: '#F5F1E8',
                surface: '#FFFFFF',
                ink: '#111A33',
                muted: '#555F78',
                line: '#DED7C8',
                brand: {
                    DEFAULT: '#003DA5',
                    deep: '#002B72',
                    tint: '#E8EEF8',
                },
                accent: '#D3262F',
            },
        },
    },

    plugins: [forms],
};
