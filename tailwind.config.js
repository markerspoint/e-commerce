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
        primary: '#0d4d45', // Deep Teal/Green
        'primary-hover': '#093b35',
        secondary: '#fdc040', // Orange/Yellow accent if needed
        'secondary-hover': '#e0a800',
        accent: '#c8eb77', // Lime Green
        'accent-hover': '#b4d668',
        'soft-accent': '#e9f5d6', // Very light green
        'shop-black': '#1e293b',
        'shop-bg': '#f9f9f7', // Warm off-white background
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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

