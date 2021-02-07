const colors = require('tailwindcss/colors')

module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            dark: colors.coolGray["900"],
            primary: colors.blue["500"]
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
