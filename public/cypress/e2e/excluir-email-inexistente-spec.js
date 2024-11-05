describe('Teste de Apagar Cliente', () => {
    beforeEach(() => {
        cy.visit('/bowlpro/tela_admin/apagar_cliente.html'); // Substitua PORT pela porta correta
    });

    /**
     * Teste de validação ao tentar apagar um cliente, assegurando que
     * o sistema exiba uma mensagem de erro ao tentar remover um cliente
     * com um e-mail que não existe no sistema.
     *
     * @author Felipe Sampaio
     * @date 02/11/2024
     */
    it('deve mostrar erro se o e-mail não existir', () => {
        // Simula a entrada de um e-mail que não existe
        const emailInvalido = 'inexistente@exemplo.com';

        cy.get('#email').type(emailInvalido);
        cy.get('.btn-submit').click();

        // Verifica se a mensagem de erro aparece
        cy.on('window:alert', (alertText) => {
            expect(alertText).to.contains('Nenhum cliente encontrado com este e-mail.');
        });
    });

});