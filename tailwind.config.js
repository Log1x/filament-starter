/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    './app/**/*.php',
    './config/**/*.php',
    './resources/**/*.{php,js}',
    './storage/framework/views/*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
