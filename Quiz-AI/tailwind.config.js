/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        'primary': '#1f2937',
        'secondary': '#111827',
      }
    },
    container: {
      center: true,
      padding: '2rem',
      screens: {
        sm: "100%",
        md: "100%",
        lg: "100%",
        xl: "100%",
      }
    }
  },
  plugins: [],
}
