/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class', 
  theme: {
    extend: {
    },
  },
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    themes: [ "light","dark"], // You can customize the themes here
  },
}

