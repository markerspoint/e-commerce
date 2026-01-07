/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#0d4d45', 
        'primary-hover': '#093b35',
        secondary: '#fdc040',
        'secondary-hover': '#e0a800',
        accent: '#c8eb77',
        'accent-hover': '#b4d668',
        'soft-accent': '#e9f5d6',
        'shop-black': '#1e293b',
        'shop-bg': '#f4f6f6',
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
      },
      screens: {
        'xs': '360px',
      },
      borderRadius: {
        'xl': '1rem',
        '2xl': '1.5rem',
        '3xl': '2rem',
        '4xl': '2.5rem', // For the hero curve
      }
    },
  },
  plugins: [],
}

