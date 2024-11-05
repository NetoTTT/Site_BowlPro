describe('Teste de carregamento da pagina', () => {
    beforeEach(() => {
        cy.visit('/bowlpro/tela_cliente/agendar_horario/agendar_horario.html'); // Substitua PORT pela porta correta
    });


    /**
     * Teste de validação de login, garantindo que o sistema exiba
     * uma mensagem de erro ao tentar agendar um horário sem estar logado.
     *
     * @author Lourival Neto
     * @date 01/11/2024
     */
    it('Deve mostrar erro ao tentar agendar sem estar logado', () => {
        // Simula não estar logado
        cy.get('button[type="submit"]').click();

        // Verifique se a mensagem de erro aparece
        cy.on('window:alert', (text) => {
            expect(text).to.contains('Você precisa estar logado para agendar um horário.');
        });
    });
});