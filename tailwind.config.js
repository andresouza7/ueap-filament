/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      boxShadow: {
        neon: "0 0 10px theme('colors.green.200'), 0 0 25px theme('colors.green.700')"
      }
    },
  },
  plugins: [],
  darkMode: 'class',
}

