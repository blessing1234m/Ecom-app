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
            },colors: {
        primary: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          400: '#7dd3fc',
          300: '#38bdf8',
          700: '#0ea5e9',   // 💡 Tu peux changer cette valeur selon ton design
          500: '#0284c7',
          600: '#2a61f7ff',
          800: '#075985',
          900: '#0c4a6e',
        },
      },
        },
    },

    plugins: [forms],
};
