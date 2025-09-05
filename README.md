# top5-tiao-carreiro-reinald

Top 5 Músicas - Tião Carreiro e Pardinho
Este projeto é uma refatoração e modernização de um sistema de ranking de músicas, originalmente desenvolvido em PHP. O objetivo é reconstruir a aplicação com uma arquitetura de micro-serviços, utilizando um backend com Laravel e um frontend com ReactJS.

Funcionalidades
Backend: API RESTful construída com Laravel 11.

Frontend: Single Page Application (SPA) com ReactJS.

Containerização: Ambiente de desenvolvimento padronizado com Docker.

Autenticação: Sistema de autenticação com Laravel Sanctum para a área administrativa.

Gerenciamento de Conteúdo: CRUD (Create, Read, Update, Delete) para músicas.

Sugestões: Funcionalidade de sugestão de novas músicas através de links do YouTube.

Listagem e Paginação: Exibição do Top 5 de músicas mais tocadas, com uma lista paginada para as demais.

Configuração do Ambiente
O projeto é executado com Docker Compose, o que garante a padronização do ambiente de desenvolvimento.

Requisitos
Docker

Docker Compose

Como Rodar a Aplicação
Clone este repositório para o seu ambiente local.

Na raiz do projeto, execute o seguinte comando para construir e iniciar os contêineres:

docker compose up -d --build

A aplicação estará disponível em http://localhost:3000 e a API em http://localhost:8000.

Contato
Para dúvidas sobre o projeto, entre em contato em 
