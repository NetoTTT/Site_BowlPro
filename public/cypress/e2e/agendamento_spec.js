describe('Teste de carregamento da pagina', () => {
  beforeEach(() => {
    cy.visit('/bowlpro/tela_cliente/agendar_horario/agendar_horario.html'); // Substitua PORT pela porta correta
  });

  /**
   * Teste de carregamento da página de agendamento de horário,
   * verificando se os elementos principais estão presentes e visíveis.
   *
   * @author Felipe Sampaio revisado por Lourival
   * @date 01/11/2024
   */
  it('Deve carregar a página de agendamento', () => {
    // Verifica se a página foi carregada
    cy.contains('Agendar').should('be.visible');
    cy.get('#data').should('exist');
    cy.get('#horario').should('exist');
    cy.get('button[type="submit"]').should('exist');
  });

});
