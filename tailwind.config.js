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
        primary: '#6366f1', // Soft Modern Indigo
        'primary-hover': '#4f46e5',
        secondary: '#f43f5e', // Soft Rose/Coral accent
        'shop-black': '#1e293b', // Slate 800 - softer than pure black
        'shop-gray': '#f8fafc', // Slate 50 - very soft gray background
      },
      borderRadius: {
        'xl': '1rem',
        '2xl': '1.5rem',
      }
    },
  },
  plugins: [],
}

