/**
 * Teste de funcionalidade do painel do administrador, garantindo que a
 * página carregue corretamente e que todos os elementos de navegação
 * estejam funcionando conforme o esperado.
 *
 * @author Lourival Neto
 * @date 04/11/2024
 */
describe('Teste do Painel do Administrador', () => {
    beforeEach(() => {
        cy.visit('/bowlpro/tela_admin/tela_admin.html'); // Altere PORT para a porta onde seu servidor está rodando
    });

    /**
     * Teste de verificação do título da página, assegurando que
     * o título "Painel do Administrador" seja exibido corretamente.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve exibir o título corretamente', () => {
        cy.get('h1').should('have.text', 'Painel do Administrador');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Ver Todos os Funcionários",
     * garantindo que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Ver Todos os Funcionários', () => {
        cy.get('button').contains('Ver Todos os Funcionários').click();
        cy.url().should('include', 'ver_todos_funcionarios.html'); // Verifica se redireciona para a URL correta
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Pesquisar Funcionário",
     * assegurando que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Pesquisar Funcionário', () => {
        cy.get('button').contains('Pesquisar Funcionário').click();
        cy.url().should('include', 'pesquisar_funcionario.html');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Ver Todos os Clientes",
     * garantindo que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Ver Todos os Clientes', () => {
        cy.get('button').contains('Ver Todos os Clientes').click();
        cy.url().should('include', 'ver_todos_clientes.html');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Pesquisar Cliente",
     * assegurando que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Pesquisar Cliente', () => {
        cy.get('button').contains('Pesquisar Cliente').click();
        cy.url().should('include', 'pesquisar_cliente.html');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Cadastrar Funcionário",
     * garantindo que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Cadastrar Funcionário', () => {
        cy.get('button').contains('Cadastrar Funcionário').click();
        cy.url().should('include', 'cadastrar_funcionario.html');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Ver Todos os Agendamentos",
     * assegurando que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Ver Todos os Agendamentos', () => {
        cy.get('button').contains('Ver Todos os Agendamentos').click();
        cy.url().should('include', 'ver_todos_agendamentos.html');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Apagar Cliente",
     * garantindo que a URL correta seja carregada.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para Apagar Cliente', () => {
        cy.get('button').contains('Apagar Cliente').click();
        cy.url().should('include', 'apagar_cliente.html');
    });

    /**
     * Teste de redirecionamento ao clicar no botão "Sair", assegurando
     * que a URL correta seja carregada, levando o usuário à página inicial.
     *
     * @author Lourival Neto
     * @date 04/11/2024
     */
    it('deve redirecionar para a página de Sair', () => {
        cy.get('button').contains('Sair').click();
        cy.url().should('include', 'index.html'); // Assumindo que esta é a URL da página inicial
    });
});
