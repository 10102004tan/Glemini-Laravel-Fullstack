/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./node_modules/flowbite/**/*.js",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php", //
    
  ],
  theme: {
    extend: {
      colors:{
        'primary': '#1f2937',
        'secondary': '#111827',
        'overlay': '#151c2b',
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
  plugins: [
    require('flowbite/plugin'),
    function({ addUtilities }) {
      const newUtilities = {
        '.center': {
          position: 'absolute',
          top: '50%',
          left: '50%',
          transform: 'translate(-50%, -50%)',
        },
      }
      addUtilities(newUtilities)
    }
  ],
  
}
