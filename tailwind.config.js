import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                comeOut: 'comeOut 3s infinite ease-in-out',
            },
            keyframes: {
                comeOut: {
                    '0%': { transform: 'translate(-50%, -50%) scale(0)', opacity: '0' },
                    '50%': { transform: 'translate(-50%, -50%) scale(1)', opacity: '1' },
                    '100%': { transform: 'translate(-50%, -50%) scale(0)', opacity: '0' },
                },
            },
        },
    },
    plugins: [],
};
