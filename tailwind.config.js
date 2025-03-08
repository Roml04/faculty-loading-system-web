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
            colors: {
                primary: '#005DA6',
                secondary: '#F4D03F',
                txtclr_primary: '#005DA6',
                txtclr_white: '#FFFFFF',
                txtclr_gray: '#ACACAC',
                txtclr_black: '#000000',
                bgcolor_white: '#FFFFFF',
                bgcolor_lightgray: '#E8E8ED',
                bgcolor_gray: '#E0E0E0',
                bgcolor_bluishlightgray: '#CDDDF0',
                stroke_lightblue: '#B6C8E2',
                stroke_gray: '#ACACAC',
                stroke_black: '#444444',
                icon_white: '#FFFFFF',
                icon_gray: '#ACACAC',
                icon_black: '#000000',
                state_success_l: '#B8FFAE',
                state_success_d: '#279E18',
                state_danger_l: '#FFCBC5',
                state_danger_d: '#FF5444',
                grid_lightgray: '#E1E1E1',
            },
            fontSize: {
                headline: ['4rem', { lineHeight: '69.6px', fontWeight: 600 }],
                subheadline: ['2rem', { lineHeight: '2.344rem'}],
                heading1: ['2rem', { lineHeight: '2.344rem', fontWeight: 600 }],
                heading2: ['1.5rem', { lineHeight: '1.756rem', fontWeight: 600 }],
                heading3: ['1rem', { lineHeight: '1.175rem', fontWeight: 800 }],
                paragraph_bs: ['1rem', { lineHeight: '1.175rem' }],
                paragraph_sm: ['0.75rem', { lineHeight: '1.175rem'}],
            },
            fontFamily: {
                sans: ['Roboto', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
