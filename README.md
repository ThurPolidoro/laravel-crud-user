# CRUD de Clientes

Este é um CRUD de clientes simples desenvolvido em Laravel 10 com PHP 8.1. O sistema permite a criação, leitura, atualização e exclusão de clientes através de uma única página utilizando Bootstrap.

## Requisitos

Para executar este projeto, você precisa ter o seguinte software instalado em seu sistema:

- PHP >= 8.1
- Composer
- Node.js
- Vite

## Instalação e execução

Siga os passos abaixo para instalar e executar o projeto:

1. Clone o repositório: `git clone https://github.com/ThurPolidoro/laravel-crud-user.git`
2. Navegue para a pasta do projeto: `cd laravel-crud-user`
3. Instale as dependências do Laravel: `composer install`
4. Crie um arquivo .env baseado no arquivo .env.example: `cp .env.example .env`
5. Configure o arquivo .env com as informações do seu ambiente (ex. nome do banco de dados, usuário e senha)
6. Gere a chave do aplicativo: `php artisan key:generate`
7. Execute as migrações do banco de dados: `php artisan migrate`
8. Instale as dependências do Node.js: `npm install`
9. Execute o comando do VITE para compilar os arquivos: `npm run dev`
10. Inicie o servidor do Laravel: `php artisan serve`
11. Acesse o aplicativo no seu navegador em `http://127.0.0.1:8000`


## Funcionamento

Ao acessar o aplicativo, você verá uma lista de clientes cadastrados. Para adicionar um novo cliente, clique no botão "Novo Cliente". Preencha os campos obrigatórios (Nome, Email e Telefone) e clique em "Salvar". Para editar ou excluir um cliente existente, clique nos botões correspondentes na tabela.

## Autor

Thourtlon Polidoro - [thurpolidoro@gmail.com](mailto:thurpolidoro@gmail.com)
