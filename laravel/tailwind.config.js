/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./themes/default/**/*.blade.php",
        "./themes/default/**/*.js",
        "./themes/default/**/*.vue",
        "./app/Http/Controllers/**/*.php"
    ],
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito'],
            },
            colors: {
                'gray': {
                    50: '#f9fafb',
                    100: '#f4f5f7',
                    200: '#e5e7eb',
                    300: '#d5d6d7',
                    400: '#9e9e9e',
                    500: '#707275',
                    600: '#4c4f52',
                    700: '#24262d',
                    800: '#1a1c23',
                    900: '#121317',
                },
                'purple': {
                    100: '#edebfe',
                    300: '#cabffd',
                    400: '#ac94fa',
                    500: '#9061f9',
                    600: '#7e3af2',
                    700: '#6c2bd9',
                }
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
}
