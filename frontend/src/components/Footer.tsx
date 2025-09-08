// src/components/Footer.tsx
import React from 'react';

const Footer: React.FC = () => {
    return (
        <footer className="bg-gray-800 text-white py-6 mt-auto">
            <div className="container mx-auto px-4 text-center">
                <p className="text-sm">
                    &copy; {new Date().getFullYear()} Techpines. Todos os direitos reservados.
                </p>
                <p className="text-xs text-gray-400 mt-2">
                    Teste de conhecimento para Programador Laravel/ReactJS.
                </p>
            </div>
        </footer>
    );
};

export default Footer;