describe('Teste de Apagar Cliente', () => {
    beforeEach(() => {
        cy.visit('/bowlpro/tela_admin/apagar_cliente.html'); // Substitua PORT pela porta correta
    });

/**
 * Teste de tratamento de erros ao tentar apagar um cliente, garantindo que
 * o sistema exiba uma mensagem de erro adequada quando ocorre uma falha
 * na exclusão, como no caso de um e-mail inválido.
 *
 * @author Lourival Neto
 * @date 04/11/2024
 */
it('deve lidar com erros de exclusão', () => {
    // Simula um erro ao tentar apagar um cliente (isso pode exigir configuração de ambiente)

    const email = 'erroexemplo.com'; // Use um e-mail que causaria um erro no backend

    cy.get('#email').type(email);
    cy.get('.btn-submit').click();

    // Verifica se a mensagem de erro aparece
    cy.on('window:alert', (alertText) => {
        expect(alertText).to.contains('Erro ao apagar cliente. Tente novamente.');
    });
});

});