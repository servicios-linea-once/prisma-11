/**
 * Prisma 11 - Preset oficial para Tailwind CSS v3
 * https://github.com/servicio-linea-once/prisma-11
 */

const tokens = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

const colors = {};
tokens.forEach(token => {
  colors[token] = `rgb(var(--p11-${token}) / <alpha-value>)`;
  colors[`${token}-fg`] = `rgb(var(--p11-${token}-fg) / <alpha-value>)`;
  colors[`${token}-border`] = `rgb(var(--p11-${token}-border) / <alpha-value>)`;
  colors[`${token}-ring`] = `rgb(var(--p11-${token}-ring) / <alpha-value>)`;
});

module.exports = {
  darkMode: 'class',
  content: [
    './vendor/servicio-linea-once/prisma-11/resources/views/**/*.blade.php',
    './vendor/servicio-linea-once/prisma-11/src/**/*.php',
  ],
  theme: {
    extend: {
      colors: colors,
    },
  },
};
