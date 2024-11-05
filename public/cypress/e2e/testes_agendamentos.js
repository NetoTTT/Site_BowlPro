/**
 * Testes para a funcionalidade de visualização de todos os agendamentos,
 * assegurando que a página carregue corretamente e que os dados dos
 * agendamentos sejam exibidos conforme esperado.
 *
 * @author Adenilton Júnior
 * @date 04/11/2024
 */
describe('Testes para Ver Todos os Agendamentos', () => {
    beforeEach(() => {
        // Abre a página localmente ou um servidor de teste onde a página está sendo exibida
        cy.visit('/bowlpro/tela_admin/ver_todos_agendamentos.html'); // Substitua pelo caminho local ou URL
    });

    /**
     * Teste de verificação se o título e a tabela estão presentes na página.
     * Assegura que os elementos necessários estão carregados corretamente.
     *
     * @author Adenilton Júnior
     * @date 04/11/2024
     */
    it('Verifica se o título e a tabela estão presentes', () => {
        cy.contains('Todos os Agendamentos').should('exist'); // Verifica o título
        cy.get('#agendamentosTable').should('exist'); // Verifica se a tabela existe
    });

    /**
     * Teste para verificar se as colunas da tabela estão sendo exibidas corretamente.
     * Garante que todas as colunas necessárias estão presentes no cabeçalho da tabela.
     *
     * @author Adenilton Júnior
     * @date 04/11/2024
     */
    it('Verifica as colunas da tabela', () => {
        cy.get('#agendamentosTable thead tr').within(() => {
            cy.contains('ID').should('exist');
            cy.contains('Data e Hora').should('exist');
            cy.contains('Email do Cliente').should('exist');
            cy.contains('Horário').should('exist');
        });
    });
});
