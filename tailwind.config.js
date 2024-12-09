/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './app/*.php',
    './app/assets/js/*.js',
    './app/includes/**/*.php',
    './app/models/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        'arial': ['Arial'],
        'playfair': ['Playfair Display'],
      },
    },
  },
  plugins: [],
}

