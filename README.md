# CRUD Laravel + Vue.js

## Imagens do Projeto

### Página Inicial (Listagem de Estados)

<div align="center">
    <img src="https://user-images.githubusercontent.com/43481166/196048437-5263ee04-2d6a-44fb-bbc5-0f1d8bb22215.png" alt="Listagem de Estados" width="850px;">
</div>

### Listagem de Cidades

<div align="center">
    <img src="https://user-images.githubusercontent.com/43481166/196048646-7b12d43e-e91a-4727-b6f6-2ce3861d1c17.png" alt="Listagem de Cidades" width="850px;">
</div>

## Sobre a resolução do desafio

Este projeto foi desenvolvido como solução para o desafio proposto de criar um CRUD para as entidades de estado e cidade utilizando o Laravel e o Vue.js. Um outro projeto utilizando as mesmas tecnologias mas também com a utilização do Inertia.js foi iniciado mas foi solicitado que não utizasse esta tecnologia no desafio. A partir disto iniciei este repositório sem o uso de Inertia.js.

Resolver este desafio foi uma experiência que agregou muito conhecimento tanto do Laravel quanto do Vue.js para construir os componentes utilizados no Front-end do desafio.

A construção de uma SPA (Single-Page Application) utilizando Vue.js foi uma novidade para mim e consegui concluir o desafio com algumas horas de estudo da tecnologia.

Em relação ao Laravel, eu já havia conhecimento do Framework e da linguagem PHP e consegui desenvolver um código limpo e que cumpra as exigências do desafio.

## Instalação

```
git clone https://github.com/Marcosennes/crud-vue-laravel.git
```
```
cd crud-vue-laravel/backend
```
```
composer install
```
```
cp .env.example .env
```

- Configure o arquivo `.env` com suas configurações

```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan serve --port=8000
```

- A aplicação Backend será executada na porta 8000. Agora precisamos configurar a aplicação do projeto. Abra um novo terminal na pasta raiz do projeto (crud-vue-laravel) e execute:

```
cd frontend
```
```
npm install
```
```
npm run serve
```

- A aplicação Front-end será executada por padrão na porta 8080. Acesse em seu navegador:

```
http://localhost:8080/
```
