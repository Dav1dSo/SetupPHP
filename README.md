# Mini E-commerce

Este é um projeto de exemplo de um mini e-commerce, desenvolvido em PHP e utilizando Docker para o ambiente de desenvolvimento, com MySQL como banco de dados e Phinx para gerenciamento de migrações.

## 📝 Descrição

O Mini E-commerce é um projeto simples para demonstrar a integração de um backend em PHP com um banco de dados MySQL. Ele serve como base para aprendizado ou desenvolvimento de sistemas e-commerce pequenos, com foco em boas práticas e facilidade de configuração.

## 🛠 Tecnologias Usadas

- **PHP**: Linguagem principal para desenvolvimento.
- **Phinx**: Gerenciamento de migrações de banco de dados.
- **Docker**: Ambiente containerizado para o projeto.
- **MySQL**: Banco de dados relacional.
- **Docker Compose**: Ferramenta para orquestração de serviços Docker.

## 🚀 Como Instalar

Siga os passos abaixo para configurar e executar o projeto:

### Pré-requisitos

- Instale o [Docker](https://www.docker.com/).
- Instale o [Docker Compose](https://docs.docker.com/compose/).

### Passo a passo

1. Crie a rede Docker para o projeto:
   ```bash
   docker network create mini_ecommerce_network
   ```

2. Suba o banco de dados:
  ```
    docker-compose -f .Docker/database/docker-compose-db.yaml up -d
  ```

3. Suba o ambiente da aplicação:
  ```
    docker-compose -f .Docker/docker-compose.yaml up -d
  ```

4. Execute as migrações no ambiente de desenvolvimento:
  ```
    docker-compose exec web vendor/bin/phinx migrate -e development
  ```