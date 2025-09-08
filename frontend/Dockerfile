# === 1. Base image ===
FROM node:20

# === 2. Diretório de trabalho ===
WORKDIR /app

# === 3. Copiar arquivos de dependência ===
COPY package*.json ./

# === 4. Instalar dependências com legacy-peer-deps ===
RUN npm install --legacy-peer-deps

# === 5. Copiar todo o código fonte ===
COPY . .

# === 6. Limpar cache do npm (opcional, mas ajuda no build) ===
RUN npm cache clean --force

# === 7. Ajustar permissões para evitar EACCES ===
RUN chown -R node:node /app

# === 8. Build do Tailwind / React ===
RUN npm run build

# === 9. Expor porta ===
EXPOSE 3000

# === 10. Comando default para rodar a aplicação ===
CMD ["npm", "start"]
