# Teste para cargo frontend

### TESTE UPWIFI FRONTEND

### OBJETIVO: CRIAÇÃO DE DASHBOARD

*COMPORTAMENTO ESPERADO:*

1- O dashboard deverá consumir uma API externa.

2- O dashboard deverá ser criado usando o HTML5, Tableless, Twitter Bootstrap 3, Jquery.

3- O dashboard deverá mostrar erros de validação.

4- O teste deverá ser hospedado no github.

*COMPORTAMENTO DESEJÁVEL:*

1- Ao terminar o dashboard, deverá ser criado o build da aplicação.

2- Saber utilizar Photoshop ou Illustrator

*CONHECIMENTO ESPERADO:*

HTML5, CSS3, JQuery, Javascript, Twitter Bootstrap

CONHECIMENTO DESEJÁVEL:

Ecma Script 6 (ES6 / ES 2015), NPM, Bower, Gulp, Sass / Less, AmChartJS (lib para criação de gráficos)

*EXPLICANDO O TESTE*

O sistema deverá ser responsivo.

O sistema do teste é um painel de controle que gerencia um blog.

O sistema poderá, inicialmente, implementar no front o sistema de login via ajax. (não obrigatório)

O sistema deve cadastrar usuários e artigos do blog.

O sistema deve mostrar uma página de visualização do artigo do blog.

O sistema deverá ter uma busca de artigos criados, a busca poderá ser feita pelo nome ou pela tag.

A criação, edição e leitura da API deverá ser feita via ajax, caso haja algum erro é preciso informar no html esse erro na validação dos dados.

*Links de ajuda:*

Bootstrap

http://bootswatch.com/

http://getbootstrap.com/

Ecma Script 6 ( ES6 )

https://developer.mozilla.org/pt-BR/docs/Web/JavaScript/Suporte_ao_ECMAScript_6_na_Mozilla

https://github.com/lukehoban/es6features/blob/master/README.md

Dashboard Template

https://almsaeedstudio.com/themes/AdminLTE/index2.html

https://colorlib.com/polygon/gentelella/index.html

**CONSUMINDO A API**

A API utiliza a arquitetura RESTFUL, os metadados trafegam através de arquivos JSON e utilizam os MÉTODOS/ VERBOS HTTP.

A rota base da API é /api.

Rotas de autenticação

*Login no sistema*

```[POST] /auth/login```

É retornado um bearer token e deve estar no HEADER das requisições para confirmar que o usuário está logado.

Parâmetros:

``` email: email do usuário ```

```password: password do usuário ```

**Nova conta de usuário**

```[POST]  /auth/register ```

Parâmetros:

```name: nome do usuário ```

```email: email do usuário ```

```password: password do usuário ```

**Logout no sistema**

```[POST] /auth/logout ```

Rotas de usuário

**Busca todos os usuários cadastrados**

```[GET]	/user ```

**Cadastrar um novo usuário**

```[POST]  /user/store ```

Parâmetros:

```name: nome do usuário ```

```email: email do usuário ```

```password: password do usuário ```

**Busca informações de um usuário de acordo com seu ID**

```[GET]  /user/show/id ```

```Ex: /user/show/15 ```

Parâmetros:

```id: número do usuário.  ```


**Atualiza informações de um usuário de acordo com seu ID**

```[PUT]  /user/update/id ```

Parâmetros:

```id:  número do usuário ```

```name: nome do usuário ```


**Excluir um usuário a partir de um ID**

```[DELETE]  /user/destroy/id ```

Parâmetros:

```id: número do usuário ```

```confirmation: confirma a exclusão. Valores válidos true ou  1 ```


**Rotas de artigos (posts)**

**Busca todos os artigos cadastrados**

``` [GET]	/post ```

**Cadastra um novo artigo **

```[POST]  /post/store ```

Parâmetros:

```title - Título post ```

```description - resumo do post ```

``` content - conteúdo do posto ```

**Busca informações de um post de acordo com seu ID**

``` [GET]  /post/show/id ```

Parâmetros:

``` id é número do usuário ```

 Ex.: seusite/api/post/show/35


**Atualiza informações de um post de acordo com seu ID**

``` [PUT]  /post/update/id ```

Parâmetros:

``` id é número do usuário ```

 Ex.: seusite/api/post/update/35


**Exclui um artigo a partir de um ID**

``` [DELETE]  /post/destroy/id ```


**Busca artigos que contém uma determinada tag ou várias tags**

Os posts serão retornados agrupados pela tag

``` [GET]  /post/search?tags ```

``` Ex. 1: seusite/api/post/search?tags=Maria ```

Retorna todos os posts que tem no título “Maria” ou que no conteúdo tenha “Maria”

``` Ex.2: seusite/api/post/search?tags=[Maria, Corinthians] ```

Retorna todos os posts que tem no título “Maria” ou que no conteúdo tenha “Maria” e “Corinthtians”
