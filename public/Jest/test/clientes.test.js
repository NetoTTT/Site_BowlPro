import { verTodosClientes } from './clientes';

// Mock da função getDocs para simular a resposta do Firestore
jest.mock('firebase/firestore', () => {
    const originalModule = jest.requireActual('firebase/firestore');
    
    return {
        ...originalModule,
        collection: jest.fn(),
        getDocs: jest.fn(() =>
            Promise.resolve({
                forEach: (callback) => {
                    // Simular os dados que queremos retornar
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

describe('verTodosClientes', () => {
    it('deve retornar uma lista de dados de clientes', async () => {
        const mockDb = {}; // Firestore simulado
        const clientes = await verTodosClientes(mockDb);

        expect(clientes).toEqual([
            { nome: 'Cliente 1', email: 'cliente1@example.com', tel: '123456789' },
            { nome: 'Cliente 2', email: 'cliente2@example.com', tel: '987654321' }
        ]);
    });
});
