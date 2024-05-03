const colors = require('tailwindcss/colors') 

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.{html,js,php}",
    "./includes/*.{html,js,php}"
  ],
  theme: {
    extend: {},
    colors: {
      primary: '#5542f6',
      highlight: '#eae8fb',
      bgGray: '#fbfafd',
      dark: "#1b1b1b",
      light: "#f5f5f5",
      primaryDark: "#58E6D9",
      transparent: 'transparent', 
      current: 'currentColor', 
      black: colors.black, 
      white: colors.white, 
      red: colors.red,  
      blue: colors.blue,  
      green: colors.green,
      indigo: colors.indigo, 
      yellow: colors.yellow,  
      sky: colors.sky, 
      neutral: colors.neutral, 
      gray: colors.gray,  
      rose: colors.rose,
    },
    screens: {
      "2xl" : {max: "1535px"},
      // => @media(max-width: 1535px) { ... }

      "xl": { max: "1279px" },
      // => @media (max-width: 1279px) { ... }

      "lg": { max: "1023px" },
      // => @media (max-width: 1023px) { ... }

      "md": { max: "767px" },
      // => @media (max-width: 767px) { ... }

      "sm": { max: "639px" },
      // => @media (max-width: 639px) { ... }

      "xs": { max: "479px" },
      // => @media (max-width: 479px) { ... }
    }

  },
  plugins: [],
}

