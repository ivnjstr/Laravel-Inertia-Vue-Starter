/** @type {import('tailwindcss').Config} */
export default {

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        Montserrat: ["Montserrat", 'serif'],
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

