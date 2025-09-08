// src/components/AdminActions.tsx
import React, { useState } from 'react';
import { Song } from '../types/Song'; // Assumindo que você terá um tipo 'Song'

interface AdminActionsProps {
    // Poderíamos passar props para carregar a lista de músicas, por exemplo.
}

const AdminActions: React.FC<AdminActionsProps> = () => {
    const [songs, setSongs] = useState<Song[]>([]);
    const [isAdding, setIsAdding] = useState(false);
    const [editingSong, setEditingSong] = useState<Song | null>(null);

    // Função para buscar a lista de músicas do backend
    // async function fetchSongs() {
    //   const fetchedSongs = await ... // Chamar a função da sua API aqui
    //   setSongs(fetchedSongs);
    // }

    // Função para lidar com a adição de uma nova música
    const handleAddSubmit = (newSong: Omit<Song, 'id'>) => {
        // Chamar a função da API para adicionar a música
        // Depois, atualizar o estado 'songs' com a nova lista
        console.log('Adicionando nova música:', newSong);
    };

    // Função para lidar com a edição de uma música
    const handleEditSubmit = (updatedSong: Song) => {
        // Chamar a função da API para editar a música
        // Depois, atualizar o estado 'songs'
        console.log('Editando música:', updatedSong);
        setEditingSong(null);
    };

    // Função para lidar com a exclusão de uma música
    const handleDelete = (songId: number) => {
        // Chamar a função da API para excluir a música
        // Depois, filtrar a lista 'songs' para remover a música excluída
        console.log('Excluindo música com ID:', songId);
    };

    return (
        <div className="admin-actions">
            <h2 className="text-xl font-bold mb-4">Gerenciar Músicas</h2>

            {/* Botão para adicionar música e alternar o formulário */}
            <button
                onClick={() => setIsAdding(!isAdding)}
                className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
            >
                {isAdding ? 'Cancelar' : 'Adicionar Nova Música'}
            </button>

            {/* Formulário de Adição */}
            {isAdding && (
                // Aqui você pode criar um componente `SongForm` para adicionar
                <div>
                    <h3>Formulário de Adição</h3>
                    {/* Exemplo de formulário simples, você pode usar um componente à parte */}
                    <form onSubmit={() => handleAddSubmit({ title: 'Nova Música', artist: 'Artista', youtube_link: 'link' })}>
                        {/* Campos do formulário */}
                        <button type="submit">Salvar</button>
                    </form>
                </div>
            )}

            {/* Lista de Músicas com botões de Ação */}
            <div className="song-list mt-4">
                <h3 className="text-lg font-semibold">Músicas Atuais</h3>
                <ul>
                    {songs.map(song => (
                        <li key={song.id} className="flex justify-between items-center border-b py-2">
                            <span>{song.title} - {song.artist}</span>
                            <div>
                                <button onClick={() => setEditingSong(song)} className="text-sm bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded mr-2">
                                    Editar
                                </button>
                                <button onClick={() => handleDelete(song.id)} className="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded">
                                    Excluir
                                </button>
                            </div>
                        </li>
                    ))}
                </ul>
            </div>

            {/* Formulário de Edição */}
            {editingSong && (
                <div>
                    <h3>Formulário de Edição</h3>
                    {/* Você pode criar um componente de formulário reutilizável aqui */}
                    <form onSubmit={() => handleEditSubmit({ ...editingSong, title: 'Título Editado' })}>
                        {/* Campos do formulário preenchidos com os dados de `editingSong` */}
                        <button type="submit">Salvar Edição</button>
                    </form>
                </div>
            )}
        </div>
    );
};

export default AdminActions;