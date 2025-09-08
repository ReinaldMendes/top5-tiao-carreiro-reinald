// src/components/SongList.tsx
import React from 'react';
import { Song } from '../types/Song'; // Importe a interface da música

interface SongListProps {
    songs: Song[];
    title?: string; // Opcional, para usar em diferentes seções
}

const SongList: React.FC<SongListProps> = ({ songs, title }) => {
    return (
        <div className="song-list">
            {title && <h2 className="text-2xl font-bold mb-4">{title}</h2>}
            <ul>
                {songs.map(song => (
                    <li key={song.id} className="mb-2 p-4 bg-gray-100 rounded-lg">
                        <h3 className="text-lg font-semibold">{song.title}</h3>
                        <p className="text-sm text-gray-600">{song.artist}</p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default SongList;