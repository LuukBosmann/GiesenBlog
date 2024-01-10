/** @type {import('tailwindcss').Config} */

module.exports = {

    content: [

        './resources/**/*.blade.php',

        './resources/**/*.js',

        './resources/**/*.vue',

    ],

    theme: {

        extend: {},
        colors: {
          giesenBlue: '#444D6E',
          giesenDarkBlue: '#222948',
          giesenBlack: '#2B2B2B',
          giesenWhite: {
            100: '#FFFFFF',
            200: '#F0F0F0',
            300: '#DFDFE0',
            400: '#EEEEF0',
          }
        },

    },

    plugins: [],

}
