import React from "react";
import { Link } from "react-router-dom";

const Dashboard: React.FC = () => {
  return (
    <div className="p-6">
      <h1 className="text-3xl font-bold mb-4">Dashboard</h1>
      <nav className="space-x-4">
        <Link to="/sugestoes" className="text-blue-600 hover:underline">
          Gerenciar Sugestões
        </Link>
        <button
          onClick={() => {
            localStorage.removeItem("token");
            window.location.href = "/login";
          }}
          className="text-red-600 hover:underline"
        >
          Logout
        </button>
      </nav>
    </div>
  );
};

export default Dashboard;
