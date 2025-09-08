// src/components/Header.tsx
import React from 'react';
import { Link } from 'react-router-dom';

const Header: React.FC = () => {
    return (
        <header className="bg-gray-800 text-white p-4 shadow-lg">
            <div className="container mx-auto flex justify-between items-center">
                {/* Logo e Título */}
                <div className="flex items-center">
                    {/* Você pode substituir isso por um SVG ou imagem de logo */}
                    <span className="text-2xl font-bold">Techpines</span>
                    <span className="ml-4 text-xl font-light hidden md:inline">
            Top 5 Tião Carreiro
          </span>
                </div>

                {/* Links de Navegação */}
                <nav>
                    <ul className="flex space-x-4">
                        <li>
                            <Link to="/" className="hover:text-gray-400 transition duration-200">
                                Início
                            </Link>
                        </li>
                        <li>
                            <Link to="/login" className="hover:text-gray-400 transition duration-200">
                                Login
                            </Link>
                        </li>

                    </ul>
                </nav>
            </div>
        </header>
    );
};

export default Header;