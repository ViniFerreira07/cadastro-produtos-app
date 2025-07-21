# 📦 Mini ERP - Laravel

Este projeto trata do desenvolvimento de um **sistema Mini ERP**, desenvolvido com o framework **Laravel**. O objetivo do sistema é gerenciar o fluxo de pedidos, produtos, estoque, clientes, cupons e variações de forma eficiente e automatizada.

---

## 🚀 Tecnologias

- PHP 8.x
- Laravel 10.x
- MySQL
- Bootstrap (front-end)
- Blade Templates
- JavaScript
- Webhooks
- Mail (SMTP)

---

## 🗃️ Tabelas Principais

- **Pedidos**
- **Produtos**
- **Estoque**
- **Clientes**
- **Variações**
- **Cupons**

---

## 🔄 Fluxo do Sistema

1. **Cadastro de Produto**  
   O processo se inicia com o cadastro de um novo produto.

2. **Adição ao Carrinho**  
   O produto pode ser adicionado ao carrinho, com ou sem aplicação de cupom de desconto.

3. **Finalização da Compra**  
   Após adicionar os itens ao carrinho, o usuário pode:
   - Cadastrar um novo cliente;
   - Ou selecionar um cliente existente.

4. **Cadastro de Variações (opcional)**  
   É possível cadastrar variações do produto (ex: tamanho, cor).  
   Validação: a soma da quantidade em estoque das variações **não pode exceder** o estoque total do produto.

5. **Geração e Atualização de Estoque**  
   Cada novo produto cadastrado gera automaticamente um controle de estoque.

6. **Finalização do Pedido**  
   Ao finalizar a compra:
   - Um novo registro é salvo na tabela **Pedidos**;
   - O estoque é atualizado conforme a quantidade adquirida;
   - Um **e-mail de confirmação** é enviado para o cliente cadastrado.

---

## 📧 Envio de E-mails

Ao finalizar um pedido, o sistema dispara automaticamente um e-mail de confirmação para o cliente com os detalhes da compra.

---

## 📡 Webhook de Atualização de Pedido

A aplicação expõe o seguinte endpoint para atualização externa do status do pedido:
O "id" deve ser o id de um pedido e "status" deve ser um dos seguintes:
'pendente', 'verificando-pagamento', 'em-preparacao', 'em-curso', 'entregue', 'cancelado'

### Atualizar status do pedido

`GET api/atualizar-pedido/{id}/{status}`

Exemplo: `http://127.0.0.1:8000/api/atualizar-pedido/2/em-curso`

## ⚙️ Instalação e Execução do Projeto Laravel

Siga os passos abaixo para clonar, instalar e rodar este projeto Laravel localmente:

1. Clone o repositório

```bash
git clone https://github.com/ViniFerreira07/cadastro-produtos-app.git
cd cadastro-produtos-app
```

2. Instale as dependências PHP

```bash
composer install
```

(Opcional) Instale dependências JavaScript, se houver assets (Vite/Laravel Mix)

```bash
npm install
npm run dev
```

3. Copie o arquivo de ambiente e gere a chave da aplicação

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure o banco de dados no arquivo `.env` com os dados do seu banco de dados

Exemplo:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cadastroapp
DB_USERNAME=root
DB_PASSWORD=
```

5. Rode as migrações do banco de dados

```bash
php artisan migrate
```

6. Inicie o servidor local

```bash
php artisan serve
```
