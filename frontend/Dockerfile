FROM node:20-alpine

# Define o diretório de trabalho no contêiner
WORKDIR /usr/src/app

# Copia os arquivos de configuração para aproveitar o cache do Docker
COPY package*.json ./

# Instala as dependências
RUN npm install

# Corrige vulnerabilidades de segurança após a instalação
RUN npm audit fix --force

# Copia o restante dos arquivos do projeto
COPY . .

# Expõe a porta que a aplicação irá usar
EXPOSE 3000

# Comando para iniciar a aplicação
CMD ["npm", "start"]