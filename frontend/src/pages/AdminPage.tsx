// src/pages/AdminPage.tsx
import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import AdminActions from '../components/AdminActions'; // Importe o componente que já criamos
import { useAuth } from '../context/AuthContext'; // Importe o hook de autenticação

const AdminPage: React.FC = () => {
    const { user } = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        // Verifica se o usuário não está logado
        if (!user) {
            // Redireciona para a página de login
            navigate('/login');
        }
    }, [user, navigate]);

    // Se o usuário não está logado, retorna null para não renderizar nada
    if (!user) {
        return null;
    }

    // Se o usuário está logado, renderiza o conteúdo da página de administração
    return (
        <div className="container mx-auto p-4 md:p-8">
            <h1 className="text-3xl font-bold text-center mb-6">Área de Administração</h1>
            <AdminActions />
        </div>
    );
};

export default AdminPage;