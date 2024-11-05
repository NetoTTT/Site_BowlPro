describe('Teste de Cadastro de Funcionário', () => {
    beforeEach(() => {
        // Altere a URL para onde seu arquivo HTML está hospedado
        cy.visit('/bowlpro/tela_admin/cadastrar_funcionario.html'); // Substitua pela URL correta do seu projeto
    });

    /**
     * Teste de funcionalidade de cadastro de funcionário, garantindo que
     * um funcionário pode ser cadastrado com sucesso ao preencher todos os
     * campos obrigatórios corretamente.
     *
     * @author Louise Santino revisado por Lourival
     * @date 01/11/2024
     */
    it('Deve cadastrar um funcionário com sucesso', () => {
        const nome = 'João Silva';
        const cadUnico = '123456789';
        const email = 'joao.silva@example.com';
        const telefone = '11987654321';
        const cargo = 'Desenvolvedor';
        const idade = 30;
        const cpf = '123.456.789-00';

        // Preencher o formulário
        cy.get('#nome').type(nome);
        cy.get('#cadUnico').type(cadUnico);
        cy.get('#email').type(email);
        cy.get('#telefone').type(telefone);
        cy.get('#cargo').type(cargo);
        cy.get('#idade').type(idade);
        cy.get('#cpf').type(cpf);

        // Enviar o formulário
        cy.get('button[type="submit"]').click();

        // Verificar se a mensagem de sucesso foi exibida
        cy.on('window:alert', (text) => {
            expect(text).to.contains('Funcionário cadastrado com sucesso!');
        });
    });

    /**
     * Teste de validação do cadastro de funcionário, assegurando que
     * o sistema não permita o cadastro sem preencher os campos
     * obrigatórios, mantendo o formulário na página.
     *
     * @author Louise Santino
     * @date 01/11/2024
     */
    it('Não deve permitir o cadastro sem preencher os campos obrigatórios', () => {
        // Enviar o formulário sem preencher nada
        cy.get('button[type="submit"]').click();

        // Verificar se o formulário ainda está na página
        cy.get('#cadastrarFuncionarioForm').should('exist');
    });

});
