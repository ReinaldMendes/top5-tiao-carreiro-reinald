import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css'; // Se você tiver um arquivo CSS
import App from './App'; // O componente principal da sua aplicação
import reportWebVitals from './reportWebVitals'; // Para monitorar a performance

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
);

// Se você quiser usar o monitoramento de performance
reportWebVitals();