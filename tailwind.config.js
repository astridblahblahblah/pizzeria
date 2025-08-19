/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./resources/js/**/*.{vue,js,ts}",
    ],
    theme: {
        extend: {},
    },
    plugins: [require('daisyui')],
    daisyui: {
        themes: ["luxury"],
    },
}
