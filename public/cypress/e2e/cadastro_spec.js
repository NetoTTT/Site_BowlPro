describe('Teste de Cadastro', () => {
    beforeEach(() => {
        cy.visit('/bowlpro/cad_user/cadastro_cliente.html'); // Altere PORT para a porta onde seu servidor está rodando
    });

    /**
     * Teste de funcionalidade de cadastro de usuário, assegurando que
     * um novo usuário pode ser cadastrado com sucesso ao preencher
     * todos os campos corretamente.
     *
     * @author Adenilton Júnior
     * @date 02/11/2024
     */
    it('deve permitir o cadastro de um novo usuário', () => {
        cy.get('#name').type('João Silva');
        cy.get('#age').type('25');
        cy.get('#phone').type('11987654321');
        cy.get('#email').type('joao.silva@example.com');
        cy.get('#password').type('senha123');

        // Envia o formulário
        cy.get('button[type="submit"]').click();

        // Verifica se a mensagem de sucesso aparece
        cy.on('window:alert', (str) => {
            expect(str).to.equal('Um e-mail de verificação foi enviado para joao.silva@example.com. Por favor, verifique seu e-mail.');
        });
    });

    /**
     * Teste de validação do cadastro de usuário, garantindo que o
     * sistema não permita o cadastro com dados inválidos, exibindo
     * um alerta de erro correspondente.
     *
     * @author Adenilton Júnior
     * @date 02/11/2024
     */
    it('não deve permitir o cadastro com dados inválidos', () => {
        cy.get('#name').type(' '); // Nome vazio
        cy.get('#age').type(' '); // Idade vazia
        cy.get('#phone').type(' '); // Telefone vazio
        cy.get('#email').type('invalidemail'); // E-mail inválido
        cy.get('#password').type(' '); // Senha vazia

        // Envia o formulário
        cy.get('button[type="submit"]').click();

        // Verifica se o alerta de erro aparece
        cy.on('window:alert', (str) => {
            expect(str).to.include('Erro ao cadastrar:');
        });
    });

});
