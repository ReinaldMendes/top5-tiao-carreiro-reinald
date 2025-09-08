// src/pages/HomePage.tsx
import React, { useState, useEffect } from 'react';
import { getTop5Songs, getOtherSongs } from '../api/apiClient';
import { Song } from '../types/Song';
import Pagination from '../components/Pagination';

// Assumindo que você terá um componente para o formulário de sugestão
// import SongForm from '../components/SongForm';

const HomePage: React.FC = () => {
    const [top5Songs, setTop5Songs] = useState<Song[]>([]);
    const [otherSongs, setOtherSongs] = useState<Song[]>([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [loading, setLoading] = useState(true);

    // useEffect para buscar os dados da API quando a página for carregada ou a página atual mudar
    useEffect(() => {
        const fetchSongs = async () => {
            setLoading(true);
            try {
                // Busca as 5 músicas mais tocadas
                const top5 = await getTop5Songs();
                setTop5Songs(top5);

                // Busca as demais músicas com paginação
                const other = await getOtherSongs(currentPage);
                setOtherSongs(other.data); // Assumindo que a resposta da API tem a propriedade 'data'
                setTotalPages(other.last_page); // Assumindo que a resposta tem a propriedade 'last_page'
            } catch (error) {
                console.error("Falha ao carregar as músicas.");
            } finally {
                setLoading(false);
            }
        };

        fetchSongs();
    }, [currentPage]); // Re-executa o efeito sempre que 'currentPage' mudar

    const handlePageChange = (page: number) => {
        if (page > 0 && page <= totalPages) {
            setCurrentPage(page);
        }
    };

    const handleSuggestionSubmit = (suggestion: { youtubeLink: string }) => {
        // Aqui você fará a chamada à API para enviar a sugestão
        console.log("Sugestão recebida:", suggestion);
        alert('Sugestão enviada com sucesso!');
    };

    return (
        <div className="container mx-auto p-4 md:p-8">
            {loading ? (
                <p className="text-center text-gray-500">Carregando músicas...</p>
            ) : (
                <>
                    {/* Seção das 5 Músicas Mais Tocadas */}
                    <section className="mb-12">
                        <h1 className="text-3xl font-extrabold text-gray-900 text-center mb-6">
                            Top 5 Tião Carreiro e Pardinho
                        </h1>
                        <p className="text-center text-lg text-gray-600 mb-8">
                            Confira as 5 músicas mais populares da dupla.
                        </p>
                        {/* Aqui você pode usar um componente SongList */}
                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {top5Songs.map((song, index) => (
                                <div key={song.id} className="bg-white p-6 rounded-xl shadow-md transform hover:scale-105 transition-transform duration-300">
                                    <h3 className="text-2xl font-bold text-gray-800 mb-2">{index + 1}. {song.title}</h3>
                                    <p className="text-gray-600 mb-4">{song.artist}</p>
                                    {/* Exibir o link do YouTube, talvez em um iframe */}
                                    <a href={song.youtube_link} target="_blank" rel="noopener noreferrer" className="text-blue-500 hover:underline">
                                        Assistir no YouTube
                                    </a>
                                </div>
                            ))}
                        </div>
                    </section>

                    <hr className="my-12 border-gray-300" />

                    {/* Seção de Sugestão de Músicas */}
                    <section className="mb-12 text-center">
                        <h2 className="text-2xl font-bold text-gray-800 mb-4">
                            Sugira uma Nova Música
                        </h2>
                        <p className="text-gray-600 mb-6">
                            Ajude a expandir nossa lista de clássicos informando um link válido do YouTube.
                        </p>
                        {/* Você pode criar um componente SongForm para isso */}
                        <form onSubmit={(e) => { e.preventDefault(); handleSuggestionSubmit({ youtubeLink: '' }); }} className="max-w-md mx-auto">
                            <input
                                type="text"
                                placeholder="Cole o link do YouTube aqui"
                                className="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                            />
                            <button
                                type="submit"
                                className="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-200"
                            >
                                Enviar Sugestão
                            </button>
                        </form>
                    </section>

                    <hr className="my-12 border-gray-300" />

                    {/* Seção de Demais Músicas com Paginação */}
                    <section>
                        <h2 className="text-2xl font-bold text-gray-800 text-center mb-6">
                            Outras Músicas
                        </h2>
                        <p className="text-center text-gray-600 mb-8">
                            Confira a lista completa de músicas da dupla.
                        </p>
                        {/* Aqui você pode usar o mesmo componente SongList ou criar um específico para esta seção */}
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            {otherSongs.map(song => (
                                <div key={song.id} className="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <p className="font-semibold text-gray-700">{song.title} - {song.artist}</p>
                                    <a href={song.youtube_link} target="_blank" rel="noopener noreferrer" className="text-blue-400 hover:underline text-xs">
                                        Assistir
                                    </a>
                                </div>
                            ))}
                        </div>

                        {/* Componente de Paginação */}
                        <Pagination
                            currentPage={currentPage}
                            totalPages={totalPages}
                            onPageChange={handlePageChange}
                        />
                    </section>
                </>
            )}
        </div>
    );
};

export default HomePage;