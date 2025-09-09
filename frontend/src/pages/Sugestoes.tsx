import React, { useEffect, useState } from "react";
import api from "../api/api";

interface Sugestao {
  id: number;
  titulo: string;
  youtube_id: string;
  thumb: string;
  status: string;
}

const Sugestoes: React.FC = () => {
  const [sugestoes, setSugestoes] = useState<Sugestao[]>([]);

  useEffect(() => {
    api.get("/sugestoes").then((res) => setSugestoes(res.data));
  }, []);

  const aprovar = async (id: number) => {
    await api.put(`/sugestoes/${id}/aprovar`);
    setSugestoes((prev) =>
      prev.map((s) => (s.id === id ? { ...s, status: "aprovada" } : s))
    );
  };

  const rejeitar = async (id: number) => {
    await api.put(`/sugestoes/${id}/rejeitar`);
    setSugestoes((prev) =>
      prev.map((s) => (s.id === id ? { ...s, status: "rejeitada" } : s))
    );
  };

  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold mb-4">Sugestões</h1>
      <ul>
        {sugestoes.map((s) => (
          <li
            key={s.id}
            className="flex items-center justify-between border-b py-2"
          >
            <span>{s.titulo} ({s.status})</span>
            <div className="space-x-2">
              {s.status === "pendente" && (
                <>
                  <button
                    onClick={() => aprovar(s.id)}
                    className="px-3 py-1 bg-green-500 text-white rounded"
                  >
                    Aprovar
                  </button>
                  <button
                    onClick={() => rejeitar(s.id)}
                    className="px-3 py-1 bg-red-500 text-white rounded"
                  >
                    Rejeitar
                  </button>
                </>
              )}
            </div>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Sugestoes;
