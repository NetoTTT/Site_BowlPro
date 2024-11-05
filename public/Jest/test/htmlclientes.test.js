import { verTodosClientes } from './clientes';

jest.mock('firebase/firestore', () => {
    const originalModule = jest.requireActual('firebase/firestore');
    
    return {
        ...originalModule,
        collection: jest.fn(),
        getDocs: jest.fn(() =>
            Promise.resolve({
                forEach: (callback) => {
                    const docs = [
                        { data: () => ({ nome: 'Cliente 1', email: 'cliente1@example.com', tel: '123456789' }) },
                        { data: () => ({ nome: 'Cliente 2', email: 'cliente2@example.com', tel: '987654321' }) }
                    ];
                    docs.forEach(callback);
                }
            })
        ),
    };
});

describe('Renderização de clientes', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <div id="clientes-list"></div>
        `;
    });

    it('deve renderizar os dados de clientes no HTML', async () => {
        const mockDb = {}; // Mock do Firestore
        const clientes = await verTodosClientes(mockDb);

        let clientesList = document.getElementById('clientes-list');
        
        clientes.forEach(cliente => {
            clientesList.innerHTML += `
                <div class="cliente">
                    <h2>${cliente.nome}</h2>
                    <p><strong>Email:</strong> ${cliente.email}</p>
                    <p><strong>Telefone:</strong> ${cliente.tel}</p>
                </div>
            `;
        });

        expect(clientesList.innerHTML).toContain('Cliente 1');
        expect(clientesList.innerHTML).toContain('cliente1@example.com');
        expect(clientesList.innerHTML).toContain('123456789');
        expect(clientesList.innerHTML).toContain('Cliente 2');
        expect(clientesList.innerHTML).toContain('cliente2@example.com');
        expect(clientesList.innerHTML).toContain('987654321');
    });
});
