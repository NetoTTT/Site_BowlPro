import { getFirestore, collection, getDocs } from "firebase/firestore";

export async function verTodosClientes(db) {
    const clientesRef = collection(db, 'clientes');
    const clientesSnapshot = await getDocs(clientesRef);
    
    const clientesData = [];
    clientesSnapshot.forEach((doc) => {
        let clienteData = doc.data();
        clientesData.push({
            nome: clienteData.nome,
            email: clienteData.email,
            tel: clienteData.tel
        });
    });

    return clientesData;
}
