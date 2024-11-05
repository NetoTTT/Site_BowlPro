describe('Teste de Apagar Cliente', () => {
    beforeEach(() => {
        cy.visit('/bowlpro/tela_admin/apagar_cliente.html'); // Substitua PORT pela porta correta
    });

    /**
    * Teste de funcionalidade de apagar cliente, verificando se o sistema
    * permite a remoção de um cliente existente com sucesso, após a entrada
    * de um e-mail válido.
    *
    * @author Lourival Neto
    * @date 01/11/2024
    */
    it('deve apagar um cliente com sucesso', () => {
        // Simula a entrada de um e-mail de um cliente existente
        const email = 'cliente@exemplo.com'; // Email existente no Firebase

        cy.get('#email').type(email);
        cy.get('.btn-submit').click();

        // Verifica se a mensagem de sucesso aparece
        cy.on('window:alert', (alertText) => {
            expect(alertText).to.contains('Cliente apagado com sucesso!');
        });
    });


});
