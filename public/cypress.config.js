const { defineConfig } = require('cypress');

module.exports = defineConfig({
  e2e: {
    specPattern: 'cypress/e2e/**/*.{js,jsx,ts,tsx}', // Permite arquivos .cy.js ou outros
    setupNodeEvents(on, config) {
      on('before:browser:launch', (browser = {}, launchOptions) => {
        if (browser.name === 'chrome' && browser.isHeadless === false) {
          // Desativa as políticas de segurança no Chrome para permitir chamadas de CORS
          launchOptions.args.push('--disable-web-security');
          launchOptions.args.push('--disable-site-isolation-trials');
        }
        return launchOptions;
      });
    },
  },
});
