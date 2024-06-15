/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "5rem",
                "2xl": "6rem",
            },
        },
        extend: {
            colors: {
                cover: "rgba(0,0,0,0.2)",
                darkTransparent: "rgba(0,0,0,0.05)",
                primary: "#9F2B2B",
                secondary: "#2A2A2A",
            },
        },
    },
    plugins: [],
};
